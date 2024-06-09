<?php

namespace App\Traits;

use App\Http\Resources\UserResource;
use App\Models\Firebase;
use App\Models\User;

trait ResponseAPI
{

    /**
     * API response message with status code
     *
     * @param string $message
     * @param int $status_code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function responseMessage(string $message, ?int $status_code = 200)
    {
        return response()->json(['message' => $message], $status_code);
    }

    /**
     * API response message with status code & data
     *
     * @param string $message
     * @param mixed $data
     * @param int $status_code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function responseMessageWithData(string $message, $data, ?int $status_code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status_code);
    }

    /**
     * API response message with status code & errors
     *
     * @param string $message
     * @param mixed $errors
     * @param int $status_code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function responseMessageWithErrors(string $message, array $errors, ?int $status_code = 422)
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors,
        ], $status_code);
    }
}
