<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\BaseRepositories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends BaseRepositories {

    public function register($validator, $anotherRequest){
        $data = array_merge($validator->validated(), $anotherRequest, $this->auditableInsert());

        return BaseRepositories::store('users', $data);
    }

    public function getUserByEmailPassword($email, $password)
    {
        $data = User::select('email', 'password')
        ->where('email', $email)
        ->first();

        return Hash::check($password, $data->password);
    }

    public function audiTableInsert()
    {
        return [
            'created_by'        => "test@email.com",
            'updated_by'        => "test@email.com",
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ];
    }

    public function audiTableUpdate()
    {
        return [
            'updated_by'        => "test@email.com",
            'updated_at'        => date('Y-m-d H:i:s'),
        ];
    }

    public function audiTableDelete()
    {
        return [
            'deleted_by'        => "test@email.com"
        ];
    }
}
