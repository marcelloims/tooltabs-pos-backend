<?php

namespace App\Repositories\DepartmentPerPosition;

use App\Models\DepartmentPerPosition;
use App\Repositories\BaseRepositories;

class DepartmentPerPositionRepository extends BaseRepositories
{
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
}
