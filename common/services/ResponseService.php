<?php

namespace common\services;

class ResponseService
{
    public static function successResponse($message, $model): array
    {
        return array(
            'message' => $message,
            'data' => $model
        );
    }

    public static function errorResponse($errors)
    {
        return array(
            'hasErrors' => true,
            'error' => $errors
        );
    }

}