<?php

namespace App\Repositories\Menu;

use App\Models\Menu;
use App\Models\Permission;
use App\Repositories\BaseRepositories;
use Illuminate\Support\Facades\DB;

class MenuRepository extends BaseRepositories
{
    protected $table = 'menus';

    public function getMenu($department_per_position_id)
    {
        return Menu::with('submenus')
        ->join('permission_per_menus', 'permission_per_menus.menu_id', '=', 'menus.id')
        ->join('permissions', 'permission_per_menus.permission_id', '=', 'permissions.id')
        ->where('permissions.department_per_position_id', $department_per_position_id)
        ->select('permissions.department_per_position_id', 'permission_per_menus.id', 'permission_per_menus.permission_id', 'menus.id', 'menus.name', 'menus.url', 'menus.sequent', 'menus.expand', 'menus.icon')
        ->get();
    }

    public function updated($request)
    {
        if ($request->menuId > 0) {
            return BaseRepositories::update('menus', ['expand' => $request->valueExpand], $request->menuId);
        }else{
            Menu::query()->update(['expand' => $request->valueExpand]);
        }
    }
}
