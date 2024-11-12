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

    public function getMenu($department_per_position_id)
    {
        $response   = $this->menuService->getMenu($department_per_position_id);

        return response()->json($response);
    }
}
