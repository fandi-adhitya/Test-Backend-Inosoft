<?php

namespace App\Http\Controllers\Api\Me;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \App\Contracts\Response 
     */
    public function __invoke()
    {
        $user = Auth::user();

        return Response::json($user);
    }
}
