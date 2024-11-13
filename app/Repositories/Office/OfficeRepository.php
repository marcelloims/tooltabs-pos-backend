<?php

namespace App\Repositories\Office;

use App\Repositories\BaseRepositories;
use App\Services\BaseService;

class OfficeRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService,)
    {
        $this->baseService = $_baseService;
    }

    public function save($validator, $userEmail){
        $data = array_merge($validator->validated(), $this->baseService->auditableInsert($userEmail));

        return BaseRepositories::store('offices', $data);
    }
}
