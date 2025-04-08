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

    public function fetch(Request $request)
    {
        $response   = $this->permissionPerMenuService->fetch($request);

        return response()->json($response, $response['code']);
    }

    public function store(Request $request)
    {
        $response   = $this->permissionPerMenuService->save($request);

        return response()->json($response, $response['code']);
    }

    public function edit($id)
    {
        $response   = $this->permissionPerMenuService->edit($id);

        return response()->json($response, $response['code']);
    }

    public function getSelectedMenu($id)
    {
        $response   = $this->permissionPerMenuService->getSelectedMenu($id);

        return response()->json($response, $response['code']);
    }

    public function update(Request $request)
    {
        $response   = $this->permissionPerMenuService->updated($request);

        return response()->json($response, $response['code']);
    }

    public function destroy($id)
    {
        $response   = $this->permissionPerMenuService->destroy($id);

        return response()->json($response, $response['code']);
    }
}
