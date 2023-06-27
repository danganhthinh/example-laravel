<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function collection(Collection $rows)
    {
        $codes = [];

        foreach ($rows as $key => $item) {
            if ($key === 0)
                continue;
            array_push($codes, $item[0]);
        }

        $userCodes = User::whereIn('code', $codes)->get()->pluck('code')->toArray();
        $dataInsert = [];

        foreach ($rows as $key => $item) {
            if ($key === 0)
                continue;

            if (in_array($item[0], $userCodes)) continue;

            $code = $item[0]; //user_login
            $display_name = $item[1];
            $kana_name = $item[2];
            $password = Hash::make(empty($item[3]) ? '123456' : $item[3]);
            $date_of_birth = $item[4] ? date_create($item[4]) : null;
            $gender = $item[5];
            $figure = $item[6];
            $height = $item[7];
//            $expected_date_of_birth = date_create($item[8]);
            $pre_pregnancy_weight = $item[9];
            $first_registration_date = $item[10] ? date_create($item[10]) : null;
            $initial_registration_time = $item[11];
            $last_registration_date = $item[12];
            $last_registration_time = $item[13];
            $team = substr($code, 1, 8);

            $dataInsert[] = [
                'name' => $display_name,
                'display_name' => $display_name,
                'code' => $code,
                'email' => $code,
                'kana_name' => $kana_name,
                'password' => $password,
                'date_of_birth' => $date_of_birth,
                'gender' => $gender,
                'figure' => $figure,
                'height' => $height,
                'pre_pregnancy_weight' => $pre_pregnancy_weight,
                'initial_registration_time' => $initial_registration_time,
                'first_registration_date' => $first_registration_date,
                'role' => User::ROLE_STUDENT,
                'team' => $team
            ];
        }
        User::insert($dataInsert);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
