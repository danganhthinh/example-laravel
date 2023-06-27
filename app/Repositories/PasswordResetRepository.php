<?php

namespace App\Repositories;

use App\Models\PasswordReset;
use Carbon\Carbon;

//use Your Model

/**
 * Class ProductRepository.
 */
class PasswordResetRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

    public function __construct()
    {
        $this->model = new PasswordReset();
    }

    public function CheckTimeToken($timeToken, $timeExpire){
        $timeNow = Carbon::now();
        $timecheck = $timeNow->diffInSeconds($timeToken);
        if($timecheck > $timeExpire){
            return false;
        }
        return true;
    }

}
