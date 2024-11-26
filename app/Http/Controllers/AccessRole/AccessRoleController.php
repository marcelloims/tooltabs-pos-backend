<?php

namespace App\Http\Controllers\AccessRole;

use App\Http\Controllers\Controller;
use App\Services\PermissionPerMenu\PermissionPerMenuService;
use Illuminate\Http\Request;

class AccessRoleController extends Controller
{
    protected $permissionPerMenuService;

    public function __construct(PermissionPerMenuService $_permissionPerMenuService)
    {
        $this->permissionPerMenuService    = $_permissionPerMenuService;
    }

    public function permission_per_menu($userId)
    {
        $response   = $this->permissionPerMenuService->permission_per_menu($userId);

        return response()->json($response, $response['code']);
    }
}
