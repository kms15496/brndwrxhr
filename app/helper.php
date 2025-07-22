<?php


if (!function_exists('sendResponse')) {
    function sendResponse($status_code, $message, $data)
    {
        return response()->json(
            [
                'status_code' => $status_code,
                'message' => $message,
                'data' => $data
            ]
            ,
            $status_code,
            [],
            JSON_PRESERVE_ZERO_FRACTION
        );
    }
}


if (!function_exists('jsonDirectResponse')) {
    function jsonDirectResponse($status, $message, $data = null)
    {
        // throw new HttpResponseException(
        $response = response()->json(
            [
                'status_code' => $status,
                'message' => $message,
                'data' => $data,
            ]
        );
        $response->send();
        exit;
        // );
    }
}

