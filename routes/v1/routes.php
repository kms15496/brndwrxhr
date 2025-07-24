<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeaveController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AttendanceController;



Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/check-in', [AttendanceController::class, 'checkIn']);
    Route::post('/check-out', [AttendanceController::class, 'checkOut']);

    Route::get('/attendance-list', [AttendanceController::class, 'list']);

    Route::get('/leave-types',[LeaveController::class,'getLeaveTypes']);

    Route::post('/create-leave',[LeaveController::class,'createLeave']);

    Route::get('/leaves',[LeaveController::class,'getMyLeave']);
});
