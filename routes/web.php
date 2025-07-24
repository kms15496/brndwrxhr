<?php

use App\Http\Controllers\Admin\BussinessUnitController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckInOutController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/check-in-out', [CheckInOutController::class, 'index'])->name('check-in-out');

    Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('check-in');
    Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('check-out');




    Route::prefix('admin/country')
        ->name('admin.country.')
        ->controller(CountryController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'createOrEdit')->name('create');
            Route::post('/', 'storeOrUpdate')->name('store');
            Route::get('{id}/edit', 'createOrEdit')->name('edit');
            Route::put('{id}', 'storeOrUpdate')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
        });

    Route::prefix('admin/bussiness-unit')
        ->name('admin.bussiness-unit.')
        ->controller(BussinessUnitController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'createOrEdit')->name('create');
            Route::post('/', 'storeOrUpdate')->name('store');
            Route::get('{id}/edit', 'createOrEdit')->name('edit');
            Route::put('{id}', 'storeOrUpdate')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
        });

    Route::prefix('admin/department')
        ->name('admin.department.')
        ->controller(DepartmentController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'createOrEdit')->name('create');
            Route::post('/', 'storeOrUpdate')->name('store');
            Route::get('{id}/edit', 'createOrEdit')->name('edit');
            Route::put('{id}', 'storeOrUpdate')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
        });

    Route::prefix('admin/user')
        ->name('admin.user.')
        ->controller(UserController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'createOrEdit')->name('create');
            Route::post('/', 'storeOrUpdate')->name('store');
            Route::get('{id}/edit', 'createOrEdit')->name('edit');
            Route::put('{id}', 'storeOrUpdate')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
        });

    Route::prefix('admin/roles')
        ->name('admin.role.')
        ->controller(RoleController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'createOrEdit')->name('create');
            Route::post('/', 'storeOrUpdate')->name('store');
            Route::get('{id}/edit', 'createOrEdit')->name('edit');
            Route::put('{id}', 'storeOrUpdate')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
        });

    Route::prefix('admin/leave-types')
        ->name('admin.leave-types.')
        ->middleware('role:admin')
        ->controller(LeaveTypeController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'createOrEdit')->name('create');
            Route::post('/', 'storeOrUpdate')->name('store');
            Route::get('{id}/edit', 'createOrEdit')->name('edit');
            Route::put('{id}', 'storeOrUpdate')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
        });

    Route::prefix('leave')
        ->name('leaves.')

        ->controller(LeaveController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'createOrEdit')->name('create');
            Route::post('/', 'storeOrUpdate')->name('store');
            Route::get('{id}/edit', 'createOrEdit')->name('edit');
            Route::put('{id}', 'storeOrUpdate')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
        });
});