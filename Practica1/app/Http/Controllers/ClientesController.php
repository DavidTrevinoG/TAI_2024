<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Http\Requests\StoreClientesRequest;
use App\Http\Requests\UpdateClientesRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ClientesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('clientes.index', [
            'clientes' => Clientes::latest()->paginate(4)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientesRequest $request): RedirectResponse
    {
        Clientes::create($request->validated());

        return redirect()->route('clientes.index')
            ->withSuccess('Nueva cliente agregada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clientes $cliente): View
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clientes $cliente): View
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientesRequest $request, Clientes $cliente): RedirectResponse
    {
        $cliente->update($request->validated());

        return redirect()->back()
            ->withSuccess('Cliente is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $cliente): RedirectResponse
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->withSuccess('Cliente is deleted successfully.');
    }
}
