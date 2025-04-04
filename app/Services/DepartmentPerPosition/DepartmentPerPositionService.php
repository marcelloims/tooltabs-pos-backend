<?php

namespace App\Services\DepartmentPerPosition;

use App\Repositories\DepartmentPerPosition\DepartmentPerPositionRepository;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class DepartmentPerPositionService
{
    protected $departmentPerPositionRepository;

    public function __construct(DepartmentPerPositionRepository $_departmentPerPositionRepository)
    {
        $this->departmentPerPositionRepository = $_departmentPerPositionRepository;
    }

    public function fetch($request)
    {
        $response   = $this->departmentPerPositionRepository->fetch($request);

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
            'office_id'     => 'required|max:255',
            'department_id' => 'required|max:255',
            'position_id'   => 'required|max:255',
            'grade_id'      => 'required|max:255'
        ], [
            'office_id.required' => 'The office field is required',
            'department_id.required' => 'The department field is required',
            'position_id.required' => 'The position field is required',
            'grade_id.required' => 'The grade field is required',
        ]);

        if ($validator->fails()) {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "validation"
            ];
        }

        $dataFilter = ['tenant_id' => $request->userTenantId];

        $response = $this->departmentPerPositionRepository->save($dataFilter, $validator, $request->userEmail);

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
        $response   = $this->departmentPerPositionRepository->getData($id);

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
            'office_id'     => 'required|max:255',
            'department_id' => 'required|max:255',
            'position_id'   => 'required|max:255',
            'grade_id'      => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "validation"
            ];
        }

        $response = $this->departmentPerPositionRepository->updated($validator, $request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
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
        $response = $this->departmentPerPositionRepository->destroyed($id);

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
