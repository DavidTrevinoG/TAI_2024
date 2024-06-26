<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Asegúrate de importar el modelo Category
use App\Models\Clientes;
use App\Models\Ventas;
use App\Http\Requests\StoreVentasRequest;
use App\Http\Requests\UpdateVentasRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        return view('ventas.index', [
            'Ventas' => Ventas::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all(); // Obtener todas las categorías
        $products = Product::all();
        $clientes = Clientes::all();
        return view('ventas.create', compact('categories', 'products', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVentasRequest $request): RedirectResponse
    {
        Ventas::create($request->validated());

        return redirect()->route('ventas.index')
            ->withSuccess('Nueva venta agregado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ventas $ventas): View
    {
        return view('ventas.show', compact('ventas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ventas $ventas): View
    {
        $categories = Category::all(); // Obtener todas las categorías
        $products = Product::all();
        $clientes = Clientes::all();

        return view('ventas.edit', compact('categories', 'products', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVentasRequest $request, Ventas $ventas): RedirectResponse
    {
        $ventas->update($request->validated());

        return redirect()->back()
            ->withSuccess('Product is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ventas $ventas): RedirectResponse
    {
        $ventas->delete();

        return redirect()->route('ventas.index')
            ->withSuccess('Product is deleted successfully.');
    }
}
