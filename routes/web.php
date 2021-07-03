<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::middleware(['auth'])
    ->group(function () {
        // USUARIOS
        Route::resource(
            'user',
            UserController::class,
            ['except' => ['create', 'edit']]
        );
        Route::get('user.list', [UserController::class, 'list'])
            ->name('user.list');
        Route::resource('user-permission', UserPermissionController::class);
        Route::resource('user-role', UserRoleController::class);

        // ROLES
        Route::resource(
            'role',
            RoleController::class,
            ['except' => ['create', 'edit']]
        );
        Route::get('role.list', [RoleController::class, 'list'])->name('role.list');
        Route::resource('role-permission', RolePermissionController::class);
    });

