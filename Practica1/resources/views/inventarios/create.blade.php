@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Agregar nuevo inventario</h2>
                    <a href="{{ route('inventarios.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
                <form action="{{ route('inventarios.store') }}" method="post">
                    @csrf

                    <div class="mb-4">
                        <label for="producto_id" class="block text-sm font-medium text-gray-700">Producto</label>
                        <select class="form-select mt-1 block w-full rounded-md border-gray-300 @error('producto_id') border-red-500 @enderror" id="producto_id" name="producto_id">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('producto_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('producto_id')
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
                        <label for="fecha_entrada" class="block text-sm font-medium text-gray-700">Fecha Entrada</label>
                        <input type="date" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('fecha_entrada') border-red-500 @enderror" id="fecha_entrada" name="fecha_entrada" value="{{ old('fecha_entrada') }}">
                        @error('fecha_entrada')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="fecha_salida" class="block text-sm font-medium text-gray-700">Fecha Salida</label>
                        <input type="date" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('fecha_salida') border-red-500 @enderror" id="fecha_salida" name="fecha_salida" value="{{ old('fecha_salida') }}">
                        @error('fecha_salida')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('motivo') border-red-500 @enderror" id="motivo" name="motivo">{{ old('motivo') }}</textarea>
                        @error('motivo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tipo_movimiento" class="block text-sm font-medium text-gray-700">Tipo de Movimiento</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('tipo_movimiento') border-red-500 @enderror" id="tipo_movimiento" name="tipo_movimiento">{{ old('tipo_movimiento') }}</textarea>
                        @error('tipo_movimiento')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('cantidad') border-red-500 @enderror" id="cantidad" name="cantidad">{{ old('cantidad') }}</textarea>
                        @error('cantidad')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Agregar Inventario</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection