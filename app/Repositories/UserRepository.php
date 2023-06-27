<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function checkUserWithEmail($email)
    {
        $user = $this->model::where('email', $email)->first();
        if (!$user) {
            return null;
        }

        return $user;
    }

    public function checkUserWithEmailCode($data)
    {
        $user = $this->model::where('email', $data)->orWhere('code', $data)->first();
        if (!$user) {
            return null;
        }

        return $user;
    }

    public function getToken()
    {
        return Str::random(32);
    }

    public function getTeamStudent()
    {
        return $this->model
            ->groupBy('team')
            ->where('role', User::ROLE_STUDENT)
            ->whereNotNull('team')
            ->get();
    }
}
