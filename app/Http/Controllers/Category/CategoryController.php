<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $_categoryService)
    {
        $this->categoryService = $_categoryService;
    }

    public function getAll()
    {
        $response   = $this->categoryService->getAll();

        return response()->json($response, $response['code']);
    }
}
