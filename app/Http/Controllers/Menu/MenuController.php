<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Services\Menu\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $_menuService)
    {
        $this->menuService = $_menuService;
    }

    public function getMenu(Request $request)
    {
        $response   = $this->menuService->getMenu($request);

        return response()->json($response);
    }

    public function getAll(Request $request)
    {
        $response   = $this->menuService->getAll($request);

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $this->menuService->update($request);

        $response   = $this->menuService->getMenu($request);

        return response()->json($response, $response['code']);
    }
}
