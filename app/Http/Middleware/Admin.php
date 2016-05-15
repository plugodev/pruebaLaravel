<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }else {
            if(Auth::guard($guard)->user()->tipo_usuario_id != 1){
                session()->flash('mensaje', 'No autorizado!');
                session()->flash('type', 'error');
                return redirect()->route('inicio');
            }
        }

        return $next($request);
    }
}
