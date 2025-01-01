<?php

namespace App\Repositories\Type;

use App\Models\Type;

class TypeRepository
{
    public function getData($id)
    {
        if ($id) {
            return Type::where('id', $id)->get();
        }else{
            return Type::select("id", "name")
            ->get();
        }
    }
}
