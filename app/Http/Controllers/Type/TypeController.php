<?php

namespace App\Http\Controllers\Type;

use App\Http\Controllers\Controller;
use App\Services\Type\TypeService;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    protected $typeService;

    public function __construct(TypeService $_typeService)
    {
        $this->typeService = $_typeService;
    }

    public function getAll()
    {
        $response   = $this->typeService->getAll();

        return response()->json($response, $response['code']);
    }

    public function fetch(Request $request)
    {
        $response   = $this->typeService->fetch($request);

        return response()->json($response, $response['code']);
    }

    public function store(Request $request)
    {
        $response   = $this->typeService->save($request);

        return response()->json($response, $response['code']);
    }

    public function edit($id){
        $response   = $this->typeService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function update(Request $request)
    {
        $response = $this->typeService->update($request);

        return response()->json($response, $response['code']);
    }

    public function detail($id)
    {
        $response = $this->typeService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function destroy($id){
        $response   = $this->typeService->destory($id);

        return response()->json($response, $response['code']);
    }
}
