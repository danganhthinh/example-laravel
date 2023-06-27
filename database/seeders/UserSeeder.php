<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\UTCDateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        User::create([
            'name' => 'System',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => Carbon::now(),
            'role' => User::ROLE_ADMIN
        ]);

        User::create([
            'name' => 'TEACHER',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => Carbon::now(),
            'role' => User::ROLE_TEACHER
        ]);

        // User::factory()->count(60)->create();
    }
}
