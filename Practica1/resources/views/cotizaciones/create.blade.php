@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Agregar una nueva cotización</h2>
                    <a href="{{ route('cotizaciones.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <form id="cotizacionesForm" action="{{ route('cotizaciones.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="id_clientes" class="block text-sm font-medium text-gray-700">Cliente</label>
                        <select id="id_clientes" name="id_clientes" class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_clientes') border-red-500 @enderror">
                            @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_clientes')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="id_productos" class="block text-sm font-medium text-gray-700">Producto</label>
                        <select id="id_productos" name="id_productos" class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_productos') border-red-500 @enderror">
                            @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_productos')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="vigencia" class="block text-sm font-medium text-gray-700">Vigencia</label>
                        <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('vigencia') border-red-500 @enderror" id="vigencia" name="vigencia" value="{{ old('vigencia') }}" min="{{ date('Y-m-d') }}">
                        @error('vigencia')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('cantidad') border-red-500 @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad') }}">
                        @error('cantidad')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="comentarios" class="block text-sm font-medium text-gray-700">Comentarios</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('comentarios') border-red-500 @enderror" id="comentarios" name="comentarios">{{ old('comentarios') }}</textarea>
                        @error('comentarios')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button id="submitButton" type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Agregar Cotización</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('cotizacionesForm');
        const submitButton = document.getElementById('submitButton');

        form.addEventListener('submit', function() {
            submitButton.setAttribute('disabled', 'disabled');
            submitButton.innerText = 'Enviando...';
        });
    });
</script>

@endsection