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

    public function getMenu($department_per_position_id)
    {
        $response = $this->menuRepository->getMenu($department_per_position_id);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        }else{
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => "No Data"
            ];
        }
    }
}
