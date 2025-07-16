<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;

Route::get('/shipping', [ShippingController::class, 'index'])->name('shipping.index');
Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store');

Route::get('/admin/shipping', [ShippingController::class, 'adminIndex'])->name('shipping.admin');
Route::put('/admin/shipping/{id}/status', [ShippingController::class, 'updateStatus'])->name('shipping.updateStatus');
Route::get('/admin/shipping/{id}', [ShippingController::class, 'show'])->name('shipping.show');

Route::post('/admin/shipping/update-status', [ShippingController::class, 'updateStatusAjax'])->name('shipping.updateStatusAjax');


Route::get('/', function () {
    return view('shipping.index');
});

