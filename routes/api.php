<?php

use App\Http\Controllers\dashboard\PermissionController;
use App\Http\Controllers\dashboard\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(["namespace" => "guest"], function () {
    Route::post("users/login", [UserController::class, "login"]);
    Route::post("users/register", [UserController::class, "register"]);
});

Route::group(["middleware" => "auth:sanctum", "namespace" => "dashboard"], function () {
    Route::apiResource("users", "UserController");
    Route::apiResource("roles", "RoleController");
    Route::get("permissions", [PermissionController::class, "index"]);
    // Route::apiResource("categories", "CategoryController");
});
