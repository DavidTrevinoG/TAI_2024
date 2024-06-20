<?php

namespace App\Http\Controllers;

use App\Models\Inventarios;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreInventariosRequest;
use App\Http\Requests\UpdateInventariosRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class InventariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Función para mostrar la lista de inventarios
    public function index(): View
    {
        return view('inventarios.index', [
            'Inventarios' => Inventarios::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    // Función para crear un nuevo inventario
    public function create(): View
    {
        $categories = Category::all();
        $products = Product::all();
        return view('inventarios.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar el nuevo inventario
    public function store(StoreInventariosRequest $request): RedirectResponse
    {
        Inventarios::create($request->validated());

        return redirect()->route('inventarios.index')
            ->withSuccess('Nueva inventario');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar un inventario
    public function show(Inventarios $inventario): View
    {
        $categories = Category::all();
        $products = Product::all();
        return view('inventarios.show', compact('inventario', 'categories', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar un inventario
    public function edit(Inventarios $inventario): View
    {
        $categories = Category::all();
        $products = Product::all();
        return view('inventarios.edit', compact('inventario', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */

    // Función para actualizar un inventario
    public function update(UpdateInventariosRequest $request, Inventarios $inventario): RedirectResponse
    {
        $inventario->update($request->validated());

        return redirect()->back()
            ->withSuccess('Inventario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */

    // Función para eliminar un inventario
    public function destroy(Inventarios $inventario): RedirectResponse
    {
        $inventario->delete();

        return redirect()->route('inventarios.index')
            ->withSuccess('Inventario eliminado exitosamente.');
    }
}
