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
}
