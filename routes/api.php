<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\Admin\TicketAdminController;

Route::post('/tickets', [TicketController::class, 'store']);

Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/me', [AdminAuthController::class, 'me']);
    Route::post('/admin/logout', [AdminAuthController::class, 'logout']);    
});

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/tickets', [TicketAdminController::class, 'index']);
    Route::get('/tickets/{type}/{id}', [TicketAdminController::class, 'show']);
    Route::post('/tickets/{type}/{id}/note', [TicketAdminController::class, 'updateNote']);
});

