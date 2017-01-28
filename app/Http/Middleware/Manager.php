<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Manager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()) {
            return redirect('users/login');
        }

        $user = Auth::user();

        if ($user->isManager()) {
            return $next($request);
        }

        return redirect('/')->with('status', 'You are not authorize to access that page');
    }
}
