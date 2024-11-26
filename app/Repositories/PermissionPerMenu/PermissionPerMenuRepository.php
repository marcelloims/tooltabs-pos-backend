<?php

namespace App\Repositories\PermissionPerMenu;

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
            'permissions.name',
            'permissions.added',
            'permissions.edited',
            'permissions.deleted',
            'permissions.viewed')
        ->where('users.id', $userId)
        ->first();
    }
}
