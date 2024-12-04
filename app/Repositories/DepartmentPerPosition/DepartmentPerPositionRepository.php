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
            return DepartmentPerPosition::where('id', $id)->get();
        }else{
            return DepartmentPerPosition::get();
        }
    }

    public function fetch($request)
    {
        $query = DepartmentPerPosition::select('department_per_positions.id', $request->columns[0], $request->columns[1], $request->columns[2], $request->columns[3], 'departments.name as ' . $request->columns[4], 'positions.name as ' . $request->columns[5], 'grades.level as ' . $request->columns[6])
        ->join('departments', 'department_per_positions.department_id', '=', 'departments.id')
        ->join('positions', 'department_per_positions.position_id', '=', 'positions.id')
        ->join('grades', 'department_per_positions.grade_id', '=', 'grades.id');

        if ($request->search) {
          $query->where($request->columns[0], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[1], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[2], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[3], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[4], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[5], 'like', '%'.$request->search.'%')
            ->orWhere($request->columns[6], 'like', '%'.$request->search.'%');
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
