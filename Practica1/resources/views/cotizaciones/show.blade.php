@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Información de Cotización</h2>
                    <a href="{{ route('cotizaciones.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <div class="grid grid-cols-2 gap-y-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cliente" class="block text-sm font-medium text-gray-700"><strong>Cliente:</strong></label>
                        <p class="mt-1">{{ $cotizacione->clientes->nombre}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cliente" class="block text-sm font-medium text-gray-700"><strong>Producto:</strong></label>
                        <p class="mt-1">{{ $cotizacione->productos->nombre}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="fecha_cotizacion" class="block text-sm font-medium text-gray-700"><strong>Fecha Cotización:</strong></label>
                        <p class="mt-1">{{ $cotizacione->fecha_cotizacion}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="vigencia" class="block text-sm font-medium text-gray-700"><strong>Vigencia:</strong></label>
                        <p class="mt-1">{{ $cotizacione->vigencia}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="comentarios" class="block text-sm font-medium text-gray-700"><strong>Comentarios:</strong></label>
                        <p class="mt-1">{{ $cotizacione->comentarios}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection