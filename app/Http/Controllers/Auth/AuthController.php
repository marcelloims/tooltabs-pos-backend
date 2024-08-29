<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Auht;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $_authService)
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
        $this->authService = $_authService;
    }

    public function register(Request $request){
        $response   = $this->authService->register($request);

        return response()->json($response);
    }

    public function login(Request $request){

    }
}
