<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Ensure Sanctum authentication for API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
});
