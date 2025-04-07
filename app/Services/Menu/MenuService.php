<?php

namespace App\Services\Menu;

use App\Repositories\Menu\MenuRepository;
use Symfony\Component\HttpFoundation\Response;

class MenuService
{
    protected $menuRepository;

    public function __construct(MenuRepository $_menuRepository)
    {
        $this->menuRepository = $_menuRepository;
    }

    public function getMenu($request)
    {
        $response = $this->menuRepository->getMenu($request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => "No Data"
            ];
        }
    }

    public function getAll($request)
    {
        $response = $this->menuRepository->getAll($request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => "No Data"
            ];
        }
    }

    public function update($request)
    {
        return $this->menuRepository->updated($request);
    }
}
