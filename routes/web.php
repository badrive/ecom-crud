<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class,"index"])->name("product.index");

Route::get("/product/update/{product}", [HomeController::class,"show"])->name("product.show");
Route::post("/product/store", [HomeController::class,"store"])->name("product.store");



