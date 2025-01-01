<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;

class ProductRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService,)
    {
        $this->baseService = $_baseService;
    }

    public function getData($id)
    {
        if ($id) {
            return Product::where('id', $id)->get();
        }else{
            return Product::select("id", "code", "name")->get();
        }
    }

    public function fetch($request)
    {
        $query = Product::select('id', $request->columns[0], $request->columns[1], $request->columns[2]);

        if ($request->search) {
          $query->where('pcode', 'like', '%'.$request->search.'%')
            ->orWhere("name", 'like', '%'.$request->search.'%')
            ->orWhere("status", 'like', '%'.$request->search.'%');
        }

        if ($request->sorting) {
            $query->orderBy(strtolower($request->sorting[1]), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function save($validator, $userEmail){
        $data = array_merge($validator->validated(), $this->baseService->auditableInsert($userEmail));

        return BaseRepositories::store('products', $data);
    }

    public function updated($validator, $request)
    {
        $data = array_merge($validator->validated(), $this->baseService->auditableUpdate($request->userEmail));

        return BaseRepositories::update('products', $data, $request->id);
    }

    public function destroyed($id)
    {
        return BaseRepositories::destroy('products', $id);
    }
}
