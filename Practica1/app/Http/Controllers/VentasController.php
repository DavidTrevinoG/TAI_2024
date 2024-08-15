<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Clientes;
use App\Models\Venta_Productos;
use App\Models\Vendedores;
use App\Models\FormaPago;
use App\Models\Ventas;
use App\Models\Inventarios;
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
    public function pdfAll()
    {
        $ventas = Ventas::with('venta_productos.productos')->get();
        $pdf = app('dompdf.wrapper');

        $html = '
        <html>
        <head>
            <style>
                @font-face {
                    font-family: \'Roboto\';
                    font-style: normal;
                    font-weight: 400;
                    src: url("Roboto-Regular.ttf") format("truetype");
                }
                body {
                    font-family: \'Roboto\', sans-serif;
                    margin: 20px;
                }
                h1 {
                    text-align: center;
                    color: #0101f2;
                }
                .header, .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                }
                .header {
                    top: 0px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
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
                .details {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 20px;
                }
                .details div {
                    width: 48%;
                }
                .table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
                }
                .table, .table th, .table td {
                    border: 1px solid #ddd;
                }
                .table th, .table td {
                    padding: 12px;
                    text-align: left;
                }
                .table th {
                    background-color: #f2f2f2;
                    font-weight: bold;
                    color: #333;
                }
                .table tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
                .total {
                    text-align: right;
                    font-size: 16px;
                    font-weight: bold;
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div>
                <h1>VENTAS</h1>
            </div>
        
            <div class="content">';

        foreach ($ventas as $venta) {
            $total = 0;
            $html .= '
                <div>
                    <div style="text-align: left;">
                        <strong>Fecha:</strong> ' . $venta->created_at->format('Y-m-d') . ' <br>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($venta->venta_productos as $item) {
                $html .= '
                        <tr>
                            <td>' . $item->productos->nombre . '</td>
                            <td>' . $item->cantidad . '</td>
                            <td>' . number_format($item->productos->precio_venta, 2) . '</td>
                            <td>' . number_format($item->cantidad * $item->productos->precio_venta, 2) . '</td>
                        </tr>';
                $total += $item->cantidad * $item->productos->precio_venta;
            }

            $subtotal = $total / 1.16; // Se calcula el subtotal sin IVA
            $iva = $total - $subtotal; // Se calcula el IVA
            $html .= '
                    </tbody>
                </table>
                <p class="total"><strong>SubTotal:</strong> ' . number_format($subtotal, 2) . '</p>
                <p class="total"><strong>IVA(16%):</strong> ' . number_format($iva, 2) . '</p>
                <p class="total"><strong>Total:</strong> ' . number_format($total, 2) . '</p>';
        }

        $html .= '
            </div>
        </body>
        </html>';

        $pdf->loadHTML($html);

        return $pdf->download('todas_las_ventas_' . date("Y-m-d") . '.pdf');
    }




    public function pdf(Ventas $venta)
    {
        $pdf = app('dompdf.wrapper');

        $html = '
         <html>
         <head>
             <style>
                 @font-face {
                     font-family: \'Roboto\';
                     font-style: normal;
                     font-weight: 400;
                     src: url("Roboto-Regular.ttf") format("truetype");
                 }
                 body {
                     font-family: \'Roboto\', sans-serif;
                     margin: 20px;
                 }
                 h1 {
                     text-align: center;
                     color: #0101f2;
                 }
                 .header, .footer {
                     width: 100%;
                     text-align: center;
                     position: fixed;
                 }
                 .header {
                     top: 0px;
                     display: flex;
                     justify-content: space-between;
                     align-items: center;
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
                 .details {
                     display: flex;
                     justify-content: space-between;
                     margin-bottom: 20px;
                 }
                 .details div {
                     width: 48%;
                 }
                 .table {
                     width: 100%;
                     border-collapse: collapse;
                     margin-top: 20px;
                     box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
                 }
                 .table, .table th, .table td {
                     border: 1px solid #ddd;
                 }
                 .table th, .table td {
                     padding: 12px;
                     text-align: left;
                 }
                 .table th {
                     background-color: #f2f2f2;
                     font-weight: bold;
                     color: #333;
                 }
                 .table tr:nth-child(even) {
                     background-color: #f9f9f9;
                 }
                 .total {
                     text-align: right;
                     font-size: 16px;
                     font-weight: bold;
                     margin-top: 20px;
                 }
             </style>
         </head>
         <body>
             <div class="header">
                 <h1>VENTA</h1>
             </div>
             <div class="footer">
                 <p>© ' . date("Y") . ' Cotización</p>
             </div>
             <div class="content">
                 <div>
                     <div style="text-align: left;">
                         <strong>Fecha:</strong> ' . $venta->created_at->format('Y-m-d') . ' <br>
                   
                     </div>
                 </div>
     
                 <table class="table">
                     <thead>
                         <tr>
                             <th>Producto</th>
                             <th>Cantidad</th>
                             <th>Precio Unitario</th>
                             <th>Total</th>
                         </tr>
                     </thead>
                     <tbody>';

        $total = 0;
        foreach ($venta->venta_productos as $item) {
            $html .= '
                         <tr>
                             <td>' . $item->productos->nombre . '</td>
                             <td>' . $item->cantidad . '</td>
                             <td>' . number_format($item->productos->precio_venta, 2) . '</td>
                             <td>' . number_format($item->cantidad * $item->productos->precio_venta, 2) . '</td>
                         </tr>';
            $total += $item->cantidad * $item->productos->precio_venta;
        }

        $subtotal = $total / 1.16; // Se calcula el subtotal sin IVA
        $iva = $total - $subtotal; // Se calcula el IVA
        $html .= '
                     </tbody>
                 </table>
     
                 <p class="total"><strong>SubTotal:</strong> ' . number_format($subtotal, 2) . '</p>
                 <p class="total"><strong>IVA(16%):</strong> ' . number_format($iva, 2) . '</p>
                 <p class="total"><strong>Total:</strong> ' . number_format($total, 2) . '</p>
     
             </div>
         </body>
         </html>';

        $pdf->loadHTML($html);

        return $pdf->download($venta->id . '_' . date("Y-m-d") . '_venta.pdf');
    }





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

        $subtotal = $request->total / 1.16;
        $iva = $request->total - $subtotal;

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

            Inventarios::create([
                'id_productos' => $productoId,
                'fecha_salida' => now(),
                'movimiento' => 'Salida',
                'motivo' => 'Venta',
                'cantidad' => $productoData['cantidad'],
            ]);
        }

        return redirect()->route('ventas.index')
            ->withSuccess('Nueva venta agregado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ventas $venta): View
    {
        return view('ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ventas $venta): View
    {
        $vendedores = Vendedores::all(); // Obtener todas las categorías
        $products = Product::all();
        $clientes = Clientes::all();
        $forma_pago = FormaPago::all();
        return view('ventas.edit', compact('vendedores', 'products', 'clientes', 'forma_pago', 'venta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ventas $venta): RedirectResponse
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

        $subtotal = $request->total / 1.16;
        $iva = $request->total - $subtotal;


        $venta->update([
            'id_clientes' => $request->id_clientes,
            'id_vendedores' => $request->id_vendedores,
            'id_formapagos' => $request->id_formapagos,
            'cambio' => $request->cambio,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $request->total,
        ]);
        // Eliminar productos existentes de la cotización
        $venta->venta_productos()->delete();

        // Agregar productos actualizados a la cotización
        foreach ($request->productos as $productoId => $productoData) {
            $venta->venta_productos()->create([
                'id_ventas' => $venta->id, // 'id_cotiaciones' => 'id_cotizaciones
                'id_productos' => $productoId,
                'cantidad' => $productoData['cantidad'],
            ]);
        }

        return redirect()->route('ventas.index')
            ->withSuccess('Venta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ventas $venta): RedirectResponse
    {
        $venta->delete();

        return redirect()->route('ventas.index')
            ->withSuccess('Product is deleted successfully.');
    }
}
