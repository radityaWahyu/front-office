<?php

namespace App\Http\Middleware;

use Closure;

class AddAuthHeader
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
        //print_r($request);
        if(!$request->bearerToken()){
            if($request->hasCookie('token')){
                $token = $request->cookie('token');
                $request->headers->add(['Authorization' => 'Bearer '.$token]);
            }
        }
        return $next($request);
    }
}
