<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
        $category->delete();

        return redirect()->route('categories.index')
            ->withSuccess('Category is deleted successfully.');
    }
}
