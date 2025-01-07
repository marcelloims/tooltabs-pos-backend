<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Services\Department\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $_departmentService)
    {
        $this->departmentService    = $_departmentService;
    }

    public function fetch(Request $request)
    {
        $response   = $this->departmentService->fetch($request);

        return response()->json($response, $response['code']);
    }

    public function getAll()
    {
        $response   = $this->departmentService->getAll();

        return response()->json($response, $response['code']);
    }

    public function store(Request $request)
    {
        $response   = $this->departmentService->save($request);

        return response()->json($response, $response['code']);
    }

    public function edit($id){
        $response   = $this->departmentService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function update(Request $request)
    {
        $response = $this->departmentService->update($request);

        return response()->json($response, $response['code']);
    }

    public function detail($id)
    {
        $response = $this->departmentService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function destroy($id){
        $response   = $this->departmentService->destory($id);

        return response()->json($response, $response['code']);
    }
}
