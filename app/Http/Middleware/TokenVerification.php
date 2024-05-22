<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenVerification
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed|string
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('login_token')) {
            return $next($request);
        }

        return redirect()->to('/');
    }
}
