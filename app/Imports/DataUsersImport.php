<?php

namespace App\Imports;

use App\Models\DataUser;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataUsersImport implements ToCollection
{
    protected $is_overwrite_data;

    public function __construct($is_overwrite_data)
    {
        $this->is_overwrite_data = $is_overwrite_data;
    }

    public function collection(Collection $rows)
    {
        $dataInsert = [];
        $dataSeeder = [];

        foreach ($rows as $key => $item) {
            if ($key === 0) continue;
            $model_number = $item[0];
            $code_user = $item[1]; //user_login
            $status = $item[2]; //
            $measuring_date = $item[3];
            $measuring_time = $item[4];
            $figure = $item[5];
            $sex = $item[6];
            $age = $item[7];

            $measuring_date_time = date_create($measuring_date . ' ' . $measuring_time);
            $measuring_date = date_format($measuring_date_time, 'Y-m-d');
            $measurement_time = date_format($measuring_date_time, 'H:i:s');

            $row = [
                'model_number' => $model_number,
                'code_user' => $code_user,
                'status' => $status,
                'measuring_date' => $measuring_date,
                'measurement_time' => $measurement_time,
                'measuring_date_time' => $measuring_date_time->format('Y-m-d H:i:s'),
                'figure' => $figure,
                'sex' => $sex,
                'age' => $age,
            ];

            for ($i = 8; $i <= 200; $i++) {
                $row["column_$i"] = (float)$item[$i];
            }

            $dataInsert[] = $row;

            if (count($dataInsert) > 100) {
                DataUser::insert($dataInsert);
                $dataInsert = [];
            }
        }

        DataUser::insert($dataInsert);
    }
}
