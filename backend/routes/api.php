<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\FoodStallController;
use App\Http\Controllers\Api\InspectionController;
use App\Http\Controllers\Api\LicenseController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VendorController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::get('/vendors', [VendorController::class, 'index']);
    Route::get('/vendors/{vendor}', [VendorController::class, 'show']);
    Route::get('/stalls', [FoodStallController::class, 'index']);
    Route::get('/stalls/{foodStall}', [FoodStallController::class, 'show']);

    Route::middleware('auth:api')->group(function (): void {
        Route::get('/auth/me', [AuthController::class, 'me']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/auth/refresh', [AuthController::class, 'refresh']);

        Route::apiResource('reports', ReportController::class)->except(['update']);

        Route::middleware('role:vendor,admin')->group(function (): void {
            Route::apiResource('vendor/stalls', FoodStallController::class)
                ->parameters(['stalls' => 'foodStall'])
                ->except(['index', 'show']);
            Route::apiResource('documents', DocumentController::class)->only(['index', 'store', 'show', 'destroy']);
        });

        Route::middleware('role:admin')->group(function (): void {
            Route::apiResource('users', UserController::class);
            Route::apiResource('admin/vendors', VendorController::class)
                ->parameters(['vendors' => 'vendor'])
                ->except(['index', 'show']);
            Route::apiResource('admin/stalls', FoodStallController::class)
                ->parameters(['stalls' => 'foodStall'])
                ->except(['index', 'show']);
            Route::apiResource('licenses', LicenseController::class);
            Route::apiResource('inspections', InspectionController::class);
            Route::patch('/reports/{report}', [ReportController::class, 'update']);
        });
    });
});
