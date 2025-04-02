<?php

namespace App\Repositories\UserMaster;

use App\Models\Employee;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;

class UserMasterRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService,)
    {
        $this->baseService = $_baseService;
    }

    public function getData($id)
    {
        if ($id) {
            return Employee::where('id', $id)->get();
        } else {
            return Employee::select("id", "name")
                ->get();
        }
    }

    public function fetch($request)
    {
        $query = Employee::join('users', 'employees.id', '=', 'users.employee_id')
            ->select(
                'users.id',
                $request->columns[0],
                'email',
                $request->columns[1],
                'telephone',
                $request->columns[2],
                'activated',
                $request->columns[3],
            );
        if ($request->search) {
            $query->where($request->columns[0], 'like', '%' . $request->search . '%');
        }

        if ($request->sorting) {
            $query->orderBy(strtolower($request->sorting[1]), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function save($validator, $userEmail)
    {
        $data = array_merge($validator->validated(), $this->baseService->auditableInsert($userEmail));

        return BaseRepositories::store('types', $data);
    }

    public function updated($validator, $request)
    {
        $data = array_merge($validator->validated(), $this->baseService->auditableUpdate($request->userEmail));

        return BaseRepositories::update('types', $data, $request->id);
    }

    public function destroyed($id)
    {
        return BaseRepositories::destroy('types', $id);
    }
}
