<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $_categoryRepository)
    {
        $this->categoryRepository = $_categoryRepository;
    }

    public function getAll()
    {
        $response   = $this->categoryRepository->getData($id = null);

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
