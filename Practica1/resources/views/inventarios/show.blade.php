@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Información de Inventario</h2>
                    <a href="{{ route('inventarios.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>

                <div class="grid grid-cols-2 gap-y-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700"><strong>Producto:</strong></label>
                        <p class="mt-1">{{ $inventario->producto->nombre }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="fecha_entrada" class="block text-sm font-medium text-gray-700"><strong>Fecha de Entrada:</strong></label>
                        <p class="mt-1">{{ $inventario->fecha_entrada }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="fecha_salida" class="block text-sm font-medium text-gray-700"><strong>Fecha de Salida:</strong></label>
                        <p class="mt-1">{{ $inventario->fecha_salida }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="motivo" class="block text-sm font-medium text-gray-700"><strong>Motivo:</strong></label>
                        <p class="mt-1">{{ $inventario->motivo }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="tipo_movimiento" class="block text-sm font-medium text-gray-700"><strong>Movimiento:</strong></label>
                        <p class="mt-1">{{ $inventario->movimiento }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700"><strong>Cantidad:</strong></label>
                        <p class="mt-1">{{ $inventario->cantidad }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection