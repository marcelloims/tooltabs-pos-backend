<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository
{
    public function getData($id)
    {
        if ($id) {
            return Category::where('id', $id)->get();
        }else{
            return Category::select("id", "name")
            ->get();
        }
    }
}
