<?php

namespace App\Repositories\Menu;

use App\Models\Permission;
use App\Repositories\BaseRepositories;

class MenuRepository extends BaseRepositories
{
    protected $table = 'menus';

    public function getMenu($department_per_position_id)
    {
        return Permission::join('permission_per_menus', 'permissions.id', '=', 'permission_per_menus.permission_id')
        ->join('menus', 'permission_per_menus.menu_id', '=', 'menus.id')
        ->where('permissions.department_per_position_id', $department_per_position_id)
        ->select('permissions.department_per_position_id', 'permission_per_menus.id', 'permission_per_menus.permission_id', 'menus.id', 'menus.name', 'menus.submenu', 'menus.url', 'menus.sequent', 'menus.icon')
        ->get();
    }
}
