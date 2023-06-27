<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranks extends Model
{
    use HasFactory;

    const TYPE_AVG_AGE = 'AVG_AGE';

    const TYPE_RANK_IN_AVG_AGE = 'RANK_IN_AGE';

    const TYPE_RANK_IN_AVG_TEAM = 'RANK_IN_TEAM';

    protected $table = 'ranks';

    protected $fillable = [
        'key_label_data_user',
        'code_user',
        'type',
        'avg_age',
        'rank_in_age',
        'rank_in_team',
    ];
}
