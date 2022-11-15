<?php

namespace App\Services;

use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService.
 * @authenticated
 */
class UserService
{
    /**
     *Authenticate the user and get the token
     *@unauthenticated
     *@response
     {
    "id": 1,
    "name": null,
    "email": "owner@owner.com",
    "email_verified_at": null,
    "created_at": "2022-11-15T16:59:52.000000Z",
    "updated_at": "2022-11-15T16:59:52.000000Z",
    "deleted_at": null,
    "token": "2|gYXQP8aKV1B3tGHk5XgoKSaC3MPuCnMTgL7JO2bW"
}
     */
    public static function login($data)
    {
        if (Auth::attempt(["email" => $data["email"], "password" => $data["password"]])) {
            $user = Auth::user();
            $user->token = $user->createToken(uniqid())->plainTextToken;
            return $user;
        }
        return false;
    }

    /**
     *Authenticate user and get the token
     *@unauthenticated
     *@response
     */
    public static function register($data)
    {
        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);
        $user->token = $user->createToken(uniqid())->plainTextToken;
        return $user;
    }
    public static function store($data)
    {
        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);
        if (isset($data["roles"]))
            $user->syncRoles($data["roles"]);

        $user->getPermissionsViaRoles();

        return $user;
    }
    public static function show($id)
    {
        $user = User::with([
            "roles" => function ($q) {
                $q->paginate(5);
            },
            "roles.permissions"
        ])->findOrFail($id);
        return $user;
    }
    public static function update($data, $id)
    {
        $data["password"] = Hash::make($data["password"]);
        $user = User::findOrFail($id);
        $user->update($data);
        if (isset($data["roles"]))
            $user->syncRoles($data["roles"]);

        $user->getPermissionsViaRoles();


        return $user;
    }
    public static function showAllUsers()
    {
        $users = User::with([
            "roles" => function ($q) {
                $q->paginate(5);
            },
            "roles.permissions"
        ])->paginate(5);
        return $users;
    }
    public static function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }
}
