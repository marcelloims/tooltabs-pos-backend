<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Services\Pos\PosService;
use Illuminate\Http\Request;

class PosContorller extends Controller
{
    protected $posService;

    public function __construct(PosService $_posService)
    {
        $this->posService = $_posService;
    }

    public function getFood(Request $request)
    {
        $response   = $this->posService->getFood($request);

        return response()->json($response, $response['code']);
    }

    public function searchFood(Request $request)
    {
        $response   = $this->posService->searchFood($request);

        return response()->json($response, $response['code']);
    }

    public function getCategory(Request $request)
    {
        $response   = $this->posService->getCategory($request);

        return response()->json($response, $response['code']);
    }

    public function getDetailFood($id)
    {
        $response   = $this->posService->getDetailFood($id);

        return response()->json($response, $response['code']);
    }
}
