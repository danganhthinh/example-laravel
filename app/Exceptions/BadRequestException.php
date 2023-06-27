<?php

namespace App\Exceptions;

use Exception;

class BadRequestException extends Exception
{
    public function render()
    {
        return response()->json([
            'code' => $this->getCode(),
            'errors' => $this->getMessage(),
        ], $this->getCode());
    }
}
