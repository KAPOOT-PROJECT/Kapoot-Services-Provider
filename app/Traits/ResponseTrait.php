<?php

namespace App\Traits;

trait ResponseTrait
{
    public static function success(array $data = [], $message = 'عملیات با موفقیت انجام شد' , $errors = [], $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ], $code);
    }

    public static function error($data = [], $message = 'خطا رخ داده است', $errors = [], $code = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ], $code);
    }
}
