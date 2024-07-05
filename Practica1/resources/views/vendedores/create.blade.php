@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Agregar un Vendedor</h2>
                    <a href="{{ route('vendedores.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <form id="vendedoresForm" action="{{ route('vendedores.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('nombre') border-red-500 @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}">
                        @error('nombre')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('telefono') border-red-500 @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}">
                        @error('telefono')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="correo" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                        <input type="email" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('correo') border-red-500 @enderror" id="correo" name="correo" value="{{ old('correo') }}">
                        @error('correo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button type="submit" id="submitButton" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Agregar Vendedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('vendedoresForm');
        const submitButton = document.getElementById('submitButton');

        form.addEventListener('submit', function() {
            submitButton.setAttribute('disabled', 'disabled');
            submitButton.innerText = 'Enviando...';
        });
    });
</script>

@endsection