@extends('layouts.app')

@section('content')

<style>
    .image-container {
        width: 100px;
        /* Ajusta el tamaño del contenedor según sea necesario */
        height: 100px;
        /* Ajusta el tamaño del contenedor según sea necesario */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .img-responsive {
        width: 100%;
        height: auto;
        object-fit: cover;
        /* Mantiene la relación de aspecto y cubre el contenedor sin deformar la imagen */
    }
</style>

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Información de la Venta</h2>
                    <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <div class="grid grid-cols-2 gap-y-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cliente" class="block text-sm font-medium text-gray-700"><strong>Cliente:</strong></label>
                        <p class="mt-1">{{ $venta->cliente->nombre }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="vendedor" class="block text-sm font-medium text-gray-700"><strong>Vendedor:</strong></label>
                        <p class="mt-1">{{ $venta->vendedor->nombre }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="fecha_venta" class="block text-sm font-medium text-gray-700"><strong>Fecha de Venta:</strong></label>
                        <p class="mt-1">{{ date('d-m-Y', strtotime($venta->created_at))  }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="forma_pago" class="block text-sm font-medium text-gray-700"><strong>Forma de Pago:</strong></label>
                        <p class="mt-1">{{ $venta->formapago->nombre }}</p>
                    </div>
                </div>

                <h3 class="text-xl font-semibold mt-6 mb-4">Productos Vendidos</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Unitario</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($venta->venta_productos as $producto)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($producto->productos->image)
                                <div class="image-container">
                                    <img src="{{ asset('storage/' . $producto->productos->image) }}" alt="{{ $producto->productos->nombre }}" class="img-responsive rounded">
                                </div>
                                @else
                                <span>No Imagen</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $producto->productos->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $producto->cantidad }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($producto->productos->precio_venta, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($producto->productos->precio_venta * $producto->cantidad, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="grid grid-cols-2 gap-y-4 mt-6">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="subtotal" class="block text-sm font-medium text-gray-700"><strong>Subtotal:</strong></label>
                        <p class="mt-1">${{ number_format($venta->subtotal, 2) }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="iva" class="block text-sm font-medium text-gray-700"><strong>IVA:</strong></label>
                        <p class="mt-1">${{ number_format($venta->iva, 2) }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="total" class="block text-sm font-medium text-gray-700"><strong>Total:</strong></label>
                        <p class="mt-1">${{ number_format($venta->total, 2) }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cambio" class="block text-sm font-medium text-gray-700"><strong>Cambio:</strong></label>
                        <p class="mt-1">${{ number_format($venta->cambio, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection