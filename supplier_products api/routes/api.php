<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// routes/api.php

Route::resource('suppliers', SupplierController::class);
Route::resource('products', ProductController::class);
Route::get('search', [SupplierController::class, 'search']);