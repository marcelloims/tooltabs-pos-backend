<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Auht;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
        $response   = $this->authService->login($request);

        return response()->json($response, $response['code']);
    }

    public function logout(Request $request){
        Auth::logout();
        return response()->json([
            "code"      => Response::HTTP_OK,
            "message"   => "You have been logged out!"
        ]);
    }

    public function profile(){
        return response()->json(Auth::user());
    }
}
