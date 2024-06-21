<?php

namespace App\Http\Controllers;

use App\Models\Cotizaciones;
use App\Models\Cliente;
use App\Models\Product;
use App\Http\Requests\StoreCotizacionesRequest;
use App\Http\Requests\UpdateCotizacionesRequest;
use App\Models\Clientes;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CotizacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('cotizaciones.index', [
            'cotizaciones' => Cotizaciones::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // Función para crear una nueva categoría
    public function create(): View
    {
        $clientes = Clientes::all();
        $productos = Product::all();
        return view('cotizaciones.create', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar la nueva categoría
    public function store(StoreCotizacionesRequest $request): RedirectResponse
    {
        Cotizaciones::create($request->validated());

        return redirect()->route('cotizaciones.index')
            ->withSuccess('Nueva Cotización agregado.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar una categoría
    public function show(Cotizaciones $cotizacione): View
    {
        return view('cotizaciones.show', compact('cotizacione'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar una categoría
    public function edit(Cotizaciones $cotizacione): View
    {
        $clientes = Clientes::all();
        $productos = Product::all();
        return view('cotizaciones.edit', compact('cotizacione', 'clientes', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateCotizacionesRequest $request, Cotizaciones $cotizacione): RedirectResponse
    {
        $cotizacione->update($request->validated());

        return redirect()->back()
            ->withSuccess('Cotización is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Cotizaciones $cotizacione): RedirectResponse
    {
        $cotizacione->delete();

        return redirect()->route('cotizaciones.index')
            ->withSuccess('Cotización is deleted successfully.');
    }
}
