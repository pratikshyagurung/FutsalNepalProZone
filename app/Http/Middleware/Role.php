<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $role): Response
    // {
    //     if (!$request->user() || $request->user()->role != $role) {
    //         return redirect('user.pages.index');
    //     }
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must be logged in.');
        }

        if (Auth::user()->role !== $role) {
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
    public function authenticated(Request $request, $user)
    {
        if ($user->role == 'futsal_owner') {
            return redirect()->route('futsal_owner.dashboard'); // Example route
        } elseif ($user->role == 'user') {
            return redirect()->route('user.pages.index'); // Example route
        }
        return redirect()->route('home');
    }
}
