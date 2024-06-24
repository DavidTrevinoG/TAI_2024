<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use App\Http\Requests\StoreProveedoresRequest;
use App\Http\Requests\UpdateProveedoresRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('proveedores.index', [
            'proveedores' => Proveedores::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // Función para crear una nueva categoría
    public function create(): View
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar la nueva categoría
    public function store(StoreProveedoresRequest $request): RedirectResponse
    {
        Proveedores::create($request->validated());

        return redirect()->route('proveedores.index')
            ->withSuccess('Nuevo Proveedor agregado.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar una categoría
    public function show(Proveedores $proveedore): View
    {
        return view('proveedores.show', compact('proveedore'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar una categoría
    public function edit(Proveedores $proveedore): View
    {
        return view('proveedores.edit', compact('proveedore'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateProveedoresRequest $request, Proveedores $proveedore): RedirectResponse
    {
        $proveedore->update($request->validated());

        return redirect()->back()
            ->withSuccess('Proveedores is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Proveedores $proveedore): RedirectResponse
    {

        if ($proveedore->compras()->count() > 0) {
            return redirect()->route('proveedores.index')
                ->with('error', 'Proveedor no puede ser eliminado porque tiene compras asociadas.');
        }

        $proveedore->delete();

        return redirect()->route('proveedores.index')
            ->withSuccess('Proveedor is deleted successfully.');
    }
}
