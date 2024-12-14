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

    public function fetch($request)
    {
        $response   = $this->officeRepository->fetch($request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        }else{
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }

    public function getAll()
    {
        $response   = $this->officeRepository->getData($id = null);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        }else{
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
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

    public function getData($id)
    {
        $response   = $this->officeRepository->getData($id);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        }else{
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "getData"
            ];
        }
    }

    public function update($request)
    {
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

        $response = $this->officeRepository->updated($validator, $request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "message"   => "Data has been updated"
            ];
        }else{
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "update"
            ];
        }
    }

    public function destory($id)
    {
        $response = $this->officeRepository->destroyed($id);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "message"   => "Your file has been deleted"
            ];
        }else{
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "process"   => "delete"
            ];
        }
    }
}
