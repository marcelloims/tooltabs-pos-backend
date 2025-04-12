<?php

namespace App\Repositories\Pos;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\BaseRepositories;

class PosRepository extends BaseRepositories
{
    public function getFood($request)
    {
        return Product::join('product_per_offices', 'products.id', "=", 'product_per_offices.product_id')
            ->join('photos', 'products.id', "=", 'photos.product_id')
            ->where("product_per_offices.office_id", $request->officeId)
            ->where("products.status", "Active")
            ->where("product_per_offices.status", "Active")
            ->where("products.category_id", $request->category_id)
            ->select('products.id', "products.pcode", "products.name", "products.description", "products.unit", "products.unit", "products.tax", "product_per_offices.status as status", "product_per_offices.office_id", "product_per_offices.price", "product_per_offices.service_charge_(%) as service_charge", "product_per_offices.commission_(%) as commission", "photos.image1", "photos.image2", "photos.image3")
            ->get();
    }

    public function searchFood($request)
    {
        return Product::join('product_per_offices', 'products.id', "=", 'product_per_offices.product_id')
            ->join('photos', 'products.id', "=", 'photos.product_id')
            ->where("product_per_offices.office_id", $request->officeId)
            ->where("products.status", "Active")
            ->where("product_per_offices.status", "Active")
            ->where("products.name", "like", '%' . $request->keyword . '%')
            ->select('products.id', "products.pcode", "products.name", "products.description", "products.unit", "products.unit", "products.tax", "product_per_offices.status as status", "product_per_offices.office_id", "product_per_offices.price", "product_per_offices.service_charge_(%) as service_charge", "product_per_offices.commission_(%) as commission", "photos.image1", "photos.image2", "photos.image3")
            ->get();
    }

    public function getCategory($request)
    {
        return Category::where('tenant_id', $request->tenantId)->get();
    }

    public function getDetailFood($id)
    {

        return Product::join('product_per_offices', 'products.id', "=", 'product_per_offices.product_id')
            ->join('photos', 'products.id', "=", 'photos.product_id')
            ->where("products.id", $id)
            ->select('products.id', "products.pcode", "products.name", "products.description", "products.unit", "products.unit", "products.tax", "product_per_offices.status as status", "product_per_offices.office_id", "product_per_offices.price", "product_per_offices.service_charge_(%) as service_charge", "product_per_offices.commission_(%) as commission", "photos.image1", "photos.image2", "photos.image3")
            ->first();
    }
}
