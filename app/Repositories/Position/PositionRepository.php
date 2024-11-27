<?php

namespace App\Repositories\Position;

use App\Models\Position;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;

class PositionRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService,)
    {
        $this->baseService = $_baseService;
    }

    public function getData($id)
    {
        if ($id) {
            return Position::where('id', $id)->get();
        }else{
            return Position::get();
        }
    }

    public function fetch($request)
    {
        $query = Position::select('id', $request->columns[0], $request->columns[1]);
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
        $data = array_merge(['tenant_id' => 1], $validator->validated(), $this->baseService->auditableInsert($userEmail));

        return BaseRepositories::store('positions', $data);
    }

    public function updated($validator, $request)
    {
        $data = array_merge($validator->validated(), $this->baseService->auditableUpdate($request->userEmail));

        return BaseRepositories::update('positions', $data, $request->id);
    }

    public function destroyed($id)
    {
        return BaseRepositories::destroy('positions', $id);
    }
}
