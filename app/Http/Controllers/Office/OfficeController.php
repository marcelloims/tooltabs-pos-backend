<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Services\BaseService;
use App\Services\Office\OfficeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    protected $officeService;
    protected $baseService;

    public function __construct(OfficeService $_menuService, BaseService $_baseService)
    {
        $this->officeService    = $_menuService;
        $this->baseService      = $_baseService;
    }

    public function fetch(Request $request)
    {
        $response   = $this->officeService->fetch($request);

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

    public function destroy($id){
        $response   = $this->officeService->destory($id);

        return response()->json($response, $response['code']);
    }
}
