<?php

namespace App\Nova;


use Pktharindu\NovaPermissions\Nova\Role as RoleResource;

class Role extends RoleResource
{
    public static $group = "Admin";
    public static $priority = 2;
    public static $model = 'App\Role';

    public static function label()
    {
        return __('Role');
    }

    public static function singulaLabel()
    {
        return __('Role');
    }
}
