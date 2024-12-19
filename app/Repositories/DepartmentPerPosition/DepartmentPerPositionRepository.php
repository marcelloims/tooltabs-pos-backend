<?php

namespace App\Repositories\DepartmentPerPosition;

use App\Models\DepartmentPerPosition;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;

class DepartmentPerPositionRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService)
    {
        $this->baseService = $_baseService;
    }

    public function getData($id)
    {
        if ($id) {
            return DepartmentPerPosition::select('id', 'office_id', 'department_id', 'position_id','grade_id')->where('id', $id)->first();
        }else{
            return DepartmentPerPosition::select('id', 'office_id', 'department_id', 'position_id','grade_id')->get();
        }
    }

    public function fetch($request)
    {
        $query = DepartmentPerPosition::select('department_per_positions.id', 'departments.name as ' . $request->columns[0], 'positions.name as ' . $request->columns[1], 'grades.level as ' . $request->columns[2])
        ->join('departments', 'department_per_positions.department_id', '=', 'departments.id')
        ->join('positions', 'department_per_positions.position_id', '=', 'positions.id')
        ->join('grades', 'department_per_positions.grade_id', '=', 'grades.id');

        if ($request->search) {
          $query->where('departments.name', 'like', '%'.$request->search.'%')
            ->orWhere("positions.name", 'like', '%'.$request->search.'%')
            ->orWhere("grades.level", 'like', '%'.$request->search.'%');
        }

        if ($request->sorting) {
            $query->orderBy(strtolower($request->sorting[1]), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function save($validator, $userEmail){
        $data = array_merge($validator->validated(), $this->baseService->auditableInsert($userEmail));

        return BaseRepositories::store('department_per_positions', $data);
    }

    public function updated($validator, $request)
    {
        $data = array_merge($validator->validated(), $this->baseService->auditableUpdate($request->userEmail));

        return BaseRepositories::update('department_per_positions', $data, $request->id);
    }

    public function destroyed($id)
    {
        return BaseRepositories::destroy('department_per_positions', $id);
    }
}
