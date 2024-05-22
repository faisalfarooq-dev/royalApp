<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\ApiRequestService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function loginView(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $http_request = (new ApiRequestService())->authenticateApi($request->validated());

            $request->session()->put([
                'user_id' => $http_request['user']['id'],
                'login_token' => $http_request['token_key'],
                'first_name' => $http_request['user']['first_name'],
                'last_name' => $http_request['user']['last_name'],
            ]);

            return redirect()->route('index')->with('success', 'Login Successfully.');

        } catch (Exception $e) {
            return redirect()->to('/')->with('error', $e->getMessage());
        }
    }
}
