<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class PermissionService.
 */
class PermissionService
{

    public static function store($name)
    {
        $perm =  Permission::create(["name" => $name]);

        return $perm;
    }

    public static function getAllPermissions()
    {
        $permissions = Permission::all();
        return $permissions;
    }
    public static function permissionsList()
    {
        return [
            "create-users",
            "view-users",
            "edit-users",
            "delete-users",
            "create-categories",
            "view-categories",
            "edit-categories",
            "delete-categories",
            "view-permissions",
            "view-roles",
            "create-roles",
            "edit-roles",
            "delete-roles",
        ];
    }
}
