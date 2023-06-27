<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_STUDENT = 'STUDENT';
    const ROLE_TEACHER = 'TEACHER';
    const ROLE_ADMIN = 'ADMIN';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'display_name',
        'kana_name',
        'gender',
        'figure',
        'height',
        'pre_pregnancy_weight',
        'date_of_birth',
        'first_registration_date',
        'role',
        'team',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAgeAttribute($key)
    {
        return Carbon::parse($this->date_of_birth)->age;
    }

    public function dataUser()
    {
        return $this->hasMany(DataUser::class, 'code_user', 'code');
    }
}
