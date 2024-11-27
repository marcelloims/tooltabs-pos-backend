<?php

namespace App\Http\Controllers\Position;

use App\Http\Controllers\Controller;
use App\Services\Position\PositionService;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    protected $positionService;

    public function __construct(PositionService $_positionService)
    {
        $this->positionService = $_positionService;
    }

    public function fetch(Request $request)
    {
        $response   = $this->positionService->fetch($request);

        return response()->json($response, $response['code']);
    }

    public function store(Request $request)
    {
        $response   = $this->positionService->save($request);

        return response()->json($response, $response['code']);
    }

    public function edit($id){
        $response   = $this->positionService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function update(Request $request){
        $response   = $this->positionService->update($request);

        return response()->json($response, $response['code']);
    }

    public function destroy($id){
        $response   = $this->positionService->destory($id);

        return response()->json($response, $response['code']);
    }
}
