<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Asegúrate de importar el modelo Category
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
    public function store(StoreProductRequest $request): RedirectResponse
    {
        Product::create($request->validated());

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
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->back()
            ->withSuccess('Product is updated successfully.');
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

        $product->delete();

        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }
}
