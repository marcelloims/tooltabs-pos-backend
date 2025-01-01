<?php

namespace App\Services\Type;

use App\Repositories\Type\TypeRepository;
use Symfony\Component\HttpFoundation\Response;

class TypeService
{
    protected $typeRepository;

    public function __construct(TypeRepository $_typeRepository)
    {
        $this->typeRepository = $_typeRepository;
    }

    public function getAll()
    {
        $response   = $this->typeRepository->getData($id = null);

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
