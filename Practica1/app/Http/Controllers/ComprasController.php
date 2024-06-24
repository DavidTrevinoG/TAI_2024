<?php

namespace App\Http\Controllers;

use App\Models\FormaPago;
use App\Models\Proveedores;
use App\Models\Product;
use App\Models\Compras;
use App\Http\Requests\StoreComprasRequest;
use App\Http\Requests\UpdateComprasRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('compras.index', [
            'compras' => Compras::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // Función para crear una nueva categoría
    public function create(): View
    {
        $proveedores = Proveedores::all();
        $formapago = FormaPago::all();
        $productos = Product::all();
        return view('compras.create', compact('proveedores', 'productos', 'formapago'));
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar la nueva categoría
    public function store(StoreComprasRequest $request): RedirectResponse
    {
        Compras::create($request->validated());

        return redirect()->route('compras.index')
            ->withSuccess('Nueva compra agregada.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar una categoría
    public function show(Compras $compra): View
    {
        return view('compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar una categoría
    public function edit(Compras $compra): View
    {
        $proveedores = Proveedores::all();
        $formapago = FormaPago::all();
        $productos = Product::all();
        return view('compras.edit', compact('proveedores', 'productos', 'formapago', 'compra'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateComprasRequest $request, Compras $compra): RedirectResponse
    {
        $compra->update($request->validated());

        return redirect()->back()
            ->withSuccess('Compras is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Compras $compra): RedirectResponse
    {
        $compra->delete();

        return redirect()->route('compras.index')
            ->withSuccess('Compra is deleted successfully.');
    }
}
