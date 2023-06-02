<?php

namespace App\Http\Middleware;

use App\Contracts\Response;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return Response::json(
                    ['message' => 'Unauthenticated'],
                    Response::MESSAGE_UNAUTHENTICATED,
                    Response::STATUS_UNAUTHENTICATED
                );
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return Response::json(
                    ['message' => 'Token expired'],
                    Response::MESSAGE_UNAUTHENTICATED,
                    Response::STATUS_UNAUTHENTICATED
                );
            } else {
                return Response::json(
                    null,
                    Response::MESSAGE_UNAUTHENTICATED,
                    Response::STATUS_UNAUTHENTICATED
                );            
            }
        }

        return $next($request);
    }
}
