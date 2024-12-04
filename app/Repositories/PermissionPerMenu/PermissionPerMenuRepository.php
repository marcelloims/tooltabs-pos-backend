<?php

namespace App\Repositories\PermissionPerMenu;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\User;
use App\Repositories\BaseRepositories;

class PermissionPerMenuRepository extends BaseRepositories
{
    public function permission_per_menu($userId)
    {
        return User::join('department_per_positions', 'users.department_per_position_id', '=', 'department_per_positions.id')
        ->join('permissions', 'permissions.department_per_position_id', '=', 'department_per_positions.id')
        ->select(
            'users.id as user_id',
            'department_per_positions.office_id',
            'department_per_positions.department_id',
            'department_per_positions.position_id',
            'permissions.write',
            'permissions.read')
        ->where('users.id', $userId)
        ->first();
    }

    public function fetch($request)
    {
        $query = Permission::select('id', $request->columns[0]);
        if ($request->search) {
          $query->where($request->columns[0], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[1], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[2], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[3], 'like', '%'.$request->search.'%');
        }

        if ($request->sorting) {
            $query->orderBy(strtolower($request->sorting[1]), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function getMenu()
    {
        return Menu::get();
    }
}
