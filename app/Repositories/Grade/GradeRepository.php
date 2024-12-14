<?php

namespace App\Repositories\Grade;

use App\Models\Grade;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;

class GradeRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService,)
    {
        $this->baseService = $_baseService;
    }

    public function getData($id)
    {
        if ($id) {
            return Grade::where('id', $id)->get();
        }else{
            return Grade::select("id", "level")
            ->get();
        }
    }
}
