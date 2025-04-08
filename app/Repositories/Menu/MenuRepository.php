<?php

namespace App\Repositories\Menu;

use App\Models\Menu;
use App\Models\Permission;
use App\Repositories\BaseRepositories;
use Illuminate\Support\Facades\DB;

class MenuRepository extends BaseRepositories
{
    protected $table = 'menus';

    public function getMenu($request)
    {
        return Menu::with('submenus')
            ->join('permission_per_menus', 'permission_per_menus.menu_id', '=', 'menus.id')
            ->join('permissions', 'permission_per_menus.permission_id', '=', 'permissions.id')
            ->where('permissions.tenant_id', $request->userTenantId)
            ->where('permissions.office_id', $request->userOfficeId)
            ->where('permissions.department_per_position_id', $request->userDepartmentPerPositionId)
            ->select('permissions.department_per_position_id', 'permission_per_menus.id', 'permission_per_menus.permission_id', 'menus.id', 'menus.name', 'menus.url', 'menus.sequent', 'menus.expand', 'menus.icon')
            ->get();
    }

    public function getAll($request)
    {
        return Menu::with('submenus')
            ->get();
    }

    public function updated($request)
    {
        if ($request->menuId > 0) {
            return BaseRepositories::update('menus', ['expand' => $request->valueExpand], $request->menuId);
        } else {
            Menu::query()->update(['expand' => $request->valueExpand]);
        }
    }
}
