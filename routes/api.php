<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('users', [UserController::class, 'allUsers']);
Route::post('users', [UserController::class, 'addUser']);
Route::get('/users/{search}', [UserController::class, 'searchData']);
Route::get('users/{userId}', [UserController::class, 'findUserById']);
Route::put('users/{userId}', [UserController::class, 'updateUser']);
Route::delete('users/{userId}', [UserController::class, 'destroyUser']);

Route::get('users/{userId}/role/{roleId}', [UserController::class, 'assignRoleToUser']);

Route::get('roles', [RoleController::class, 'allRoles']);
Route::post('roles', [RoleController::class, 'addRole']);
Route::get('roles/{roleId}', [RoleController::class, 'findRoleById']);
Route::put('roles/{roleId}', [RoleController::class, 'updateRole']);
Route::delete('roles/{roleId}', [RoleController::class, 'destroyRole']);

