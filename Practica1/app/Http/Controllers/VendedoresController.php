<?php

namespace App\Http\Controllers;

use App\Models\Vendedores;
use App\Http\Requests\StoreVendedoresRequest;
use App\Http\Requests\UpdateVendedoresRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VendedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('vendedores.index', [
            'vendedores' => Vendedores::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // Función para crear una nueva categoría
    public function create(): View
    {
        return view('vendedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar la nueva categoría
    public function store(StoreVendedoresRequest $request): RedirectResponse
    {
        Vendedores::create($request->validated());

        return redirect()->route('vendedores.index')
            ->withSuccess('Nuevo Vendedor agregado.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar una categoría
    public function show(Vendedores $vendedore): View
    {
        return view('vendedores.show', compact('vendedore'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar una categoría
    public function edit(Vendedores $vendedore): View
    {
        return view('vendedores.edit', compact('vendedore'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateVendedoresRequest $request, Vendedores $vendedore): RedirectResponse
    {
        $vendedore->update($request->validated());

        return redirect()->back()
            ->withSuccess('Vendedor is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Vendedores $vendedore): RedirectResponse
    {

        $vendedore->delete();

        return redirect()->route('vendedores.index')
            ->withSuccess('Vendedores is deleted successfully.');
    }
}
