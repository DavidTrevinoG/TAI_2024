@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        @session('success')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ $value }}
        </div>
        @endsession

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Edit Product</h2>
                    <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
                <form action="{{ route('ventas.update', $venta->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-4">
                        <label for="producto_id" class="block text-sm font-medium text-gray-700">Producto</label>
                        <select class="form-select mt-1 block w-full rounded-md border-gray-300 @error('producto_id') border-red-500 @enderror" id="producto_id" name="producto_id">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $ventas->producto->id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
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
                            <option value="{{ $category->id }}" {{ $ventas->category->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cliente_id" class="block text-sm font-medium text-gray-700">Clientes</label>
                        <select class="form-select mt-1 block w-full rounded-md border-gray-300 @error('cliente_id') border-red-500 @enderror" id="cliente_id" name="cliente_id">
                            @foreach($clientes as $cliente)
                            <option value="{{ $clientes->id }}" {{ $ventas->cliente->id == $clientes->id ? 'selected' : '' }}>{{ $clientes->name }}</option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('cantidad') border-red-500 @enderror" id="cantidad" name="cantidad" value="{{ $ventas->cantidad }}">
                        @error('cantidad')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="fecha_venta" class="block text-sm font-medium text-gray-700">Fecha Venta</label>
                        <input type="date" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('fecha_venta') border-red-500 @enderror" id="fecha_venta" name="fecha_venta" value="{{ $ventas->fecha_venta }}">
                        @error('fecha_venta')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="subtotal" class="block text-sm font-medium text-gray-700">Subtotal</label>
                        <input type="number" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('subtotal') border-red-500 @enderror" id="subtotal" name="subtotal" value="{{ $ventas->subtotal }}">
                        @error('subtotal')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium  bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection