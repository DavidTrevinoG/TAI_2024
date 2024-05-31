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
    public function index(): View
    {
        return view('inventarios.index', [
            'inventarios' => Inventarios::latest()->paginate(4)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        $products = Product::all();
        return view('inventarios.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventariosRequest $request): RedirectResponse
    {
        Inventarios::create($request->validated());

        return redirect()->route('inventarios.index')
            ->withSuccess('Nueva inventario');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventarios $inventarios): View
    {
        return view('inventarios.show', compact('inventarios'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventarios $inventarios): View
    {
        return view('inventarios.edit', compact('inventarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventariosRequest $request, Inventarios $inventarios): RedirectResponse
    {
        $inventarios->update($request->validated());

        return redirect()->back()
            ->withSuccess('Inventario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventarios $inventarios): RedirectResponse
    {
        $inventarios->delete();

        return redirect()->route('inventarios.index')
            ->withSuccess('Inventario eliminado exitosamente.');
    }
}
