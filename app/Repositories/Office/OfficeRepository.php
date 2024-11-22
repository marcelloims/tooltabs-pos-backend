<?php

namespace App\Repositories\Office;

use App\Models\Office;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;
use Faker\Provider\Base;

class OfficeRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService,)
    {
        $this->baseService = $_baseService;
    }

    public function getData($id)
    {
        if ($id) {
            return Office::where('id', $id)->get();
        }else{
            return Office::get();
        }
    }

    public function fetch($request)
    {
        $query = Office::select('id', 'code', 'name', 'email', 'phone');
        if ($request->search) {
          $query->where($request->columns[0], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[1], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[2], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[3], 'like', '%'.$request->search.'%');
        }

        if ($request->sorting) {
            $query->orderBy(strtolower($request->sorting[1]), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function save($validator, $userEmail){
        $data = array_merge($validator->validated(), $this->baseService->auditableInsert($userEmail));

        return BaseRepositories::store('offices', $data);
    }

    public function updated($validator, $request)
    {
        $data = array_merge($validator->validated(), $this->baseService->auditableUpdate($request->userEmail));

        return BaseRepositories::update('offices', $data, $request->id);
    }

    public function destroyed($id)
    {
        return BaseRepositories::destroy('offices', $id);
    }
}
