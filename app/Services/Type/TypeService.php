<?php

namespace App\Services\Type;

use App\Repositories\Type\TypeRepository;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TypeService
{
    protected $typeRepository;

    public function __construct(TypeRepository $_typeRepository)
    {
        $this->typeRepository = $_typeRepository;
    }

    public function getAll()
    {
        $response   = $this->typeRepository->getData($id = null);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }

    public function fetch($request)
    {
        $response   = $this->typeRepository->fetch($request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }

    public function save($request)
    {
        $validator  = Validator::make($request->all(), [
            'name'      => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "validation"
            ];
        }

        $response = $this->typeRepository->save($validator, $request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_CREATED,
                "status"    => "success",
                "message"   => "Data has been created"
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "insert"
            ];
        }
    }

    public function getData($id)
    {
        $response   = $this->typeRepository->getData($id);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "getData"
            ];
        }
    }

    public function update($request)
    {
        $validator  = Validator::make($request->all(), [
            'name'      => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "validation"
            ];
        }

        $response = $this->typeRepository->updated($validator, $request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_CREATED,
                "status"    => "success",
                "message"   => "Data has been updated"
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "update"
            ];
        }
    }

    public function destory($id)
    {
        $response = $this->typeRepository->destroyed($id);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "message"   => "Your file has been deleted"
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "process"   => "delete"
            ];
        }
    }
}
