<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;

    protected $table = 'data_user';

    protected $fillable = [
        'model_number',
        'code_user',
        'status',
        'measuring_date',
        'measurement_time',
        'measuring_date_time',
        'figure',
        'sex',
        'age',
        'column_9', 'column_10', 'column_11', 'column_12', 'column_13', 'column_14', 'column_15', 'column_16', 'column_17', 'column_18', 'column_19', 'column_20', 'column_21', 'column_22', 'column_23', 'column_24', 'column_25', 'column_26', 'column_27', 'column_28', 'column_29', 'column_30', 'column_31', 'column_32', 'column_33', 'column_34', 'column_35', 'column_36', 'column_37', 'column_38', 'column_39', 'column_40', 'column_41', 'column_42', 'column_43', 'column_44', 'column_45', 'column_46', 'column_47', 'column_48', 'column_49', 'column_50', 'column_51', 'column_52', 'column_53', 'column_54', 'column_55', 'column_56', 'column_57', 'column_58', 'column_59', 'column_60', 'column_61', 'column_62', 'column_63', 'column_64', 'column_65', 'column_66', 'column_67', 'column_68', 'column_69', 'column_70', 'column_71', 'column_72', 'column_73', 'column_74', 'column_75', 'column_76', 'column_77', 'column_78', 'column_79', 'column_80', 'column_81', 'column_82', 'column_83', 'column_84', 'column_85', 'column_86', 'column_87', 'column_88', 'column_89', 'column_90', 'column_91', 'column_92', 'column_93', 'column_94', 'column_95', 'column_96', 'column_97', 'column_98', 'column_99', 'column_100', 'column_101', 'column_102', 'column_103', 'column_104', 'column_105', 'column_106', 'column_107', 'column_108', 'column_109', 'column_110', 'column_111', 'column_112', 'column_113', 'column_114', 'column_115', 'column_116', 'column_117', 'column_118', 'column_119', 'column_120',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'code_user', 'code');
    }
}
