<?php

namespace App\Repositories\Type;

use App\Models\Type;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;

class TypeRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService,)
    {
        $this->baseService = $_baseService;
    }

    public function getData($id)
    {
        if ($id) {
            return Type::where('id', $id)->get();
        } else {
            return Type::select("id", "name")
                ->get();
        }
    }

    public function fetch($request)
    {
        $query = Type::select('id', $request->columns[0]);
        if ($request->search) {
            $query->where($request->columns[0], 'like', '%' . $request->search . '%');
        }

        if ($request->sorting) {
            $query->orderBy(strtolower($request->sorting[1]), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function save($validator, $request)
    {
        $data = array_merge($validator->validated(), ['tenant_id' => $request->userTenantId], $this->baseService->auditableInsert($request->userEmail));

        return BaseRepositories::store('types', $data);
    }

    public function updated($validator, $request)
    {
        $data = array_merge($validator->validated(), ['tenant_id' => $request->userTenantId],  $this->baseService->auditableUpdate($request->userEmail));

        return BaseRepositories::update('types', $data, $request->id);
    }

    public function destroyed($id)
    {
        return BaseRepositories::destroy('types', $id);
    }
}
