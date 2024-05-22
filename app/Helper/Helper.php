<?php

namespace App\Helper;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Helper
{
    /**
     * @return PendingRequest
     */
    static function httpRequest(): PendingRequest
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'Authorization' => Session::get('login_token')
        ]);
    }

    /**
     * @param $data
     * @return mixed
     */
    static function jsonDecode($data): mixed
    {
        return json_decode($data, true);
    }

    /**
     * @param string $token
     * @return PendingRequest
     */
    static function postRequestFromCommand(string $token): PendingRequest
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'Authorization' => $token
        ]);
    }
}
