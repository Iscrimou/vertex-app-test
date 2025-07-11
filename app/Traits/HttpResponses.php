<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpResponses
{
    protected function success($data, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ], $code);
    }

    protected function error(string|null $message = null, $errors, int $code = 400): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'data' => null
        ];

        if (!is_null($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
