<?php

namespace App\Services\Grade;

use App\Repositories\Grade\GradeRepository;
use Symfony\Component\HttpFoundation\Response;

class GradeService
{
    protected $gradeRepository;

    public function __construct(GradeRepository $_gradeRepository)
    {
        $this->gradeRepository = $_gradeRepository;
    }

    public function getAll()
    {
        $response   = $this->gradeRepository->getData($id = null);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        }else{
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }
}
