<?php

namespace App\Repositories\PermissionPerMenu;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\PermissionPerMenu;
use App\Models\User;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;

class PermissionPerMenuRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService)
    {
        $this->baseService = $_baseService;
    }

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
                'permissions.read'
            )
            ->where('users.id', $userId)
            ->first();
    }

    public function fetch($request)
    {
        $query = Permission::join('offices', 'offices.id', '=', 'permissions.office_id')
            ->join('department_per_positions', 'department_per_positions.id', '=', 'permissions.department_per_position_id')
            ->where('permissions.tenant_id', $request->userTenantId)
            ->select('permissions.id', "permissions.name as " . $request->columns[0], 'offices.name as office_name');
        if ($request->search) {
            $query->where('permissions.' . $request->columns[0], 'like', '%' . $request->search . '%')
                ->orWhere('offices.name', 'like', '%' . $request->search . '%');
        }

        if ($request->sorting) {
            $query->orderBy(strtolower($this->formatCaseColumn($request->sorting[1])), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function getMenu()
    {
        return Menu::get();
    }

    public function save($request)
    {
        $permission = [];
        if ($request->selectCase == "write") {
            $permission =  [
                'tenant_id'                     => $request->userTenantId,
                'office_id'                     => $request->office_id,
                'name'                          => $request->name,
                'department_per_position_id'    => $request->department_per_position_id,
                'write'                         => 1,
                'read'                          => 0
            ];
        } else {
            $permission =  [
                'tenant_id'                     => $request->userTenantId,
                'office_id'                     => $request->office_id,
                'name'                          => $request->name,
                'department_per_position_id'    => $request->department_per_position_id,
                'write'                         => 0,
                'read'                          => 1
            ];
        }


        $permission_id = Permission::insertGetId($permission);

        foreach ($request->checkedList as $value) {
            $permissionMenu = [
                'permission_id' => $permission_id,
                'menu_id'       => $value
            ];

            PermissionPerMenu::insert($permissionMenu);
        }

        return true;
    }

    public function edit($id)
    {
        return Permission::where('id', $id)->first();
    }

    public function getSelectedMenu($id)
    {
        return PermissionPerMenu::where('permission_id', $id)
            ->select('menu_id')
            ->get();
    }

    public function formatCaseColumn($text)
    {
        $dataExplodes = explode(" ", $text);
        $result = join("_", $dataExplodes);

        return $result;
    }

    public function updated($request)
    {
        $permission = [];
        if ($request->selectCase == "write") {
            $permission =  [
                'tenant_id'                     => $request->userTenantId,
                'office_id'                     => $request->office_id,
                'name'                          => $request->name,
                'department_per_position_id'    => $request->department_per_position_id,
                'write'                         => 1,
                'read'                          => 0
            ];
        } else {
            $permission =  [
                'tenant_id'                     => $request->userTenantId,
                'office_id'                     => $request->office_id,
                'name'                          => $request->name,
                'department_per_position_id'    => $request->department_per_position_id,
                'write'                         => 0,
                'read'                          => 1
            ];
        }


        Permission::where('id', $request->id)->update(array_merge($permission, $this->baseService->audiTableUpdate($request->email)));

        PermissionPerMenu::where('permission_id', $request->id)->delete();

        foreach ($request->checkedList as $value) {
            $permissionMenu = [
                'permission_id' => $request->id,
                'menu_id'       => $value
            ];

            PermissionPerMenu::insert(array_merge($permissionMenu, $this->baseService->audiTableInsert($request->email)));
        }

        return true;
    }
}
