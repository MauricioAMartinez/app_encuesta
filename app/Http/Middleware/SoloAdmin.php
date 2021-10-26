<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoloAdmin
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
        switch(Auth::user()->tipo){
            case ('1'):
                return $next($request);//si es administrador continua al HOME
            break;
			default:
                return redirect('home');// si es un usuario normal redirige a la ruta USER
			break;	

        }
    }
}
