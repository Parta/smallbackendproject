<?php

namespace App\Api\Response;

class ApiResponseProvider {

    const RESPONSE_SUCCESS = 'success';
    const RESPONSE_ERROR = 'error';

    public function getSuccessResponse($data) {
        return array_merge(['status' => self::RESPONSE_SUCCESS], $data);
    }

    public function getErrorResponse($message) {
        return [
            'status' => self::RESPONSE_ERROR,
            'message' => $message,
        ];
    }

}
