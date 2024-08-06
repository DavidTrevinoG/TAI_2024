@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Información de Producto</h2>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <div class="grid grid-cols-2 gap-y-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700"><strong>Nombre:</strong></label>
                        <p class="mt-1">{{ $product->nombre }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="category" class="block text-sm font-medium text-gray-700"><strong>Categoría:</strong></label>
                        <p class="mt-1">{{ $product->category->nombre }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="precio_venta" class="block text-sm font-medium text-gray-700"><strong>Precio Venta:</strong></label>
                        <p class="mt-1">{{ $product->precio_venta }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="precio_compra" class="block text-sm font-medium text-gray-700"><strong>Precio Compra:</strong></label>
                        <p class="mt-1">{{ $product->precio_compra}}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="fecha_anadido" class="block text-sm font-medium text-gray-700"><strong>Fecha Compra:</strong></label>
                        <p class="mt-1">{{ $product->fecha_compra }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="color" class="block text-sm font-medium text-gray-700"><strong>Color:</strong></label>
                        <p class="mt-1">{{ $product->color }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="descripcion_corta" class="block text-sm font-medium text-gray-700"><strong>Descripción Corta:</strong></label>
                        <p class="mt-1">{{ $product->descripcion_corta }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="descripcion_larga" class="block text-sm font-medium text-gray-700"><strong>Descripcion Larga:</strong></label>
                        <p class="mt-1">{{ $product->descripcion_larga }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="existencia" class="block text-sm font-medium text-gray-700"><strong>Existencia:</strong></label>
                        <p class="mt-1">{{ $product->existencia()}}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="image"><strong>Imagen:</strong></label>
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nombre }}" id="image" name="image" class="w-16 h-16 object-cover rounded">
                        @else
                        <span>No Imagen</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection