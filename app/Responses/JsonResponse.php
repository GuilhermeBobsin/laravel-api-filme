<?php

namespace app\Responses;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
class JsonResponse {

    public static function success(?string $message = null, mixed $data = null)
    {
        return response()->json( [
            'message' => $message,
            'data' => $data,
            'code' => HttpResponse::HTTP_OK
        ], HttpResponse::HTTP_OK);
    }

    public function error(string $message, int $httpCode)
    {
        return response()->json( [
            'message' => $message,
            'code' => $httpCode
        ], $httpCode);
    }
}