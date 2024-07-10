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
    public function pdf(Cotizaciones $cotizacione)
    {
        $pdf = app('dompdf.wrapper');

        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                }
                h1 {
                    text-align: center;
                    color: #4CAF50;
                }
                .header, .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                }
                .header {
                    top: 0px;
                }
                .footer {
                    bottom: 0px;
                    font-size: 12px;
                    color: #777;
                }
                .content {
                    margin-top: 50px;
                    margin-bottom: 50px;
                }
                .table {
                    width: 100%;
                    border-collapse: collapse;
                }
                .table, .table th, .table td {
                    border: 1px solid #ddd;
                }
                .table th, .table td {
                    padding: 8px;
                    text-align: left;
                }
                .table th {
                    background-color: #f2f2f2;
                }
                .total {
                    text-align: right;
                    font-size: 16px;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Cotización</h1>
            </div>
            <div class="footer">
                <p>© ' . date("Y") . ' Cotización</p>
            </div>
            <div class="content">
                <h2>Detalles de la Cotización</h2>
                <p><strong>ID:</strong> ' . $cotizacione->id . '</p>
                <p><strong>Fecha:</strong> ' . date("Y-m-d") . '</p>
                <p><strong>Cliente:</strong> ' . $cotizacione->clientes->nombre . '</p>
                <p><strong>Descripción:</strong> ' . $cotizacione->comentarios . '</p>
    
                <h3>Items</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>';


        // Supongamos que tienes una relación 'items' en el modelo Cotizaciones

        $html .= '
                        <tr>
                            <td>' . $cotizacione->productos->nombre . '</td>
                            <td>' . $cotizacione->cantidad . '</td>
                            <td>' . $cotizacione->productos->precio_venta . '</td>
                            <td>' . ($cotizacione->cantidad * $cotizacione->productos->precio_venta) . '</td>
                        </tr>';


        $html .= '
                    </tbody>
                </table>
    
                <p class="total"><strong>Total:</strong> ' .   ($cotizacione->cantidad * $cotizacione->productos->precio_venta)  . '</p>
            </div>
        </body>
        </html>';

        $pdf->loadHTML($html);

        return $pdf->download($cotizacione->id . '_' . date("Y-m-d") . '_cotizacion.pdf');
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
