<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Http\Requests\StoreClientesRequest;
use App\Http\Requests\UpdateClientesRequest;
use Illuminate\View\View;
use App\Models\Ventas;
use Illuminate\Http\RedirectResponse;

class ClientesController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    // Función para mostrar la lista de clientes
    public function index(): View
    {
        return view('clientes.index', [
            'clientes' => Clientes::latest()->paginate()
        ]);
    }

    public function pdf(Clientes $cliente)
    {
        // Obtener las ventas con los productos asociados para el cliente específico
        $ventasPorCliente = Clientes::with(['ventas.venta_productos.productos'])
            ->where('id', $cliente->id)
            ->get();

        // Verificar si el cliente tiene ventas
        if ($ventasPorCliente->isEmpty()) {
            return response()->json(['message' => 'No se encontraron ventas para el cliente'], 404);
        }

        $pdf = app('dompdf.wrapper');

        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isPhpEnabled', true);

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
                 <h1>Ventas por Cliente</h1>
             </div>
             <div class="content">
        ';

        foreach ($ventasPorCliente as $cliente) {
            $html .= '
                 <h2>Cliente: ' . $cliente->nombre . '</h2>';

            foreach ($cliente->ventas as $venta) {
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
             ';
            }
        }

        $html .= '
         </body>
         </html>';

        $pdf->loadHTML($html);

        return $pdf->download('ventas_por_cliente_' . $cliente->id . '_' . date("Y-m-d") . '.pdf');
    }



    public function pdfAll()
    {
        $clientes = Clientes::all();
        $pdf = app('dompdf.wrapper');

        $html = '
        <html>
        <head>
            <style>
    @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 400;
        src: url("Roboto-Regular.ttf") format("truetype");
    }
    body {
        font-family: "Roboto", sans-serif;
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
                <h1>Clientes</h1>
            </div>
        
            <div class="content">';


        $html .= '
            <table id="Table" class="table min-w-full divide-y divide-gray-200">
                        <!-- Encabezados de la tabla -->
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefono</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Direccion</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RFC</th>
                            </tr>
                        </thead>
                        <!-- Cuerpo de la tabla -->
                        <tbody class=" divide-y divide-gray-200">
            ';
        foreach ($clientes as $cliente) {
            $html .= '
                            <tr>
                                <td class="px-6 py-4 "> ' . $cliente->id . '</td>
                                <td class="px-6 py-4 "> ' . $cliente->nombre . '</td>
                                <td class="px-6 py-4 "> ' . $cliente->correo . '</td>
                                <td class="px-6 py-4 "> ' . $cliente->telefono . '</td>
                                <td class="px-6 py-4 "> ' . $cliente->direccion . '</td>
                                <td class="px-6 py-4 ">' . $cliente->rfc . '</td>
                                
                            </tr>';
        }

        $html .= '
                        </tbody>
                    </table>';


        $html .= '
            </div>
        </body>
        </html>';

        $pdf->loadHTML($html);

        return $pdf->download('clientes_' . date("Y-m-d") . '.pdf');
    }


    /**
     * Show the form for creating a new resource.
     */

    // Función para crear un nuevo cliente
    public function create(): View
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar el nuevo cliente
    public function store(StoreClientesRequest $request): RedirectResponse
    {
        Clientes::create($request->validated());


        return redirect()->route('clientes.index')
            ->withSuccess('Nueva cliente agregada.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar un cliente
    public function show(Clientes $cliente): View
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar un cliente
    public function edit(Clientes $cliente): View
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */

    // Función para actualizar un cliente
    public function update(UpdateClientesRequest $request, Clientes $cliente): RedirectResponse
    {
        $cliente->update($request->validated());

        return redirect()->back()
            ->withSuccess('Cliente is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    // Función para eliminar un cliente
    public function destroy(Clientes $cliente): RedirectResponse
    {

        if ($cliente->cotizaciones()->count() > 0) {
            return redirect()->route('clientes.index')
                ->with('error', 'Cliente no puede ser eliminada porque tiene cotizaciones asociadas.');
        }


        $cliente->delete();

        return redirect()->route('clientes.index')
            ->withSuccess('Cliente is deleted successfully.');
    }
}
