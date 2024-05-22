<?php

namespace App\Http\Controllers;

use App\Services\ApiRequestService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $first_name = $request->session()->get('first_name');
        $last_name = $request->session()->get('last_name');
        $user_id = $request->session()->get('user_id');
        return view('home', compact('first_name', 'last_name', 'user_id'));
    }

    /**
     * @param $user_id
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function profile($user_id): Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
    {
        try {
            $user = (new ApiRequestService())->getDetailApi('users/', $user_id);

            return view('user.profile', compact('user'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
