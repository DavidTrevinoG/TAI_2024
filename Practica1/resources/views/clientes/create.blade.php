@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Agregar un nuevo cliente</h2>
                    <a href="{{ route('clientes.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <form action="{{ route('clientes.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('email') border-red-500 @enderror" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Telefono</label>
                        <input type="number" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('telefono') border-red-500 @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}">
                        @error('telefono')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('direccion') border-red-500 @enderror" id="direccion" name="direccion" value="{{ old('direccion') }}">
                        @error('direccion')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="rfc" class="block text-sm font-medium text-gray-700">RFC</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('rfc') border-red-500 @enderror" id="rfc" name="rfc" value="{{ old('rfc') }}">
                        @error('rfc')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Agregar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection