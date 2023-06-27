<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $roles = explode('|', $role);
        $user = auth()->user();

        if (in_array($user->role, $roles) || (route('students.show', ['student' => $user->id]) === $request->url())) {
            return $next($request);
        }


        return redirect(route('home'));
    }
}
