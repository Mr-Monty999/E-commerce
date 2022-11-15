<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Request;


/**
 * @group permissions
 * @authenticated
 */
class PermissionController extends Controller
{
    /**
     * Display all the available permissions.
     *required (view-perimssions) permission
     *@response 200 [
    {
        "id": 1,
        "name": "create-users",
        "guard_name": "web",
        "created_at": "2022-11-15T18:24:27.000000Z",
        "updated_at": "2022-11-15T18:24:27.000000Z"
    },
    {
        "id": 2,
        "name": "view-users",
        "guard_name": "web",
        "created_at": "2022-11-15T18:24:27.000000Z",
        "updated_at": "2022-11-15T18:24:27.000000Z"
    },
    {
        "id": 3,
        "name": "edit-users",
        "guard_name": "web",
        "created_at": "2022-11-15T18:24:27.000000Z",
        "updated_at": "2022-11-15T18:24:27.000000Z"
    },
    {
        "id": 4,
        "name": "delete-users",
        "guard_name": "web",
        "created_at": "2022-11-15T18:24:28.000000Z",
        "updated_at": "2022-11-15T18:24:28.000000Z"
    },
    {
        "id": 5,
        "name": "create-categories",
        "guard_name": "web",
        "created_at": "2022-11-15T18:24:28.000000Z",
        "updated_at": "2022-11-15T18:24:28.000000Z"
    },
    {
        "id": 6,
        "name": "view-categories",
        "guard_name": "web",
        "created_at": "2022-11-15T18:24:28.000000Z",
        "updated_at": "2022-11-15T18:24:28.000000Z"
    },
    {
        "id": 7,
        "name": "edit-categories",
        "guard_name": "web",
        "created_at": "2022-11-15T18:24:28.000000Z",
        "updated_at": "2022-11-15T18:24:28.000000Z"
    },
    {
        "id": 8,
        "name": "delete-categories",
        "guard_name": "web",
        "created_at": "2022-11-15T18:24:28.000000Z",
        "updated_at": "2022-11-15T18:24:28.000000Z"
    }
]
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = PermissionService::getAllPermissions();
        return response()->json($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
