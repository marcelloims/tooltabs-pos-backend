<?php

namespace App\Repositories\ProductPerOffice;

use App\Models\ProductPerOffice;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;


class ProductPerOfficeRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService,)
    {
        $this->baseService = $_baseService;
    }

    public function getData($id)
    {
        if ($id) {
            return ProductPerOffice::join('products', 'products.id', '=', 'product_per_offices.product_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('types', 'types.id', '=', 'products.type_id')
                ->where('product_per_offices.id', $id)
                ->select(
                    "product_per_offices.product_id as product_per_offices_id",
                    "product_per_offices.office_id",
                    "product_per_offices.price",
                    "product_per_offices.service_charge_(%) as service_charge",
                    "product_per_offices.commission_(%) as commission",
                    "product_per_offices.status as product_per_office_status",

                    "products.id as product_id",
                    "products.pcode as product_pcode",
                    "products.name as product_name",
                    "products.unit as product_unit",
                    "products.brand_code as product_brand_code",
                    "products.hight_cm as product_hight_cm",
                    "products.width_cm as product_width_cm",
                    "products.long_cm as product_long_cm",
                    "products.tax as product_tax",
                    "products.status as product_status",

                    "categories.id as category_id",
                    "categories.name as category_name",

                    "types.id as type_id",
                    "types.name as type_name"
                )
                ->first();
        } else {
            return ProductPerOffice::select("id", "product_id", "office_id", "price", "service_charge_(%) as service_charge", "commission_(%) as commission", "status")->get();
        }
    }

    public function joinProduct($id)
    {
        return ProductPerOffice::join('products', 'products.id', '=', 'product_per_offices.product_id')
            ->where('id', $id)
            ->select("id", "product_id", "office_id", "price", "service_charge_(%) as service_charge", "commission_(%) as commission", "status")
            ->first();
    }

    public function fetch($request)
    {
        $query = ProductPerOffice::join('products', 'products.id', '=', 'product_per_offices.product_id')
            ->join('offices', 'offices.id', '=', 'product_per_offices.office_id')
            ->select('product_per_offices.id', 'offices.code as ' . $request->columns[0], $request->columns[1], 'products.' . $request->columns[2], $request->columns[3], 'product_per_offices.' . $request->columns[4], 'product_per_offices.' . $request->columns[5]);

        if ($request->search) {
            $query->where('pcode', 'like', '%' . $request->search . '%')
                ->orWhere("name", 'like', '%' . $request->search . '%')
                ->orWhere("status", 'like', '%' . $request->search . '%');
        }

        if ($request->sorting) {
            $data = $request->sorting[1] == "Office Code" ? "code" : strtolower($request->sorting[1]);
            $query->orderBy(strtolower($data), $request->sorting[0]);
        }

        return $query->paginate($request->perPage);
    }

    public function save($validator, $request)
    {
        $data = array_merge($validator, ['commission_(%)' => $request->commission, 'service_charge_(%)' => $request->service_charge], $this->baseService->auditableInsert($request->userEmail));

        return BaseRepositories::store('product_per_offices', $data);
    }

    public function updated($validator, $request)
    {
        $data = array_merge($validator, ['commission_(%)' => $request->commission, 'service_charge_(%)' => $request->service_charge], $this->baseService->auditableUpdate($request->userEmail));

        return BaseRepositories::update('product_per_offices', $data, $request->id);
    }

    public function destroyed($id)
    {
        return BaseRepositories::destroy('product_per_offices', $id);
    }
}
