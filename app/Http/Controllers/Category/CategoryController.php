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

    public function fetch(Request $request)
    {
        $response   = $this->categoryService->fetch($request);

        return response()->json($response, $response['code']);
    }

    public function store(Request $request)
    {
        $response   = $this->categoryService->save($request);

        return response()->json($response, $response['code']);
    }

    public function edit($id){
        $response   = $this->categoryService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function update(Request $request)
    {
        $response = $this->categoryService->update($request);

        return response()->json($response, $response['code']);
    }

    public function detail($id)
    {
        $response = $this->categoryService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function destroy($id){
        $response   = $this->categoryService->destory($id);

        return response()->json($response, $response['code']);
    }
}
