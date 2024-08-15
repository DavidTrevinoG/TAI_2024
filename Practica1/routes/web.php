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
use App\Models\Product;
use App\Models\Clientes;
use App\Models\Inventarios;
use App\Models\Ventas;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    // Obtener la existencia neta de productos
    $productos = Product::all()->keyBy('id');
    $movimientos = Inventarios::select('id_productos')
        ->selectRaw('SUM(CASE WHEN movimiento = "Entrada" THEN cantidad ELSE -cantidad END) as total_movimiento')
        ->groupBy('id_productos')
        ->get();

    $existenciaProductos = $productos->map(function ($producto) use ($movimientos) {
        $movimiento = $movimientos->firstWhere('id_productos', $producto->id);
        $existenciaMovimiento = $movimiento ? $movimiento->total_movimiento : 0;
        return $producto->existencia + $existenciaMovimiento;
    });

    $existenciaProductos = $existenciaProductos->mapWithKeys(function ($existencia, $id) use ($productos) {
        $producto = $productos->get($id);
        return [$producto->nombre => $existencia];
    });


    // Obtener datos de ventas mensuales
    $ventasMensuales = Ventas::selectRaw('MONTH(created_at) as mes, SUM(total) as total')
        ->groupBy('mes')
        ->orderBy('mes')
        ->pluck('total', 'mes');

    $productosMasVendidos = Inventarios::where('movimiento', 'Salida')
        ->select('id_productos')
        ->selectRaw('SUM(cantidad) as total_vendida')
        ->groupBy('id_productos')
        ->orderByDesc('total_vendida')
        ->take(5)
        ->get();

    // Mapear a un formato adecuado
    $productosMasVendidos = $productosMasVendidos->mapWithKeys(function ($item) {
        $producto = Product::find($item->id_productos);
        return [$producto->nombre => $item->total_vendida];
    });

    $clientesRecurrentes = Clientes::select('clientes.nombre')
        ->join('ventas', 'clientes.id', '=', 'ventas.id_clientes')
        ->selectRaw('clientes.id, clientes.nombre, COUNT(ventas.id) as total_ventas')
        ->groupBy('clientes.id', 'clientes.nombre')
        ->orderByDesc('total_ventas')
        ->take(4)
        ->pluck('total_ventas', 'nombre');


    return view('dashboard', compact('existenciaProductos', 'ventasMensuales', 'productosMasVendidos', 'clientesRecurrentes'));
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

Route::get('ventas/{venta}/pdf', [VentasController::class, 'pdf'])->name('ventas.pdf');
Route::get('clientes/{cliente}/pdf', [ClientesController::class, 'pdf'])->name('clientes.pdf');
Route::get('category/{category}/pdf', [CategoryController::class, 'pdf'])->name('categories.pdf');
Route::get('/ventas/pdf/all', [VentasController::class, 'pdfAll'])->name('ventas.pdf.all');
Route::get('search-productos', [CotizacionesController::class, 'searchProductos'])->name('search.productos');
Route::get('/compras/pdf/all', [ComprasController::class, 'pdfAll'])->name('compras.pdf.all');
Route::get('/inventarios/pdf/all', [InventariosController::class, 'pdfAll'])->name('inventarios.pdf.all');
Route::get('/clientes/pdf/all', [ClientesController::class, 'pdfAll'])->name('clientes.pdf.all');
Route::get('/proveedores/pdf/all', [ProveedoresController::class, 'pdfAll'])->name('proveedores.pdf.all');
Route::get('/products/pdf/all', [ProductController::class, 'pdfAll'])->name('products.pdf.all');
Route::get('/products/pdf/stock', [ProductController::class, 'pdfStock'])->name('products.pdf.stock');
