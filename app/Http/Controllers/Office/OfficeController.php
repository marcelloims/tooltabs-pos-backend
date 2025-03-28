<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Services\Office\OfficeService;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    protected $officeService;

    public function __construct(OfficeService $_menuService)
    {
        $this->officeService    = $_menuService;
    }

    public function fetch(Request $request)
    {
        $response   = $this->officeService->fetch($request);

        return response()->json($response, $response['code']);
    }

    public function getAll()
    {
        $response   = $this->officeService->getAll();

        return response()->json($response, $response['code']);
    }

    public function store(Request $request)
    {
        $response   = $this->officeService->save($request);

        return response()->json($response, $response['code']);
    }

    public function edit($id){
        $response   = $this->officeService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function update(Request $request)
    {
        $response = $this->officeService->update($request);

        return response()->json($response, $response['code']);
    }

    public function detail($id)
    {
        $response = $this->officeService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function destroy($id){
        $response   = $this->officeService->destory($id);

        return response()->json($response, $response['code']);
    }
}
