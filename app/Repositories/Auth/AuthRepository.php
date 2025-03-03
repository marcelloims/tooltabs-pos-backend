<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\BaseRepositories;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends BaseRepositories
{
    protected $baseService;

    public function __construct(BaseService $_baseService)
    {
        $this->baseService = $_baseService;
    }

    public function register($validator, $anotherRequest){
        $data = array_merge($validator->validated(), $anotherRequest, $this->baseService->auditableInsert(null));

        return BaseRepositories::store('users', $data);
    }

    public function getUserByEmailPassword($email, $password)
    {
        $user = User::select('email', 'password')
        ->where('email', $email)
        ->first();

        if ($user) {
            return Hash::check($password, $user->password);
        }else{
            return false;
        }

    }

    public function getUser()
    {
        return User::join('department_per_positions', 'department_per_positions.id', '=', 'users.department_per_position_id')
        ->where("users.department_per_position_id", Auth::user()->department_per_position_id)
        ->select("users.*", "department_per_positions.office_id")
        ->first();
    }
}
