<?php

namespace App\Services\DepartmentPerPosition;

use App\Repositories\DepartmentPerPosition\DepartmentPerPositionRepository;
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
        }else{
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }
}
