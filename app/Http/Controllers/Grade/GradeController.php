<?php

namespace App\Http\Controllers\Grade;

use App\Http\Controllers\Controller;
use App\Services\Grade\GradeService;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    protected $gradeService;

    public function __construct(GradeService $_gradeService)
    {
        $this->gradeService = $_gradeService;
    }

    public function getAll()
    {
       $response   = $this->gradeService->getAll();

        return response()->json($response, $response['code']);
    }
}
