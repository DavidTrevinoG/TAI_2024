<?php

namespace App\Http\Controllers;

use App\Models\FormaPago;
use App\Http\Requests\StoreFormaPagoRequest;
use App\Http\Requests\UpdateFormaPagoRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FormaPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('formapago.index', [
            'formapago' => FormaPago::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // Función para crear una nueva categoría
    public function create(): View
    {
        return view('formapago.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar la nueva categoría
    public function store(StoreFormaPagoRequest $request): RedirectResponse
    {
        FormaPago::create($request->validated());

        return redirect()->route('formapago.index')
            ->withSuccess('Nueva forma de pago agregada.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar una categoría
    public function show(FormaPago $formapago): View
    {
        return view('formapago.show', compact('formapago'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar una categoría
    public function edit(FormaPago $formapago): View
    {
        return view('formapago.edit', compact('formapago'));
    }

    /**
     * Update the specified resource in storage.
     */

    // Función para actualizar una categoría
    public function update(UpdateFormaPagoRequest $request, FormaPago $formapago): RedirectResponse
    {
        $formapago->update($request->validated());

        return redirect()->back()
            ->withSuccess('Forma de pago actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */

    // Función para eliminar una categoría
    public function destroy(FormaPago $formapago): RedirectResponse
    {


        if ($formapago->compras()->count() > 0) {
            return redirect()->route('formapago.index')
                ->with('error', 'Forma de pago no puede ser eliminada debido a que tiene compras relacionadas.');
        }

        $formapago->delete();

        return redirect()->route('formapago.index')
            ->withSuccess('Forma de Pago eliminada correctamente.');
    }
}
