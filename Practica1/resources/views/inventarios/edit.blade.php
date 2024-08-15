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
                    <h2 class="text-2xl font-semibold">Editar Inventario</h2>
                    <a href="{{ route('inventarios.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <form action="{{ route('inventarios.update', $inventario->id) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="mb-4">
                        <label for="id_productos" class="block text-sm font-medium text-gray-700">Producto</label>
                        <select class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_productos') border-red-500 @enderror" id="id_productos" name="id_productos">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $inventario->producto_id == $product->id ? 'selected' : '' }}>{{ $product->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_productos')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="fecha_entrada" class="block text-sm font-medium text-gray-700">Fecha Entrada</label>
                        <input type="date" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('fecha_entrada') border-red-500 @enderror" id="fecha_entrada" name="fecha_entrada" value="{{ $inventario->fecha_entrada }}">
                        @error('fecha_entrada')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="fecha_salida" class="block text-sm font-medium text-gray-700">Fecha Salida</label>
                        <input type="date" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('fecha_salida') border-red-500 @enderror" id="fecha_salida" name="fecha_salida" value="{{ $inventario->fecha_salida }}">
                        @error('fecha_salida')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('motivo') border-red-500 @enderror" id="motivo" name="motivo">{{ $inventario->motivo }}</textarea>
                        @error('motivo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="movimiento" class="block text-sm font-medium text-gray-700">Tipo de Movimiento</label>
                        <select class="form-select mt-1 block w-full rounded-md border-gray-300 @error('movimiento') border-red-500 @enderror" id="movimiento" name="movimiento">
                            <option value="Entrada" {{ $inventario->movimiento == "Entrada" ? 'selected' : '' }}>Entrada</option>
                            <option value="Salida" {{ $inventario->movimiento == 'Salida' ? 'selected' : '' }}>Salida</option>
                        </select>
                        @error('movimiento')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('cantidad') border-red-500 @enderror" id="cantidad" name="cantidad" value="{{ $inventario->cantidad }}">
                        @error('cantidad')
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
<script>
    document.getElementById('inventarioForm').addEventListener('submit', function(event) {
        const fechaEntrada = document.getElementById('fecha_entrada').value;
        const fechaSalida = document.getElementById('fecha_salida').value;

        if (fechaEntrada > fechaSalida) {
            event.preventDefault();
            alert('La fecha de entrada no puede ser posterior a la fecha de salida.');
        }
    });
</script>

@endsection