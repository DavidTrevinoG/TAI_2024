<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;
use App\Models\Ventas;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('categories.index', [
            'categories' => Category::latest()->paginate()
        ]);
    }

    public function pdf(Category $category)
    {
        $ventas = Ventas::whereIn('id', function ($query) use ($category) {
            $query->select('venta_productos.id_ventas')
                ->from('venta_productos')
                ->join('products', 'venta_productos.id_productos', '=', 'products.id')
                ->where('products.id_categorias', $category->id);
        })->get();

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
                 <h1>Venta Categoría ' . $category->nombre . '</h1>
             </div>
             <div class="content">

             ';

        foreach ($ventas as $venta) {

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
        $html .= '
         </body>
         </html>';

        $pdf->loadHTML($html);

        return $pdf->download($category->id . '_' . $category->nombre . '_' . date("Y-m-d") . '_categoria.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    // Función para crear una nueva categoría
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    // Función para guardar la nueva categoría
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')
            ->withSuccess('Nueva categoría agregada.');
    }

    /**
     * Display the specified resource.
     */

    // Función para mostrar una categoría
    public function show(Category $category): View
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Función para editar una categoría
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */

    // Función para actualizar una categoría
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->back()
            ->withSuccess('Category is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    // Función para eliminar una categoría
    public function destroy(Category $category): RedirectResponse
    {

        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Categoría no puede ser eliminada porque tiene productos asociados.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->withSuccess('Category is deleted successfully.');
    }
}
