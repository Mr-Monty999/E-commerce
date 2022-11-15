<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;


/**
 * @group roles
 * @authenticated
 */
class RoleController extends Controller
{
    /**
     * Display all the roles (paginated) with their permissions.
     *required (view-roles) permission
     *@response 200 {
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "owner",
            "guard_name": "web",
            "created_at": "2022-11-15T18:24:27.000000Z",
            "updated_at": "2022-11-15T18:24:27.000000Z",
            "permissions": []
        },
        {
            "id": 2,
            "name": "admin",
            "guard_name": "web",
            "created_at": "2022-11-15T19:34:18.000000Z",
            "updated_at": "2022-11-15T19:34:18.000000Z",
            "permissions": [
                {
                    "id": 3,
                    "name": "edit-users",
                    "guard_name": "web",
                    "created_at": "2022-11-15T18:24:27.000000Z",
                    "updated_at": "2022-11-15T18:24:27.000000Z",
                    "pivot": {
                        "role_id": 2,
                        "permission_id": 3
                    }
                }
            ]
        },
        {
            "id": 9,
            "name": "mod",
            "guard_name": "web",
            "created_at": "2022-11-15T19:53:53.000000Z",
            "updated_at": "2022-11-15T19:53:53.000000Z",
            "permissions": [
                {
                    "id": 1,
                    "name": "create-users",
                    "guard_name": "web",
                    "created_at": "2022-11-15T18:24:27.000000Z",
                    "updated_at": "2022-11-15T18:24:27.000000Z",
                    "pivot": {
                        "role_id": 9,
                        "permission_id": 1
                    }
                },
                {
                    "id": 2,
                    "name": "view-users",
                    "guard_name": "web",
                    "created_at": "2022-11-15T18:24:27.000000Z",
                    "updated_at": "2022-11-15T18:24:27.000000Z",
                    "pivot": {
                        "role_id": 9,
                        "permission_id": 2
                    }
                }
            ]
        }
    ],
    "first_page_url": "http://localhost:8000/api/roles?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/roles?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/roles?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://localhost:8000/api/roles",
    "per_page": 5,
    "prev_page_url": null,
    "to": 3,
    "total": 3
}
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = RoleService::showAllRoles();
        return response()->json($roles);
    }

    /**
     * Store a newly created role.
     * required (create-roles) permission
     *@bodyParam permissions string[] int[] can be array of permissions names or ids
     *@response 201 {
    "name": "mod",
    "guard_name": "web",
    "updated_at": "2022-11-15T19:53:53.000000Z",
    "created_at": "2022-11-15T19:53:53.000000Z",
    "id": 9,
    "permissions": [
        {
            "id": 1,
            "name": "create-users",
            "guard_name": "web",
            "created_at": "2022-11-15T18:24:27.000000Z",
            "updated_at": "2022-11-15T18:24:27.000000Z",
            "pivot": {
                "role_id": 9,
                "permission_id": 1
            }
        },
        {
            "id": 2,
            "name": "view-users",
            "guard_name": "web",
            "created_at": "2022-11-15T18:24:27.000000Z",
            "updated_at": "2022-11-15T18:24:27.000000Z",
            "pivot": {
                "role_id": 9,
                "permission_id": 2
            }
        }
    ]
}
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = RoleService::store($request->all());
        return response()->json($role, 201);
    }

    /**
     * Display the specified role with it permissions.
     *required (view-roles) permssion
     *@urlParam id integer required
     *@response 200 {
    "id": 9,
    "name": "mod",
    "guard_name": "web",
    "created_at": "2022-11-15T19:53:53.000000Z",
    "updated_at": "2022-11-15T19:53:53.000000Z",
    "permissions": [
        {
            "id": 1,
            "name": "create-users",
            "guard_name": "web",
            "created_at": "2022-11-15T18:24:27.000000Z",
            "updated_at": "2022-11-15T18:24:27.000000Z",
            "pivot": {
                "role_id": 9,
                "permission_id": 1
            }
        },
        {
            "id": 2,
            "name": "view-users",
            "guard_name": "web",
            "created_at": "2022-11-15T18:24:27.000000Z",
            "updated_at": "2022-11-15T18:24:27.000000Z",
            "pivot": {
                "role_id": 9,
                "permission_id": 2
            }
        }
    ]
}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = RoleService::show($id);

        return response()->json($role);
    }

    /**
     * Update the specified role.
     *required (edit-roles) permissions
     *@bodyParam permissions string[] int[] can be array of permissions names or ids
     *@urlParam id integer required
     *@response 200 {
    "id": 2,
    "name": "admin",
    "guard_name": "web",
    "created_at": "2022-11-15T19:34:18.000000Z",
    "updated_at": "2022-11-15T19:34:18.000000Z",
    "permissions": [
        {
            "id": 3,
            "name": "edit-users",
            "guard_name": "web",
            "created_at": "2022-11-15T18:24:27.000000Z",
            "updated_at": "2022-11-15T18:24:27.000000Z",
            "pivot": {
                "role_id": 2,
                "permission_id": 3
            }
        }
    ]
}
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = RoleService::update($request->all(), $id);

        return response()->json($role);
    }

    /**
     * Remove the specified role.
     * required (delete-role) permission
     * @urlParam id integer required
     *@response 200 {
    "id": 2,
    "name": "admin",
    "guard_name": "web",
    "created_at": "2022-11-15T19:34:18.000000Z",
    "updated_at": "2022-11-15T19:34:18.000000Z",
    "permissions": [
        {
            "id": 3,
            "name": "edit-users",
            "guard_name": "web",
            "created_at": "2022-11-15T18:24:27.000000Z",
            "updated_at": "2022-11-15T18:24:27.000000Z",
            "pivot": {
                "role_id": 2,
                "permission_id": 3
            }
        }
    ]
}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = RoleService::destroy($id);

        return response()->json($role);
    }
}
