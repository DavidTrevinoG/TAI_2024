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
