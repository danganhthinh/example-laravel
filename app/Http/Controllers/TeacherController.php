<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $condition = [
                [
                    'role', User::ROLE_TEACHER
                ]
            ];

            if ($request->search) {
                $condition[] = ['name', 'LIKE', "%$request->search%"];
            }

            $data = $this->userRepository->paginated(10, $condition);

            return view('admin.pages.teachers.grid', compact('data'));
        }

        return view('admin.pages.teachers.index');
    }

    public function create()
    {
        $team = $this->getTeam();

        $action = route('teachers.store');

        return view('admin.pages.teachers.form', compact('team', 'action'));
    }

    public function store(CreateTeacherRequest $createTeacherRequest)
    {
        $data = $createTeacherRequest->only([
            'password',
            'team',
            'name',
            'email',
            'date_of_birth'
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = User::ROLE_TEACHER;

        $this->userRepository->create($data);

        return redirect(route('teachers.index'))->with('success', __('response.Create success!'));
    }

    public function edit($id)
    {
        $teacher = $this->userRepository->find($id);
        $action = route('teachers.update', ['teacher' => $id]);
        $team = $this->getTeam();

        return view('admin.pages.teachers.form', compact('action', 'teacher', 'team'));
    }

    public function update(UpdateTeacherRequest $request, $id)
    {
        $data = $request->only([
            'team',
            'name',
            'email',
            'date_of_birth'
        ]);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $this->userRepository->update($data, $id);

        return redirect(route('teachers.index'))->with('success', __('response.Update success!'));
    }

    public function getTeam()
    {
        return $this->userRepository->getTeamStudent()
            ->pluck('team')
            ->toArray();
    }
}
