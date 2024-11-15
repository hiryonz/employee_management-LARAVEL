<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class verifyEmployeeId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeId = $request->route('id');
        if (auth()->user()->employee->cedula === $routeId || auth()->user()->employee->tipo === "admin") {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
