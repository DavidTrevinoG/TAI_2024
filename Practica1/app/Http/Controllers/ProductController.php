<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Asegúrate de importar el modelo Category
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Función para mostrar la lista de productos
    public function index(): View
    {
        return view('products.index', [
            'products' => Product::latest()->paginate()
        ]);
    }

    public function pdfStock()
    {
        $productos = Product::all();
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
                <h1>Stock de Productos</h1>
            </div>
            <div class="content">';


        $html .= '
            <table id="Table" class="table min-w-full divide-y divide-gray-200">
                        <!-- Encabezados de la tabla -->
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Existencia</th>

                            </tr>
                        </thead>
                        <!-- Cuerpo de la tabla -->
                        <tbody class=" divide-y divide-gray-200">
            ';
        foreach ($productos as $pr) {
            $html .= '
                            <tr>
                                <td class="px-6 py-4 "> ' . $pr->id . '</td>
                                <td class="px-6 py-4 "> ' . $pr->nombre . '</td>
                                <td class="px-6 py-4 "> ' . $pr->existencia() . '</td>
                                
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

        return $pdf->download('stock_productos_' . date("Y-m-d") . '.pdf');
    }


    public function pdfAll()
    {
        $productos = Product::all();
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
                <h1>Productos</h1>
            </div>
            <div class="content">';


        $html .= '
            <table id="Table" class="table min-w-full divide-y divide-gray-200">
                        <!-- Encabezados de la tabla -->
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Venta</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Compra</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color</th>
                            </tr>
                        </thead>
                        <!-- Cuerpo de la tabla -->
                        <tbody class=" divide-y divide-gray-200">
            ';
        foreach ($productos as $pr) {
            $html .= '
                            <tr>
                                <td class="px-6 py-4 "> ' . $pr->id . '</td>
                                <td class="px-6 py-4 "> ' . $pr->nombre . '</td>
                                <td class="px-6 py-4 "> ' . $pr->category->nombre . '</td>
                                <td class="px-6 py-4 "> ' . $pr->precio_venta . '</td>
                                <td class="px-6 py-4 "> ' . $pr->precio_compra . '</td>
                                <td class="px-6 py-4 "> ' . $pr->fecha_compra . '</td>
                                <td class="px-6 py-4 "> ' . $pr->color . '</td>
                                
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

        return $pdf->download('productos_' . date("Y-m-d") . '.pdf');
    }
    /**
     * Show the form for creating a new resource.
     */

    // Función para crear un nuevo producto
    public function create(): View
    {
        $categories = Category::all(); // Obtener todas las categorías
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar el nuevo producto
    public function store(Request $request): RedirectResponse
    {
        // Validar la solicitud
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'id_categorias' => 'required|integer',
            'precio_venta' => 'required|numeric',
            'precio_compra' => 'required|numeric',
            'fecha_compra' => 'required|date',
            'color' => 'nullable|string|max:255',
            'descripcion_corta' => 'nullable|string',
            'descripcion_larga' => 'nullable|string',
            'existencia' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
        ]);

        // Inicializa la ruta de la imagen
        $imagePath = null;

        if ($request->hasFile('image')) {
            // Obtener el archivo de la solicitud
            $image = $request->file('image');

            // Generar un nombre único para el archivo
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Almacenar el archivo en el disco local
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }

        // Agrega la URL de la imagen al array de datos si se cargó una imagen
        $validated['image'] = $imagePath;

        // Crear el producto con los datos validados y la URL de la imagen
        Product::create($validated);

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('products.index')
            ->withSuccess('Nuevo producto agregado.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar un producto
    public function show(Product $product): View
    {
        $categories = Category::all(); // Obtener todas las categorías
        return view('products.show', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar un producto
    public function edit(Product $product): View
    {
        $categories = Category::all(); // Obtener todas las categorías
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */

    // Función para actualizar un producto

    public function update(Request $request, $id): RedirectResponse
    {
        // Validar la solicitud
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'id_categorias' => 'required|integer',
            'precio_venta' => 'required|numeric',
            'precio_compra' => 'required|numeric',
            'fecha_compra' => 'required|date',
            'color' => 'nullable|string|max:255',
            'descripcion_corta' => 'nullable|string',
            'descripcion_larga' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
        ]);

        // Encontrar el producto que se va a actualizar
        $product = Product::findOrFail($id);

        // Inicializa la ruta de la imagen
        $imagePath = $product->image;

        // Verificar si se ha subido una nueva imagen
        if ($request->hasFile('image')) {
            // Obtener el archivo de la solicitud
            $image = $request->file('image');

            // Generar un nombre único para el archivo
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Almacenar el archivo en el disco local
            $imagePath = $image->storeAs('images', $imageName, 'public');

            // Eliminar la imagen antigua si existe
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
        }

        // Actualizar el producto con los datos validados y la nueva URL de la imagen
        $product->update(array_merge($validated, ['image' => $imagePath]));

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('products.index')
            ->withSuccess('Producto actualizado con éxito.');
    }


    /**
     * Remove the specified resource from storage.
     */

    // Función para eliminar un producto
    public function destroy(Product $product): RedirectResponse
    {

        if ($product->inventarios()->count() > 0) {
            return redirect()->route('products.index')
                ->with('error', 'Producto no puede ser eliminado porque tiene inventarios asociados.');
        }

        if ($product->cotizaciones()->count() > 0) {
            return redirect()->route('products.index')
                ->with('error', 'Producto no puede ser eliminado porque tiene cotizaciones asociadas.');
        }

        if ($product->compras()->count() > 0) {
            return redirect()->route('products.index')
                ->with('error', 'Producto no puede ser eliminado porque tiene compras asociadas.');
        }

        $product->delete();

        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }
}
