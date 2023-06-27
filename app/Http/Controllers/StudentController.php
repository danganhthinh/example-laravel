<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentRequest;
use App\Imports\DataUsersImport;
use App\Imports\UsersImport;
use App\Jobs\CalculatorRankJob;
use App\Models\DataUser;
use App\Models\LabelDataUser;
use App\Models\Ranks;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use function Webmozart\Assert\Tests\StaticAnalysis\float;

class StudentController extends Controller
{
    public $userRepository;
    public $currentUser;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->currentUser = Auth::user();
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        $data = User::where('role', User::ROLE_STUDENT)
            ->when($user->role === User::ROLE_TEACHER, function ($q) use ($user) {
                $q->where('team', $user->team);
            })
            ->when($request->search !== null, function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('display_name', 'LIKE', "%$request->search%")
                        ->orWhere('kana_name', 'LIKE', "%$request->search%")
                        ->orWhere('name', 'LIKE', "%$request->search%")
                        ->orWhere('code', 'LIKE', "%$request->search%");
                });
            })
            ->when($request->month !== null, function ($q) use ($request) {
                $q->whereMonth('date_of_birth', $request->month);
            })
            ->when($user->role === User::ROLE_TEACHER, function ($q) {
                $q->with([
                    'dataUser' => function ($q) {
                        $q->orderBy('measuring_date_time', 'desc')
                            ->first();
                    }
                ]);
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.pages.students.grid', compact('data', 'user'));
        }

        return view('admin.pages.students.index');
    }

    public function show(Request $request)
    {
        $user = User::find($request->student);

        if (!$user && !$request->ajax()) {
            return abort(404);
        }

        if ($request->ajax()) {
            $dataUser = DataUser::select("*")
                ->when($request->month !== null, function ($q) use ($request) {
                    $q->whereMonth('measuring_date', $request->month);
                })
                ->where('code_user', $user->code)
                ->get();

            $rankUser = Ranks::where('code_user', $user->code)
                ->first();

            $labelDataUser = LabelDataUser::when($request->search !== null, function ($q) use ($request) {
                $q->where('value', "LIKE", "%$request->search%");
            })
                ->orderBy('order', 'asc')
                ->get();

            $data = [];

            if (count($dataUser) > 0) {
                foreach ($dataUser as $item) {
                    foreach ($labelDataUser as $itemLabel) {
                        $value = @$item->{"$itemLabel->key"};
                        $rank_in_age = @$rankUser->{$itemLabel->key . "_rank_in_age"};
                        $rank_in_team = @$rankUser->{$itemLabel->key . "_rank_in_team"};
                        $avg_age = @$rankUser->{$itemLabel->key . "_avg_age"};

                        if (!$value)
                            continue;

                        $value = floatval($value);

                        $measuring_date = date_create($item->measuring_date_time)->format('Y/m/d');

                        if (@$data[$itemLabel->value]) {
                            array_push($data[$itemLabel->value]['xValues'], $measuring_date);
                            array_push($data[$itemLabel->value]['yValues'], $value);
                            $data[$itemLabel->value]['last_value'] = $value;
                            $data[$itemLabel->value]['rank_in_age'] = $rank_in_age;
                            $data[$itemLabel->value]['rank_in_team'] = $rank_in_team;
                            $data[$itemLabel->value]['avg_age'] = $avg_age;
                        } else {
                            $data[$itemLabel->value] = [
                                'xValues' => [
                                    $measuring_date
                                ],
                                'yValues' => [
                                    $value
                                ],
                                'last_value' => $value,
                                'rank_in_age' => $rank_in_age,
                                'rank_in_team' => $rank_in_team,
                                'avg_age' => $avg_age,
                            ];
                        }
                    }
                }
            }

            return response()->json([
                'data' => $data
            ]);
        }

        return view('admin.pages.students.show.index', compact('user'));
    }

    public function uploadUser(Request $request)
    {
        $file = $request->file('file_user');

        $test = Excel::import(new UsersImport(), $file);


        return response([
            $test
        ]);
    }

    public function uploadDataUser(Request $request)
    {
        $file = $request->file('file_data_user');

        $test = Excel::import(new DataUsersImport($request->is_overwrite_data), $file);

        dispatch(new CalculatorRankJob())->delay(now()->addMinute());

        return response([
            $test
        ]);
    }

    public function edit($id)
    {
        $student = $this->userRepository->find($id);
        $action = route('students.update', ['student' => $id]);
        return view('admin.pages.students.form', compact('student', 'action'));
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $data = $request->only([
            'email',
            'name'
        ]);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $this->userRepository->update($data, $id);

        return redirect(route('students.index'))->with('success', '編集されました');
    }

    public function addData(Request $request)
    {

    }
}
