<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\DashboardController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin and Manager can access users list and edit/create
    Route::middleware('role:admin,manager')->group(function () {
        Route::resource('users', UserController::class)->except(['destroy']);
    });
    
    // Only Admin can delete users and manage roles/permissions
    Route::middleware('role:admin')->group(function () {
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        
        Route::get('/roles-permissions', [RolePermissionController::class, 'index'])->name('roles.index');
        Route::post('/roles-permissions/update', [RolePermissionController::class, 'update'])->name('roles.update_permissions');
    });
});
