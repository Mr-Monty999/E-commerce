<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;


/**
 * @group users
 * @authenticated
 */
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware("permission:view-users")->only(["index", "show"]);
        $this->middleware("permission:create-users")->only(["create", "store"]);
        $this->middleware("permission:edit-users")->only(["edit", "update"]);
        $this->middleware("permission:delete-users")->only("destroy", "destroyAll");
    }

    /**
     * Authunticate user and get the token
     * @unauthenticated
     * @response 200 {
    "id": 1,
    "name": null,
    "email": "owner@owner.com",
    "email_verified_at": null,
    "created_at": "2022-11-15T16:59:52.000000Z",
    "updated_at": "2022-11-15T16:59:52.000000Z",
    "deleted_at": null,
    "token": "8|v7THbrUQdHC8N1dokpy3lfPBXPSDjPymtrxwWz8v"
}
     */
    public function login(LoginUserRequest $request)
    {
        $user = UserService::login($request->all());
        if ($user)
            return response()->json($user);
        else
            return response()->json($user, 400);
    }

    /**
     * Register new user (used by guests)
     * @unauthenticated
     * @response 201 {
    "email": "monty@gmail.comf",
    "name": "ff",
    "updated_at": "2022-11-15T17:40:36.000000Z",
    "created_at": "2022-11-15T17:40:36.000000Z",
    "id": 3,
    "token": "7|DgCOUIw3NCTVPmhwqmwovG6imJHgtGx9nTHrkIle"
}
     */
    public function register(StoreUserRequest $request)
    {

        $user = UserService::register($request->all());

        return response()->json($user, 201);
    }

    /**
     * Display all the users (paginated) with their roles and permissions.
     * required (view-users) permission
     *@response 200 {
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": null,
            "email": "owner@owner.com",
            "email_verified_at": null,
            "created_at": "2022-11-15T18:24:27.000000Z",
            "updated_at": "2022-11-15T19:03:37.000000Z",
            "deleted_at": null,
            "roles": [
                {
                    "id": 1,
                    "name": "owner",
                    "guard_name": "web",
                    "created_at": "2022-11-15T18:24:27.000000Z",
                    "updated_at": "2022-11-15T18:24:27.000000Z",
                    "pivot": {
                        "model_id": 1,
                        "role_id": 1,
                        "model_type": "App\\Models\\User"
                    },
                    "permissions": []
                }
            ]
        },
        {
            "id": 3,
            "name": null,
            "email": "m@gmail.com",
            "email_verified_at": null,
            "created_at": "2022-11-15T18:51:12.000000Z",
            "updated_at": "2022-11-15T20:36:01.000000Z",
            "deleted_at": null,
            "roles": [
                {
                    "id": 2,
                    "name": "admin",
                    "guard_name": "web",
                    "created_at": "2022-11-15T19:34:18.000000Z",
                    "updated_at": "2022-11-15T19:34:18.000000Z",
                    "pivot": {
                        "model_id": 3,
                        "role_id": 2,
                        "model_type": "App\\Models\\User"
                    },
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
            ]
        },
        {
            "id": 4,
            "name": "ee",
            "email": "m@egmail.com",
            "email_verified_at": null,
            "created_at": "2022-11-15T18:51:36.000000Z",
            "updated_at": "2022-11-15T18:51:36.000000Z",
            "deleted_at": null,
            "roles": []
        }
    ],
    "first_page_url": "http://localhost:8000/api/users?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/users?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/users?page=1",
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
    "path": "http://localhost:8000/api/users",
    "per_page": 5,
    "prev_page_url": null,
    "to": 3,
    "total": 3
}
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserService::showAllUsers();
        return response()->json($users);
    }

    /**
     * Store a newly created user.
     * required (create-users) permission
     * @bodyParam roles string[] int[] can be array of roles names or ids
     * @response 201 {
    "email": "khalid@egmail.com",
    "name": "g",
    "updated_at": "2022-11-15T20:41:00.000000Z",
    "created_at": "2022-11-15T20:41:00.000000Z",
    "id": 6,
    "roles": [
        {
            "id": 2,
            "name": "admin",
            "guard_name": "web",
            "created_at": "2022-11-15T19:34:18.000000Z",
            "updated_at": "2022-11-15T19:34:18.000000Z",
            "pivot": {
                "model_id": 6,
                "role_id": 2,
                "model_type": "App\\Models\\User"
            },
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
    ]
}
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = UserService::store($request->all());

        return response()->json($user, 201);
    }

    /**
     * Display the specified user with it roles and permissions.
     * required (view-users) permission
     * @response 200 {
    "id": 3,
    "name": null,
    "email": "m@gmail.com",
    "email_verified_at": null,
    "created_at": "2022-11-15T18:51:12.000000Z",
    "updated_at": "2022-11-15T20:36:01.000000Z",
    "deleted_at": null,
    "roles": [
        {
            "id": 2,
            "name": "admin",
            "guard_name": "web",
            "created_at": "2022-11-15T19:34:18.000000Z",
            "updated_at": "2022-11-15T19:34:18.000000Z",
            "pivot": {
                "model_id": 3,
                "role_id": 2,
                "model_type": "App\\Models\\User"
            },
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
    ]
}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = UserService::show($id);

        return response()->json($user);
    }

    /**
     * Update the specified user.
     *required (edit-users) permission
     *@bodyParam roles string[] int[] can be array of roles names or ids
     *@response 200 {
    "id": 3,
    "name": null,
    "email": "m@gmail.com",
    "email_verified_at": null,
    "created_at": "2022-11-15T18:51:12.000000Z",
    "updated_at": "2022-11-15T20:36:01.000000Z",
    "deleted_at": null,
    "roles": [
        {
            "id": 2,
            "name": "admin",
            "guard_name": "web",
            "created_at": "2022-11-15T19:34:18.000000Z",
            "updated_at": "2022-11-15T19:34:18.000000Z",
            "pivot": {
                "model_id": 3,
                "role_id": 2,
                "model_type": "App\\Models\\User"
            },
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
    ]
}
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = UserService::update($request->all(), $id);

        return response()->json($user);
    }

    /**
     * Remove the specified user.
     * required (delete-users) permission
     *@response {
    "id": 1,
    "name": null,
    "email": "owner@owner.com",
    "email_verified_at": null,
    "created_at": "2022-11-15T18:24:27.000000Z",
    "updated_at": "2022-11-15T19:03:37.000000Z",
    "deleted_at": null
}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = UserService::destroy($id);

        return response()->json($user);
    }
}
