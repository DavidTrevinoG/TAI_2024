<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use App\Http\Requests\StoreProveedoresRequest;
use App\Http\Requests\UpdateProveedoresRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('proveedores.index', [
            'proveedores' => Proveedores::latest()->paginate()
        ]);
    }

    public function pdfAll()
    {
        $proveedores = Proveedores::all();
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
                <h1>Proveedores</h1>
            </div>
            <div class="content">';


        $html .= '
            <table id="Table" class="table min-w-full divide-y divide-gray-200">
                        <!-- Encabezados de la tabla -->
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre de Contacto</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefono</th>
                            </tr>
                        </thead>
                        <!-- Cuerpo de la tabla -->
                        <tbody class=" divide-y divide-gray-200">
            ';
        foreach ($proveedores as $proveedor) {
            $html .= '
                            <tr>
                                <td class="px-6 py-4 "> ' . $proveedor->id . '</td>
                                <td class="px-6 py-4 "> ' . $proveedor->nombre . '</td>
                                <td class="px-6 py-4 "> ' . $proveedor->nombre_contacto . '</td>
                                <td class="px-6 py-4 "> ' . $proveedor->correo . '</td>
                                <td class="px-6 py-4 "> ' . $proveedor->telefono . '</td>
                                
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

        return $pdf->download('proveedores_' . date("Y-m-d") . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    // Función para crear una nueva categoría
    public function create(): View
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar la nueva categoría
    public function store(StoreProveedoresRequest $request): RedirectResponse
    {
        Proveedores::create($request->validated());

        return redirect()->route('proveedores.index')
            ->withSuccess('Nuevo Proveedor agregado.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar una categoría
    public function show(Proveedores $proveedore): View
    {
        return view('proveedores.show', compact('proveedore'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar una categoría
    public function edit(Proveedores $proveedore): View
    {
        return view('proveedores.edit', compact('proveedore'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateProveedoresRequest $request, Proveedores $proveedore): RedirectResponse
    {
        $proveedore->update($request->validated());

        return redirect()->back()
            ->withSuccess('Proveedores is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Proveedores $proveedore): RedirectResponse
    {

        if ($proveedore->compras()->count() > 0) {
            return redirect()->route('proveedores.index')
                ->with('error', 'Proveedor no puede ser eliminado porque tiene compras asociadas.');
        }

        $proveedore->delete();

        return redirect()->route('proveedores.index')
            ->withSuccess('Proveedor is deleted successfully.');
    }
}
