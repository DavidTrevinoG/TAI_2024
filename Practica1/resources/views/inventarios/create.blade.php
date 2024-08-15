@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Agregar un Inventario</h2>
                    <a href="{{ route('inventarios.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>
                <form action="{{ route('inventarios.store') }}" method="post">
                    @csrf

                    <div class="mb-4">
                        <label for="id_producto" class="block text-sm font-medium text-gray-700">Producto</label>
                        <select class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_productos') border-red-500 @enderror" id="id_productos" name="id_productos">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('id_productos') == $product->id ? 'selected' : '' }}>{{ $product->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_productos')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="movimiento" class="block text-sm font-medium text-gray-700">Tipo de Movimiento</label>
                        <select class="form-select mt-1 block w-full rounded-md border-gray-300 @error('movimiento') border-red-500 @enderror" id="movimiento" name="movimiento">
                            <option value="Entrada" {{ old('movimiento') == 'Entrada' ? 'selected' : '' }}>Entrada</option>
                            <option value="Salida" {{ old('movimiento') == 'Salida' ? 'selected' : '' }}>Salida</option>
                        </select>
                        @error('movimiento')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4" id="fechaEntradaDiv">
                        <label for="fecha_entrada" class="block text-sm font-medium text-gray-700">Fecha Entrada</label>
                        <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('fecha_entrada') border-red-500 @enderror" id="fecha_entrada" name="fecha_entrada" value="{{ old('fecha_entrada') }}">
                        @error('fecha_entrada')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4" id="fechaSalidaDiv">
                        <label for="fecha_salida" class="block text-sm font-medium text-gray-700">Fecha Salida</label>
                        <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('fecha_salida') border-red-500 @enderror" id="fecha_salida" name="fecha_salida" value="{{ old('fecha_salida') }}">
                        @error('fecha_salida')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('motivo') border-red-500 @enderror" id="motivo" name="motivo">{{ old('motivo') }}</textarea>
                        @error('motivo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('cantidad') border-red-500 @enderror" id="cantidad" name="cantidad">{{ old('cantidad') }}</>
                        @error('cantidad')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Agregar Inventario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const movimientoSelect = document.getElementById('movimiento');
        const fechaEntradaDiv = document.getElementById('fechaEntradaDiv');
        const fechaSalidaDiv = document.getElementById('fechaSalidaDiv');

        function toggleFechaFields() {
            const movimiento = movimientoSelect.value;

            if (movimiento === 'Entrada') {
                fechaEntradaDiv.style.display = 'block';
                fechaSalidaDiv.style.display = 'none';
            } else if (movimiento === 'Salida') {
                fechaEntradaDiv.style.display = 'none';
                fechaSalidaDiv.style.display = 'block';
            } else {
                fechaEntradaDiv.style.display = 'none';
                fechaSalidaDiv.style.display = 'none';
            }
        }

        movimientoSelect.addEventListener('change', toggleFechaFields);

        // Llamar a la función al cargar la página para establecer el estado inicial
        toggleFechaFields();
    });
</script>

@endsection