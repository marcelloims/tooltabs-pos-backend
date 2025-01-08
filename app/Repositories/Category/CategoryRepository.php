<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;

class CategoryRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService,)
    {
        $this->baseService = $_baseService;
    }

    public function getData($id)
    {
        if ($id) {
            return Category::where('id', $id)->get();
        }else{
            return Category::select("id", "name")
            ->get();
        }
    }

    public function fetch($request)
    {
        $query = Category::select('id', $request->columns[0]);
        if ($request->search) {
          $query->where($request->columns[0], 'like', '%'.$request->search.'%');
        }

        if ($request->sorting) {
            $query->orderBy(strtolower($request->sorting[1]), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function save($validator, $userEmail){
        $data = array_merge($validator->validated(), $this->baseService->auditableInsert($userEmail));

        return BaseRepositories::store('categories', $data);
    }

    public function updated($validator, $request)
    {
        $data = array_merge($validator->validated(), $this->baseService->auditableUpdate($request->userEmail));

        return BaseRepositories::update('categories', $data, $request->id);
    }

    public function destroyed($id)
    {
        return BaseRepositories::destroy('categories', $id);
    }
}
