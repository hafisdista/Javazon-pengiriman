Langkah Instalasi Shipping Menu:
1. Copy folder/file:
    - app/Http/Controllers/ShippingController.php
    - app/Models/Shipping.php
    - database/migrations/2025_07_11_000000_create_shippings_table.php
    - resources/views/shipping/index.blade.php
2. Tambahkan route berikut ke routes/web.php:
    use App\Http\Controllers\ShippingController;
    Route::get('/shipping', [ShippingController::class, 'index'])->name('shipping.index');
    Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store');
3. Jalankan:
    php artisan migrate
4. Tambahkan menu di layouts/app.blade.php untuk Shipping.
