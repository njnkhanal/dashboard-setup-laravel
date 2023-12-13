<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // check current user
        $user = Auth::user();
        if ($user) {
            // check role of that user
            $role = $user->role;
            if ($role == 'admin') {
                // if success then return next request
                return $next($request);
            } else {
                return redirect(route('home'));
            }
        }
        // show not found page if not logined
        return abort(404);
    }
}
