<?php

namespace App\Http\Controllers;

use App\Models\Inventarios;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreInventariosRequest;
use App\Http\Requests\UpdateInventariosRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class InventariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Función para mostrar la lista de inventarios
    public function index(): View
    {
        return view('inventarios.index', [
            'inventarios' => Inventarios::latest()->paginate()
        ]);
    }

    public function pdfAll()
    {
        $inventarios = Inventarios::with('producto')->get();
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
                <h1>INVENTARIOS</h1>
            </div>
            <div class="footer">
                <p>© ' . date("Y") . ' Todos los Inventarios</p>
            </div>
            <div class="content">';

        $html .= '

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Fecha Entrada</th>
                        <th>Fecha Salida</th>
                        <th>Movimiento</th>
                        <th>Motivo</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($inventarios as $inventario) {


            $html .= '
                <tr>
                    <td>' . $inventario->id . '</td>
                    <td>' . $inventario->producto->nombre . '</td>
                    <td>' . $inventario->fecha_entrada . '</td>
                    <td>' . $inventario->fecha_salida . '</td>
                    <td>' . $inventario->movimiento . '</td>
                    <td>' . $inventario->motivo . '</td>
                    <td>' . $inventario->cantidad . '</td>
                </tr>';
        }
        $html .= '
        </tbody>
    </table>
    <hr>';

        $html .= '
            </div>
        </body>
        </html>';

        $pdf->loadHTML($html);

        return $pdf->download('todos_los_inventarios_' . date("Y-m-d") . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */

    // Función para crear un nuevo inventario
    public function create(): View
    {
        $products = Product::all();
        return  view('inventarios.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar el nuevo inventario
    public function store(StoreInventariosRequest $request): RedirectResponse
    {
        Inventarios::create($request->validated());

        return redirect()->route('inventarios.index')
            ->withSuccess('Nueva inventario');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar un inventario
    public function show(Inventarios $inventario): View
    {
        $categories = Category::all();
        $products = Product::all();
        return view('inventarios.show', compact('inventario', 'categories', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar un inventario
    public function edit(Inventarios $inventario): View
    {
        $categories = Category::all();
        $products = Product::all();
        return view('inventarios.edit', compact('inventario', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */

    // Función para actualizar un inventario
    public function update(UpdateInventariosRequest $request, Inventarios $inventario): RedirectResponse
    {
        $inventario->update($request->validated());

        return redirect()->back()
            ->withSuccess('Inventario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */

    // Función para eliminar un inventario
    public function destroy(Inventarios $inventario): RedirectResponse
    {
        $inventario->delete();

        return redirect()->route('inventarios.index')
            ->withSuccess('Inventario eliminado exitosamente.');
    }
}
