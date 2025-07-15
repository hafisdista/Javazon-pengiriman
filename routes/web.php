<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;

Route::get('/', [ShippingController::class, 'index'])->name('shipping.index');
Route::post('/', [ShippingController::class, 'store'])->name('shipping.store');

Route::get('/asdad', function () {
    return view('welcome');
});

