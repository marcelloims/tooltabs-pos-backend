<?php

namespace App\Services\PermissionPerMenu;

use App\Repositories\PermissionPerMenu\PermissionPerMenuRepository;
use Symfony\Component\HttpFoundation\Response;

class PermissionPerMenuService {
    protected $permissionPerMenuRepository;

    public function __construct(PermissionPerMenuRepository $_permissionPerMenuRepository)
    {
        $this->permissionPerMenuRepository    = $_permissionPerMenuRepository;
    }

    public function permission_per_menu($userId)
    {
        $response   = $this->permissionPerMenuRepository->permission_per_menu($userId);

         if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        }else{
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }
}
