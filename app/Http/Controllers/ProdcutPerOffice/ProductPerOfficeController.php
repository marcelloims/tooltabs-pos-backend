<?php

namespace App\Http\Controllers\ProdcutPerOffice;

use App\Http\Controllers\Controller;
use App\Services\ProductPerOffice\ProductPerOfficeService;
use Illuminate\Http\Request;

class ProductPerOfficeController extends Controller
{
    protected $productPerOfficeService;

    public function __construct(ProductPerOfficeService $_productPerOfficeService)
    {
        $this->productPerOfficeService = $_productPerOfficeService;
    }

    public function fetch(Request $request)
    {
        $response   = $this->productPerOfficeService->fetch($request);

        return response()->json($response, $response['code']);
    }

    public function store(Request $request)
    {
        $response   = $this->productPerOfficeService->save($request);

        return response()->json($response, $response['code']);
    }

    public function edit($id){
        $response   = $this->productPerOfficeService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function update(Request $request)
    {
        $response   = $this->productPerOfficeService->update($request);

        return response()->json($response, $response['code']);
    }

    public function destroy($id){
        $response   = $this->productPerOfficeService->destory($id);

        return response()->json($response, $response['code']);
    }
}
