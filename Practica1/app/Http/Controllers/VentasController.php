<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Clientes;
use App\Models\Venta_Productos;
use App\Models\Vendedores;
use App\Models\FormaPago;
use App\Models\Ventas;
use App\Http\Requests\UpdateVentasRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        return view('ventas.index', [
            'ventas' => Ventas::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $vendedores = Vendedores::all(); // Obtener todas las categorías
        $products = Product::all();
        $clientes = Clientes::all();
        $forma_pago = FormaPago::all();
        return view('ventas.create', compact('vendedores', 'products', 'clientes', 'forma_pago'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_vendedores' => 'required|exists:vendedores,id',
            'id_clientes' => 'required|exists:clientes,id',
            'id_formapagos' => 'required|exists:forma_pagos,id',
            'cambio' => 'required|numeric',
            'total' => 'required|numeric',
            'productos' => 'required|array',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $subtotal = $request->total - ($request->total * 0.16);
        $iva = $request->total * 0.16;

        $venta = Ventas::create([
            'id_clientes' => $request->id_clientes,
            'id_vendedores' => $request->id_vendedores,
            'id_formapagos' => $request->id_formapagos,
            'cambio' => $request->cambio,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $request->total,
        ]);


        foreach ($request->productos as $productoId => $productoData) {
            Venta_Productos::create([
                'id_ventas' => $venta->id,
                'id_productos' => $productoId,
                'cantidad' => $productoData['cantidad'],
            ]);
        }

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
        $vendedores = Vendedores::all();
        $products = Product::all();
        $clientes = Clientes::all();

        return view('ventas.edit', compact('vendedores', 'products', 'clientes'));
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
