<?php

namespace App\Services\PermissionPerMenu;

use App\Repositories\PermissionPerMenu\PermissionPerMenuRepository;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

use function PHPSTORM_META\map;

class PermissionPerMenuService
{
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
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }

    public function fetch($request)
    {
        $response   = $this->permissionPerMenuRepository->fetch($request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }

    public function getMenu()
    {
        $response   = $this->permissionPerMenuRepository->getMenu();

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }

    public function save($request)
    {
        $validator  = Validator::make($request->all(), [
            'department_per_position_id'    => 'required|max:255',
            'name'                          => 'required|max:255',
            'office_id'                     => 'required|max:255',
            'selectCase'                    => 'required|max:255'
        ], [
            'department_per_position_id.required' => "field is required"
        ]);

        if ($validator->fails()) {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "validation"
            ];
        }

        $response = $this->permissionPerMenuRepository->save($request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_CREATED,
                "status"    => "success",
                "message"   => "Data has been created"
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "insert"
            ];
        }
    }

    public function edit($id)
    {
        $response   = $this->permissionPerMenuRepository->edit($id);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }

    public function getSelectedMenu($id)
    {
        $response   = $this->permissionPerMenuRepository->getSelectedMenu($id);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }

    public function updated($request)
    {
        $validator  = Validator::make($request->all(), [
            'department_per_position_id'    => 'required|max:255',
            'name'                          => 'required|max:255',
            'office_id'                     => 'required|max:255',
            'selectCase'                    => 'required|max:255'
        ], [
            'department_per_position_id.required' => "field is required"
        ]);

        if ($validator->fails()) {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "validation"
            ];
        }

        $response = $this->permissionPerMenuRepository->updated($request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_ACCEPTED,
                "status"    => "success",
                "message"   => "Data has been updated"
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "update"
            ];
        }
    }

    public function destroy($id)
    {
        $response = $this->permissionPerMenuRepository->destroyed($id);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "message"   => "Your file has been deleted"
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "process"   => "delete"
            ];
        }
    }
}
