@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Información de Compra</h2>
                    <a href="{{ route('compras.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>
                <div class="grid grid-cols-2 gap-y-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cliente" class="block text-sm font-medium text-gray-700"><strong>Proveedor:</strong></label>
                        <p class="mt-1">{{ $compra->proveedores->nombre}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="producto" class="block text-sm font-medium text-gray-700"><strong>Producto:</strong></label>
                        <p class="mt-1">{{ $compra->productos->nombre}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="formapago" class="block text-sm font-medium text-gray-700"><strong>Forma de Pago:</strong></label>
                        <p class="mt-1">{{ $compra->formapago->nombre}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="fecha_compra" class="block text-sm font-medium text-gray-700"><strong>Fecha de Compra:</strong></label>
                        <p class="mt-1">{{ $compra->fecha_compra}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700"><strong>Cantidad:</strong></label>
                        <p class="mt-1">{{ $compra->cantidad}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="precio" class="block text-sm font-medium text-gray-700"><strong>Precio:</strong></label>
                        <p class="mt-1">{{ $compra->precio}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="descuento" class="block text-sm font-medium text-gray-700"><strong>Descuento:</strong></label>
                        <p class="mt-1">{{ $compra->descuento}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="total" class="block text-sm font-medium text-gray-700"><strong>Total:</strong></label>
                        <p class="mt-1">{{ $compra->total}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection