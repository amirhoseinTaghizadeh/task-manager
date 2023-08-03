<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin Routes (Requires 'auth' middleware and 'role:admin' middleware)
Route::group(['middleware' => ['auth', 'role:admin']], function () {

    // Dashboard
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Role Management
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    // Permission Management
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });

    // Card Management
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/cards', [CardController::class, 'index'])->name('admin.cards');
        Route::get('/cards/create', [CardController::class, 'create'])->name('admin.create_card');
        Route::post('/cards', [CardController::class, 'store'])->name('admin.store_card');
        Route::get('/cards/{card}/edit', [CardController::class, 'edit'])->name('admin.edit_card');
        Route::put('/cards/{card}', [CardController::class, 'update'])->name('admin.update_card');
        Route::delete('/cards/{card}', [CardController::class, 'destroy'])->name('admin.delete_card');
        Route::post('/assign_card', [CardController::class, 'assignCard'])->name('admin.assign_card');
    });

});

// User Routes (Requires 'auth' middleware)
Route::group(['middleware' => 'auth'], function () {

    // User Dashboard
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Task Management
    Route::group(['prefix' => 'user'], function () {
        Route::get('/tasks', [TaskController::class, 'index'])->name('user.tasks');
        Route::post('/tasks', [TaskController::class, 'store'])->name('user.store_task');
        Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('user.update_task');
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('user.delete_task');
    });

});
