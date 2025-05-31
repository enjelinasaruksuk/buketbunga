<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListProdukController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('list_produk', [ListProdukController::class, 'show']);
Route::get('/list_produk', [ListProdukController::class, 'show']);
Route::post('/produk/simpan', [ListProdukController::class, 'simpan'])->name('produk.simpan');
Route::delete('/listproduk/{id}', [ListProdukController::class, 'delete'])->name('produk.delete');
Route::get('/produk/edit/{id}', [ListProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/update/{id}', [ListProdukController::class, 'update'])->name('produk.update');