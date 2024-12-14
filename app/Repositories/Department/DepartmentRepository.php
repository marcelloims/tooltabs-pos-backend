<?php

namespace App\Repositories\Department;

use App\Models\Department;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;

class DepartmentRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService,)
    {
        $this->baseService = $_baseService;
    }

    public function getData($id)
    {
        if ($id) {
            return Department::where('id', $id)->get();
        }else{
            return Department::select("id", "code", "name")
            ->get();
        }
    }

    public function fetch($request)
    {
        $query = Department::select('id', $request->columns[0], $request->columns[1]);
        if ($request->search) {
          $query->where($request->columns[0], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[1], 'like', '%'.$request->search.'%');
        }

        if ($request->sorting) {
            $query->orderBy(strtolower($request->sorting[1]), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function save($validator, $userEmail){
        $data = array_merge(['tenant_id' => 1], $validator->validated(), $this->baseService->auditableInsert($userEmail));

        return BaseRepositories::store('Departments', $data);
    }

    public function updated($validator, $request)
    {
        $data = array_merge($validator->validated(), $this->baseService->auditableUpdate($request->userEmail));

        return BaseRepositories::update('Departments', $data, $request->id);
    }

    public function destroyed($id)
    {
        return BaseRepositories::destroy('Departments', $id);
    }
}
