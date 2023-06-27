<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelDataUser extends Model
{
    use HasFactory;

    protected $table = 'label_data_user';
    //測定日、身長、体重、体脂肪率、筋肉量、右足－筋肉量、左足－筋肉量、右腕－筋肉量、左腕－筋肉量、体幹部－筋肉
    const DATA_ADD = [
        'column_8' => '身長',
        "column_10" => '体重',
        'column_11' => '体脂肪率',
        'column_14' => '筋肉量',
        'column_36' => '右足－筋肉量',
        'column_42' => '左足－筋肉量',
        'column_48' => '右腕－筋肉量',
        'column_54' => '左腕－筋肉量',
        'column_60' => '体幹部－筋肉量'
    ];

    protected $fillable = [
        'key',
        'value',
        'order',
    ];
}
