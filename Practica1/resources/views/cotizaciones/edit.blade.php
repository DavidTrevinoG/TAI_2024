@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        @session('success')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ $value }}
        </div>
        @endsession

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Editar una cotización</h2>
                    <a href="{{ route('cotizaciones.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <form id="cotizacionesForm" action="{{ route('cotizaciones.update', $cotizacione->id) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="mb-4">
                        <label for="id_clientes" class="block text-sm font-medium text-gray-700">Cliente</label>
                        <select id="id_clientes" name="id_clientes" class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_clientes') border-red-500 @enderror">
                            @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $cotizacione->id_clientes == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
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
                            <option value="{{ $producto->id }}" {{ $cotizacione->id_productos == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_productos')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="fecha_cotizacion" class="block text-sm font-medium text-gray-700">Fecha cotización</label>
                        <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('fecha_cotizacion') border-red-500 @enderror" id="fecha_cotizacion" name="fecha_cotizacion" value="{{ $cotizacione->fecha_cotizacion }}">
                        @error('fecha_cotizacion')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="vigencia" class="block text-sm font-medium text-gray-700">Vigencia</label>
                        <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('vigencia') border-red-500 @enderror" id="vigencia" name="vigencia" value="{{ $cotizacione->vigencia }}">
                        @error('vigencia')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="comentarios" class="block text-sm font-medium text-gray-700">Comentarios</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('comentarios') border-red-500 @enderror" id="comentarios" name="comentarios">{{ $cotizacione->comentarios }}</textarea>
                        @error('comentarios')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button id="submitButton" type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Editar Cotización</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection