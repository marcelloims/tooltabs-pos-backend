<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthService {

    protected $authRepository;

    public function __construct(AuthRepository $_authRepository)
    {
        $this->authRepository = $_authRepository;
    }

    public function register($request)
    {
        $validator  = Validator::make($request->all(),[
            'department_per_position_id'    => 'required',
            'employee_id'                   => 'required',
            'username'                      => 'required|max:255',
            'email'                         => 'required|email|unique:users,email',
            'password'                      => 'required|confirmed|min:6'
        ]);

        if ($validator->fails()) {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "validation"
            ];
        }

        $anotherRequest = [
            "password"  => bcrypt($request->password),
            "activated" => 1
        ];

        $response = $this->authRepository->register($validator,  $anotherRequest);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_CREATED,
                "status"    => "success",
                "message"   => "Data has been created"
            ];
        }else{
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "insert"
            ];
        }
    }

}
