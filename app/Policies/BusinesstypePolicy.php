<?php

namespace App\Policies;

use App\User;
use App\Businesstype;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinesstypePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Businesstype $businesstype)
    {
        return $user->hasPermissionTo('view businesstypes');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create businesstypes');
    }


    public function update(User $user, Businesstype $businesstype)
    {

        return $user->hasPermissionTo('edit businesstypes');
    }


    public function delete(User $user, Businesstype $businesstype)
    {
        return $user->hasPermissionTo('delete businesstypes');
    }
}
