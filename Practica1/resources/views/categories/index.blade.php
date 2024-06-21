@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-4/4 mx-auto">

        @session('success')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ $value }}</span>
            <br>
        </div>
        @endsession

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

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-6">Lista de Categorías</h2>

                <a href="{{ route('categories.create') }}" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded inline-flex items-center mb-4">
                    <i class="bi bi-plus-circle mr-2"></i> Agregar una Categoría
                </a>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $category->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $category->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form id="deleteForm" action="{{ route('categories.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('categories.show', $category->id) }}" class="bg-yellow-500 hover:bg-yellow-700 font-bold py-1 px-2 rounded"><i class="bi bi-eye"></i>Mostrar</a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-1 px-2 rounded"><i class="bi bi-pencil-square"></i>Editar</a>
                                    <button id="deleteButton" type="submit" class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded"><i class="bi bi-trash"></i>Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No se encontraron categorías.</td>
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