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

                <form id="clientForm" action="{{ route('clientes.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('nombre') border-red-500 @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}">
                        @error('nombre')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="correo" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('email') border-red-500 @enderror" id="correo" name="correo" value="{{ old('correo') }}">
                        @error('correo')
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
                        <label for="razon_social" class="block text-sm font-medium text-gray-700">Razón Social</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('razon_social') border-red-500 @enderror" id="razon_social" name="razon_social" value="{{ old('razon_social') }}">
                        @error('razon_social')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="codigo_postal" class="block text-sm font-medium text-gray-700">Código Postal</label>
                        <input type="number" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('codigo_postal') border-red-500 @enderror" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal') }}">
                        @error('codigo_postal')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="regimen_fiscal" class="block text-sm font-medium text-gray-700">Regimen Fiscal</label>
                        <select id="regimen_fiscal" name="regimen_fiscal" class="form-select mt-1 block w-full rounded-md border-gray-300 @error('regimen_fiscal') border-red-500 @enderror">
                            <option value="">Selecciona tu régimen fiscal</option>
                            <optgroup label="Personas Físicas">
                                <option value="Régimen Simplificado de Confianza">Régimen Simplificado de Confianza</option>
                                <option value="Sueldos y salarios e ingresos asimilados a salarios">Sueldos y salarios e ingresos asimilados a salarios</option>
                                <option value="Régimen de Actividades Empresariales y Profesionales">Régimen de Actividades Empresariales y Profesionales</option>
                                <option value="Régimen de Incorporación Fiscal">Régimen de Incorporación Fiscal</option>
                                <option value="Enajenación de bienes">Enajenación de bienes</option>
                                <option value="Régimen de Actividades Empresariales con ingresos a través de Plataformas Tecnológicas">Régimen de Actividades Empresariales con ingresos a través de Plataformas Tecnológicas</option>
                                <option value="Régimen de Arrendamiento">Régimen de Arrendamiento</option>
                                <option value="Intereses">Intereses</option>
                                <option value="Obtención de premios">Obtención de premios</option>
                                <option value="Dividendos">Dividendos</option>
                                <option value="Demás ingresos">Demás ingresos</option>
                            </optgroup>
                            <optgroup label="Persona Moral">
                                <option value="Persona Moral">Persona Moral</option>
                            </optgroup>
                        </select>
                        @error('regimen_fiscal')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button id="submitButton" type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Agregar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('clientForm');
        const submitButton = document.getElementById('submitButton');

        form.addEventListener('submit', function() {
            submitButton.setAttribute('disabled', 'disabled');
            submitButton.innerText = 'Enviando...';
        });
    });
</script>

@endsection