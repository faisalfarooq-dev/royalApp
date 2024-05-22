<?php

namespace App\Services;

use App\Helper\Helper;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;

class ApiRequestService
{
    protected string $url;

    public function __construct()
    {
        $this->url = config('api.url', false);
    }

    public function getDetailApi(string $target_url, int $id): mixed
    {
        try {
            $response_data = Helper::jsonDecode(Helper::httpRequest()->get($this->url . $target_url . $id));
            if (isset($response_data['code'])) {
                throw new Exception($response_data['message']);
            }

            return $response_data;

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function deleteRecordApi(string $target_url, int $id): mixed
    {
        try {
            $response_data = Helper::jsonDecode(Helper::httpRequest()->delete($this->url . $target_url . $id));
            if (isset($response_data['code'])) {
                throw new Exception($response_data['message']);
            }

            return $response_data;

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param string $target_url
     * @return mixed
     * @throws ConnectionException
     */
    public function getAuthorsApi(string $target_url): mixed
    {
        return Helper::jsonDecode(Helper::httpRequest()->get($this->url . $target_url));
    }

    /**
     * @param string $target_url
     * @param $payload
     * @return RedirectResponse|mixed
     */
    public function postDataRequestApi(string $target_url, $payload)
    {
        try {
            $response_data = Helper::jsonDecode(Helper::httpRequest()->post($this->url . $target_url, $payload));
            if (isset($response_data['code'])) {
                throw new Exception($response_data['message']);
            }

            return $response_data;
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param $payload
     * @return RedirectResponse|mixed
     */
    public function authenticateApi($payload)
    {
        try {
            $auth_response = Helper::jsonDecode(Helper::httpRequest()->post($this->url . 'token', $payload));
            if (!isset($auth_response['token_key'])) {
                throw new Exception('Unauthorized.');
            }

            return $auth_response;
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
