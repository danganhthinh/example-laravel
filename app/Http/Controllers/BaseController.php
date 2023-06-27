<?php

namespace App\Http\Controllers;

use App\Consts;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{

    /**
     * @param $result
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendResponse($result, $message = 'success', $code = Consts::CODE_SUCCESS): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $result,
        ], $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($message = 'error', $code = Consts::CODE_NOT_FOUND, $result = null): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $result,
        ], $code);
    }


}
