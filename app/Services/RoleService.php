<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

/**
 * Class RoleService.
 */
class RoleService
{

    public static function store($data)
    {

        $role =  Role::create(["name" => $data["name"]]);
        if (isset($data["permissions"]))
            $role->syncPermissions($data["permissions"]);

        return $role;
    }

    public static function update($data, $id)
    {

        $role =  Role::findOrFail($id);
        $role->update($data);
        if (isset($data["permissions"]))
            $role->syncPermissions($data["permissions"]);

        return $role;
    }
    public static function showAllRoles()
    {
        $roles =  Role::with("permissions")->paginate(5);

        return $roles;
    }
    public static function show($id)
    {
        $role = Role::with("permissions")->findOrFail($id);
        return $role;
    }

    public static function destroy($id)
    {
        $role = Role::with("permissions")->findOrFail($id);
        $role->delete();
        return $role;
    }
}
