@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Editar Proveedor</h2>
                    <a href="{{ route('proveedores.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <form action="{{ route('proveedores.update', $proveedore->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('nombre') border-red-500 @enderror" id="nombre" name="nombre" value="{{ $proveedore->nombre }}">
                        @error('nombre')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="nombre_contacto" class="block text-sm font-medium text-gray-700">Nombre de Contacto</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('nombre_contacto') border-red-500 @enderror" id="nombre_contacto" name="nombre_contacto" value="{{ $proveedore->nombre_contacto }}">
                        @error('nombre_contacto')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('telefono') border-red-500 @enderror" id="telefono" name="telefono" value="{{ $proveedore->telefono }}">
                        @error('telefono')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="correo" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                        <input type="email" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('correo') border-red-500 @enderror" id="correo" name="correo" value="{{ $proveedore->correo }}">
                        @error('correo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium  bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Actualizar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection