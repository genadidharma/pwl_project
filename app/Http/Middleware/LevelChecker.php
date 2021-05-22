<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $level)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $user = Auth::user();

        if($user->getLevel() === $level)
            return $next($request);
        return abort(403);
    }
}
