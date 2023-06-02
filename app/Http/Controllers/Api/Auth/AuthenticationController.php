<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\AuthenticationRequest  $request
     * @return \App\Contracts\Response
     */
    public function __invoke(AuthenticationRequest $request)
    {
        try {
            if (!$token = JWTAuth::attempt($request->toArray())) 
                return Response::json(
                    ['message' => 'INVALID CREDENTIALS'],
                    Response::MESSAGE_UNAUTHENTICATED,
                    Response::STATUS_UNAUTHENTICATED
                );
        } catch (JWTException $e) {
            return Response::json(
              ['message' => 'COULD NOT CREATE TOKEN'],
              Response::MESSAGE_SERVER_ERROR,
              Response::STATUS_SERVER_ERROR
            );
        }
        
        return Response::json([
            'token' => $token
        ]);
    }
}
