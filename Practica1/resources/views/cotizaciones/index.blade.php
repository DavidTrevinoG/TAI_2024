@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-4/4 mx-auto">

        <!-- Mensaje de éxito -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            {{ session('error') }}
            <br>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Contenido principal -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-6">Cotizaciones</h2>

                <!-- Botón para agregar un Proveedor -->
                <a href="{{ route('cotizaciones.create') }}" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded inline-flex items-center mb-4">
                    <i class="bi bi-plus-circle mr-2"></i> Agregar una cotizacion
                </a>

                <!-- Tabla de listado de Proveedores -->
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clientes</th>
                            <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Productos</th>
                            <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha cotizacion</th>
                            <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vigencia</th>
                            <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comentarios</th>
                            <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($cotizaciones as $cotizacion)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $cotizacion->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $cotizacion->clientes->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $cotizacion->productos->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $cotizacion->fecha_cotizacion }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $cotizacion->vigencia }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $cotizacion->comentarios }}</td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <form id="deleteForm" action="{{ route('cotizaciones.destroy', $cotizacion->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('cotizaciones.show', $cotizacion->id) }}" class="bg-yellow-500 hover:bg-yellow-700 font-bold py-1 px-2 rounded"><i class="bi bi-eye"></i>Mostrar</a>
                                    <a href="{{ route('cotizaciones.edit', $cotizacion->id) }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-1 px-2 rounded"><i class="bi bi-pencil-square"></i>Editar</a>
                                    <button id="deleteButton" type="submit" class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded"><i class="bi bi-trash"></i>Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No se encontraron cotizaciones.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('deleteForm');
        const submitButton = document.getElementById('deleteButton');

        form.addEventListener('submit', function() {
            submitButton.setAttribute('disabled', 'disabled');
            submitButton.innerText = 'Eliminando...';
        });
    });
</script>

@endsection