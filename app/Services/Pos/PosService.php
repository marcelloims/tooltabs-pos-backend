<?php

namespace App\Services\Pos;

use App\Repositories\Pos\PosRepository;
use Symfony\Component\HttpFoundation\Response;

class PosService
{
    protected $posRepository;

    public function __construct(PosRepository $_posRepository)
    {
        $this->posRepository = $_posRepository;
    }

    public function getFood($request)
    {
        $response   = $this->posRepository->getFood($request);

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

    public function getDetailFood($id)
    {
        $response   = $this->posRepository->getDetailFood($id);

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
