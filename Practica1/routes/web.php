<?php

require __DIR__ . '/auth.php';

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\InventariosController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\FormaPagoController;
use App\Http\Controllers\VendedoresController;
use App\Http\Controllers\CotizacionesController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('inventarios', InventariosController::class);
Route::resource('ventas', VentasController::class);
Route::resource('proveedores', ProveedoresController::class);
Route::resource('compras', ComprasController::class);
Route::resource('formapago', FormaPagoController::class);
Route::resource('vendedores', VendedoresController::class);
Route::resource('cotizaciones', CotizacionesController::class);
Route::get('cotizaciones/{cotizacione}/pdf', [CotizacionesController::class, 'pdf'])->name('cotizaciones.pdf');
