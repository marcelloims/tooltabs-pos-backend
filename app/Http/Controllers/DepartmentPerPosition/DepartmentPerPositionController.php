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

    public function store(Request $request)
    {
        $response   = $this->departmentPerPositionService->save($request);

        return response()->json($response, $response['code']);
    }

    public function edit($id)
    {
        $response   = $this->departmentPerPositionService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function update(Request $request)
    {
        $response = $this->departmentPerPositionService->update($request);

        return response()->json($response, $response['code']);
    }

    public function destroy($id){
        $response   = $this->departmentPerPositionService->destory($id);

        return response()->json($response, $response['code']);
    }
}
