<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataUserCotroller extends Controller
{
    public function create()
    {
        return view('admin.pages.students.show.form');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $data['measuring_date_time'] = Carbon::parse($request->measuring_date . ' ' . $request->measuring_time);

        if ($user) {
            $data['code_user'] = $user->code;
        }

        DataUser::create($data);

        return redirect(route('students.show', ['student' => @$user->id]))->with('success', 'Create success');
    }
}
