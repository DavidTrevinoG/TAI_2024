<?php

namespace App\Http\Controllers;

use App\Models\Cotizaciones;
use App\Models\Cliente;
use App\Models\Cotizacion_Producto;
use App\Models\Product;
use App\Http\Requests\StoreCotizacionesRequest;
use App\Http\Requests\UpdateCotizacionesRequest;
use Illuminate\Http\Request;
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
                <h1>Cotización</h1>
            </div>
            <div class="footer">
                <p>© ' . date("Y") . ' Cotización</p>
            </div>
            <div class="content">
                <div>
                    <div style="text-align: left;">
                        <strong>Fecha:</strong> ' . $cotizacione->created_at->format('Y-m-d') . ' <br>
                        <strong>Cliente:</strong> ' . $cotizacione->clientes->nombre . ' <br>
                        <strong>Comentarios:</strong> ' . $cotizacione->comentarios . ' <br>
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
        foreach ($cotizacione->cotizacion_producto as $item) {
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

        return $pdf->download($cotizacione->id . '_' . date("Y-m-d") . '_cotizacion.pdf');
    }


    /**
     * Show the form for creating a new resource.
     */
    // Función para crear una nueva categoría
    public function create(): View
    {
        $clientes = Clientes::all();
        return view('cotizaciones.create', compact('clientes'));
    }

    public function searchProductos(Request $request)
    {
        $search = $request->input('search');
        $productos = Product::where('nombre', 'like', "%{$search}%")->get();

        $productos = $productos->map(function ($producto) {
            return [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio_venta' => $producto->precio_venta,
                'existencia' => $producto->existencia(),
                'image' => $producto->image
            ];
        });

        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar la nueva categoría
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_clientes' => 'required|exists:clientes,id',
            'vigencia' => 'required|date',
            'comentarios' => 'nullable|string',
            'productos' => 'required|array',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $cotizacion = Cotizaciones::create([
            'id_clientes' => $request->id_clientes,
            'vigencia' => $request->vigencia,
            'comentarios' => $request->comentarios,
        ]);

        foreach ($request->productos as $productoId => $productoData) {
            Cotizacion_Producto::create([
                'id_cotizaciones' => $cotizacion->id,
                'id_productos' => $productoId,
                'cantidad' => $productoData['cantidad'],
            ]);
        }

        return redirect()->route('cotizaciones.index')
            ->withSuccess('Nueva Cotización agregado.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar una categoría
    public function show(Cotizaciones $cotizacione): View
    {
        $cotizacion_productos = Cotizacion_Producto::where('id_cotizaciones', $cotizacione->id)->get();

        $total = 0;
        foreach ($cotizacion_productos as $cotizacion_producto) {
            $total += $cotizacion_producto->cantidad * $cotizacion_producto->productos->precio_venta;
        }

        return view('cotizaciones.show', compact('cotizacione', 'cotizacion_productos', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar una categoría
    public function edit(Cotizaciones $cotizacione): View
    {
        $cotizacion_productos = Cotizacion_Producto::where('id_cotizaciones', $cotizacione->id)->get();
        $clientes = Clientes::all();
        $productos = Product::all();
        return view('cotizaciones.edit', compact('cotizacione', 'clientes', 'productos', 'cotizacion_productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cotizaciones $cotizacione): RedirectResponse
    {
        $request->validate([
            'id_clientes' => 'required|exists:clientes,id',
            'vigencia' => 'required|date',
            'comentarios' => 'nullable|string',
            'productos' => 'required|array',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $cotizacione->update([
            'id_clientes' => $request->id_clientes,
            'vigencia' => $request->vigencia,
            'comentarios' => $request->comentarios,
        ]);
        // Eliminar productos existentes de la cotización
        $cotizacione->cotizacion_producto()->delete();

        // Agregar productos actualizados a la cotización
        foreach ($request->productos as $productoId => $productoData) {
            $cotizacione->cotizacion_producto()->create([
                'id_cotiaciones' => $cotizacione->id, // 'id_cotiaciones' => 'id_cotizaciones
                'id_productos' => $productoId,
                'cantidad' => $productoData['cantidad'],
            ]);
        }

        return redirect()->route('cotizaciones.index')
            ->withSuccess('Cotización actualizada correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Cotizaciones $cotizacione): RedirectResponse
    {
        // Eliminar todas las relaciones Cotizacion_Producto asociadas
        $cotizacione->cotizacion_producto()->delete();

        // Eliminar la cotización
        $cotizacione->delete();

        return redirect()->route('cotizaciones.index')
            ->withSuccess('Cotización eliminada exitosamente junto con todos los productos asociados.');
    }
}
