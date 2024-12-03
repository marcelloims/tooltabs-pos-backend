<?php

namespace App\Http\Controllers\DepartmentPerPosition;

use App\Http\Controllers\Controller;
use App\Services\DepartmentPerPosition\DepartmentPerPositionService;
use Illuminate\Http\Request;

class DepartmentPerPositionController extends Controller
{
    protected $departmentPerPositionService;

    public function __construct(DepartmentPerPositionService $_departmentPerPositionService)
    {
        $this->departmentPerPositionService = $_departmentPerPositionService;
    }

    public function fetch(Request $request)
    {
       $response   = $this->departmentPerPositionService->fetch($request);

        return response()->json($response, $response['code']);
    }
}
