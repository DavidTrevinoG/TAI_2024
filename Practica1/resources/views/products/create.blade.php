@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Agregar un Producto</h2>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>
                <form action="{{ route('products.store') }}" method="post">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                        <select class="form-select mt-1 block w-full rounded-md border-gray-300 @error('category_id') border-red-500 @enderror" id="category_id" name="category_id">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="precio_venta" class="block text-sm font-medium text-gray-700">Precio Venta</label>
                        <input type="number" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('precio_venta') border-red-500 @enderror" id="precio_venta" name="precio_venta" value="{{ old('precio_venta') }}">
                        @error('precio_venta')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="precio_compra" class="block text-sm font-medium text-gray-700">Precio Compra</label>
                        <input type="number" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('precio_compra') border-red-500 @enderror" id="precio_compra" name="precio_compra" value="{{ old('precio_compra') }}">
                        @error('precio_compra')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="fecha_anadido" class="block text-sm font-medium text-gray-700">Fecha Añadido</label>
                        <input type="date" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('fecha_anadido') border-red-500 @enderror" id="fecha_anadido" name="fecha_anadido" value="{{ old('fecha_anadido') }}">
                        @error('fecha_anadido')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('color') border-red-500 @enderror" id="color" name="color" value="{{ old('color') }}">
                        @error('color')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="descripcion_corta" class="block text-sm font-medium text-gray-700">Descripción Corta</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('descripcion_corta') border-red-500 @enderror" id="descripcion_corta" name="descripcion_corta">{{ old('descripcion_corta') }}</textarea>
                        @error('descripcion_corta')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="descripcion_larga" class="block text-sm font-medium text-gray-700">Descripción Larga</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('descripcion_larga') border-red-500 @enderror" id="descripcion_larga" name="descripcion_larga">{{ old('descripcion_larga') }}</textarea>
                        @error('descripcion_larga')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Agregar Producto</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection