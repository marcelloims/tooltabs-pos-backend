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
            return DepartmentPerPosition::select('id', 'office_id', 'department_id', 'position_id', 'grade_id')->where('id', $id)->first();
        } else {
            return DepartmentPerPosition::select('id', 'office_id', 'department_id', 'position_id', 'grade_id')->get();
        }
    }

    public function fetch($request)
    {
        $query = DepartmentPerPosition::join('departments', 'department_per_positions.department_id', '=', 'departments.id')
            ->join('positions', 'department_per_positions.position_id', '=', 'positions.id')
            ->join('grades', 'department_per_positions.grade_id', '=', 'grades.id')
            ->join('offices', 'department_per_positions.office_id', '=', 'offices.id')
            ->where('department_per_positions.tenant_id', $request->userTenantId)
            // ->where('department_per_positions.office_id', $request->userOfficeId)
            ->select('department_per_positions.id', 'departments.name as ' . $request->columns[0], 'positions.name as ' . $request->columns[1], 'grades.level as ' . $request->columns[2], 'offices.name as ' . $request->columns[3]);

        if ($request->search) {
            $query->where('departments.name', 'like', '%' . $request->search . '%')
                ->orWhere("positions.name", 'like', '%' . $request->search . '%')
                ->orWhere("grades.level", 'like', '%' . $request->search . '%')
                ->orWhere("offices.name", 'like', '%' . $request->search . '%');
        }

        if ($request->sorting) {
            $query->orderBy(strtolower($this->formatCaseColumn($request->sorting[1])), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function getAll($request)
    {
        return DepartmentPerPosition::join('departments', 'department_per_positions.department_id', '=', 'departments.id')
            ->join('offices', 'department_per_positions.office_id', '=', 'offices.id')
            ->join('positions', 'department_per_positions.position_id', '=', 'positions.id')
            ->where('department_per_positions.tenant_id',  $request->userTenantId)
            ->select('department_per_positions.id', 'departments.code as department_code', 'offices.name as office_name', 'positions.code as position_code')
            ->get();
    }

    public function save($dataFilter, $validator, $userEmail)
    {
        $data = array_merge($dataFilter, $validator->validated(), $this->baseService->auditableInsert($userEmail));

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

    public function formatCaseColumn($text)
    {
        $dataExplodes = explode(" ", $text);
        $result = join("_", $dataExplodes);

        return $result;
    }
}
