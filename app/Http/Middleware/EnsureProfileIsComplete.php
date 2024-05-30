<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && !$user->profileKarIsComplete() && !$user->profileAtsIsComplete() && !$user->profileAdmIsComplete() && !$user->profileKepIsComplete()) {
            return redirect()->route('user-profile')->with('warning', 'Please complete your profile.');
        }

        return $next($request);
    }
}
