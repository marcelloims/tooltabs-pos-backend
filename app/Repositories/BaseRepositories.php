<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BaseRepositories {

    public function getAll(){

    }

    public function store($table, $data){
        return DB::table($table)->insert($data);
    }

    public function getById($tabel, $where){
        return DB::table($tabel)->where($where)->first();
    }

    public function update(){

    }

    public function destroy(){

    }
}
