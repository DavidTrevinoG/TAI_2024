@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Agregar una nueva compra</h2>
                    <a href="{{ route('compras.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <form id="comprasForm" action="{{ route('compras.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="id_proveedores" class="block text-sm font-medium text-gray-700">Proveedor</label>
                        <select id="id_proveedores" name="id_proveedores" class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_proveedores') border-red-500 @enderror">
                            @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_proveedores')
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
                        <label for="id_formapagos" class="block text-sm font-medium text-gray-700">Forma de Pago</label>
                        <select id="id_forma_pago" name="id_forma_pago" class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_forma_pago') border-red-500 @enderror">
                            @foreach($formapago as $fp)
                            <option value="{{ $fp->id }}">{{ $fp->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_formapagos')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="fecha_compra" class="block text-sm font-medium text-gray-700">Fecha de Compra</label>
                        <input type="date" id="fecha_compra" name="fecha_compra" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('fecha_compra') border-red-500 @enderror">
                        @error('fecha_compra')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('cantidad') border-red-500 @enderror">
                        @error('cantidad')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                        <input type="number" id="precio" name="precio" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('precio') border-red-500 @enderror">
                        @error('precio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="descuento" class="block text-sm font-medium text-gray-700">Descuento</label>
                        <input type="number" id="descuento" name="descuento" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('descuento') border-red-500 @enderror">
                        @error('descuento')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                        <input type="number" id="total" name="total" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('total') border-red-500 @enderror">
                        @error('total')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button id="submitButton" type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Agregar Compra</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('comprasForm');
        const submitButton = document.getElementById('submitButton');

        form.addEventListener('submit', function() {
            submitButton.setAttribute('disabled', 'disabled');
            submitButton.innerText = 'Enviando...';
        });
    });
</script>

@endsection