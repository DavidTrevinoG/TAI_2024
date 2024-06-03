@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Ventas Information</h2>
                    <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>

                <div class="grid grid-cols-2 gap-y-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700"><strong>Name:</strong></label>
                        <p class="mt-1">{{ $ventas->producto->name }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="category" class="block text-sm font-medium text-gray-700"><strong>Categoría:</strong></label>
                        <p class="mt-1">{{ $ventas->category->name }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cliente" class="block text-sm font-medium text-gray-700"><strong>Cliente:</strong></label>
                        <p class="mt-1">{{ $ventas->cliente->name }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700"><strong>Cantidad:</strong></label>
                        <p class="mt-1">{{ $ventas->cantidad }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="fecha_venta" class="block text-sm font-medium text-gray-700"><strong>Fecha de Venta:</strong></label>
                        <p class="mt-1">{{ $ventas->fecha_venta }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="precio_venta" class="block text-sm font-medium text-gray-700"><strong>SubTotal:</strong></label>
                        <p class="mt-1">{{ $ventas->subtotal }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="precio_venta" class="block text-sm font-medium text-gray-700"><strong>Iva:</strong></label>
                        <p class="mt-1">{{ $ventas->iva }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="total" class="block text-sm font-medium text-gray-700"><strong>Total:</strong></label>
                        <p class="mt-1">{{ $ventas->total }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection