<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//* get
Route::get("/", [HomeController::class,"index"])->name("product.index");
Route::get("/product/update/{product}", [HomeController::class,"show"])->name("product.show");


//? post

Route::post("/product/store", [HomeController::class,"store"])->name("product.store");

Route::post('/cart/store',[CartController::class , "store"])->name("cart.store");


//& put
Route::put("/product/update/{product}" , [HomeController::class , "update"])->name("product.update");

//! delete

Route::delete("/product/delete/{product}" , [HomeController::class , "destroy"])->name("product.delete");