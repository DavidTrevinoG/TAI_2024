<?php

namespace App\Http\Controllers;

use App\Models\FormaPago;
use App\Models\Proveedores;
use App\Models\Product;
use App\Models\Inventarios;
use App\Models\Compras;
use App\Http\Requests\StoreComprasRequest;
use App\Http\Requests\UpdateComprasRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('compras.index', [
            'compras' => Compras::latest()->paginate()
        ]);
    }

    public function pdfAll()
    {
        $compras = Compras::with('productos', 'proveedores', 'formapago')->get();
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
                <h1>COMPRAS</h1>
            </div>
            <div class="content">';

        foreach ($compras as $compra) {
            $html .= '
            <div>
                <div style="text-align: left;">
                    <strong>Fecha:</strong> ' . $compra->fecha_compra . ' <br>
                    <strong>Proveedor:</strong> ' . $compra->proveedores->nombre . ' <br>
                    <strong>Forma de Pago:</strong> ' . $compra->formapago->nombre . ' <br>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Descuento</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>';

            $total = 0;
            $html .= '
                <tr>
                    <td>' . $compra->productos->nombre . '</td>
                    <td>' . $compra->cantidad . '</td>
                    <td>' . number_format($compra->precio, 2) . '</td>
                    <td>' . number_format($compra->descuento, 2) . '</td>
                    <td>' . number_format($compra->total, 2) . '</td>
                </tr>';
            $total += $compra->total;

            $html .= '
                </tbody>
            </table>

            <p class="total"><strong>Total Compra:</strong> ' . number_format($total, 2) . '</p>
            <hr>';
        }

        $html .= '
            </div>
        </body>
        </html>';

        $pdf->loadHTML($html);

        return $pdf->download('todas_las_compras_' . date("Y-m-d") . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    // Función para crear una nueva categoría
    public function create(): View
    {
        $proveedores = Proveedores::all();
        $formapago = FormaPago::all();
        $productos = Product::all();
        return view('compras.create', compact('proveedores', 'productos', 'formapago'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreComprasRequest $request): RedirectResponse
    {
        $compra = Compras::create($request->validated());

        $producto = Product::find($request->id_productos);
        $producto->precio_compra = $compra->precio;
        $producto->precio_venta = $compra->precio * 1.20;
        $producto->save();

        Inventarios::create([
            'id_productos' => $request->id_productos,
            'fecha_entrada' => now(),
            'movimiento' => 'Entrada',
            'motivo' => 'compra',
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->route('compras.index')
            ->withSuccess('Nueva compra agregada.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar una categoría
    public function show(Compras $compra): View
    {
        return view('compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar una categoría
    public function edit(Compras $compra): View
    {
        $proveedores = Proveedores::all();
        $formapago = FormaPago::all();
        $productos = Product::all();
        return view('compras.edit', compact('proveedores', 'productos', 'formapago', 'compra'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateComprasRequest $request, Compras $compra): RedirectResponse
    {
        $compra->update($request->validated());

        return redirect()->back()
            ->withSuccess('Compras is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Compras $compra): RedirectResponse
    {
        $compra->delete();

        return redirect()->route('compras.index')
            ->withSuccess('Compra is deleted successfully.');
    }
}
