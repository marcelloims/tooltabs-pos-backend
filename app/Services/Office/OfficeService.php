<?php

namespace App\Services\Office;

use App\Repositories\Office\OfficeRepository;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class OfficeService {

    protected $officeRepository;

    public function __construct(OfficeRepository $_officeRepository)
    {
        $this->officeRepository = $_officeRepository;
    }

    public function save($request){
        $validator  = Validator::make($request->all(),[
            'name'      => 'required|max:255',
            'code'      => 'required|max:255',
            'email'     => 'required|email|unique:users,email|max:255',
            'phone'     => 'required|max:15',
            'address'   => 'required'
        ]);

        if ($validator->fails()) {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "validation"
            ];
        }

        $response = $this->officeRepository->save($validator, $request->userEmail);

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
