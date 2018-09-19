<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogState
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
        if (!session('logged')) {

            if ($request->ajax()) {
                return ['success' => 'false'];
            }
            return redirect()->route('login');
        }

        return $next($request);
    }
}
