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
                        <p class="mt-1">{{ $cotizacione->clientes->nombre }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="fecha_cotizacion" class="block text-sm font-medium text-gray-700"><strong>Fecha Cotización:</strong></label>
                        <p class="mt-1">{{ $cotizacione->created_at }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="vigencia" class="block text-sm font-medium text-gray-700"><strong>Vigencia:</strong></label>
                        <p class="mt-1">{{ $cotizacione->vigencia }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="comentarios" class="block text-sm font-medium text-gray-700"><strong>Comentarios:</strong></label>
                        <p class="mt-1">{{ $cotizacione->comentarios }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-4">Productos en la Cotización</h3>
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Precio Unitario</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $subtotal = 0;
                            @endphp
                            @foreach($cotizacion_productos as $producto)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $producto->productos->nombre }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $producto->cantidad }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ '$'.number_format($producto->productos->precio_venta, 2) }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ '$'.number_format($producto->cantidad * $producto->productos->precio_venta, 2) }}</td>
                            </tr>
                            @php
                            $subtotal += $producto->cantidad * $producto->productos->precio_venta;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <div class="flex justify-between">
                        <div class="flex justify-end">
                            <h3 class="text-xl font-semibold mb-4">Costos</h3>
                            <br><br>
                            Subtotal (sin IVA): {{ '$'.number_format($total/1.16, 2) }}
                            <br>
                            IVA (16%): {{ '$'.number_format($total - ($total/1.16), 2) }}
                            <br>
                            Total (con IVA): {{ '$'.number_format($total, 2) }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection