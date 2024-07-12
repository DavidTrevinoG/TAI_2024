@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Editar cotización</h2>
                    <a href="{{ route('cotizaciones.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <form id="cotizacionesForm" action="{{ route('cotizaciones.update', $cotizacione->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="id_clientes" class="block text-sm font-medium text-gray-700">Cliente</label>
                        <select id="id_clientes" name="id_clientes" class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_clientes') border-red-500 @enderror">
                            @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $cliente->id == $cotizacione->cliente_id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_clientes')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="producto_search" class="block text-sm font-medium text-gray-700">Buscar Producto</label>
                        <input type="text" id="producto_search" class="form-input mt-1 block w-full rounded-md border-gray-300" placeholder="Buscar producto" autocomplete="off">
                        <div id="search_results" class="mt-2"></div>
                    </div>

                    <div id="selected_products" class="mb-4">
                        <h3 class="text-xl font-semibold mb-2">Productos Seleccionados</h3>
                        @foreach($cotizacion_productos as $producto)
                        <div class="flex items-center mb-2">
                            <span class="mr-4">{{ $producto->productos->nombre }}</span>
                            <input type="number" name="productos[{{ $producto->productos->id }}][cantidad]" class="form-input mr-4 w-40 rounded-md border-gray-300" value="{{ $producto->cantidad }}" required placeholder="Cantidad">
                            <button type="button" class="py-1 px-2 border border-transparent rounded-md shadow-sm text-sm font-medium bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 remove-product">Eliminar</button>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <label for="vigencia" class="block text-sm font-medium text-gray-700">Vigencia</label>
                        <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('vigencia') border-red-500 @enderror" id="vigencia" name="vigencia" value="{{ $cotizacione->vigencia }}" min="{{ date('Y-m-d') }}">
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
                        <button id="submitButton" type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Actualizar Cotización</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('producto_search');
        const searchResults = document.getElementById('search_results');
        const selectedProductsContainer = document.getElementById('selected_products');

        let selectedProducts = [];

        // Event listener for product search input
        searchInput.addEventListener('input', function() {
            const searchValue = searchInput.value.trim();

            if (searchValue.length > 0) {
                fetch(`/search-productos?search=${searchValue}`)
                    .then(response => response.json())
                    .then(data => {
                        let resultsHtml = '';

                        data.forEach(producto => {
                            resultsHtml += `<div class="p-2 border-b border-gray-200 cursor-pointer" data-id="${producto.id}" data-nombre="${producto.nombre}">${producto.nombre}</div>`;
                        });

                        searchResults.innerHTML = resultsHtml;

                        const resultItems = searchResults.querySelectorAll('.p-2');

                        resultItems.forEach(item => {
                            item.addEventListener('click', function() {
                                const productoId = item.dataset.id;
                                const productoNombre = item.dataset.nombre;

                                const productExists = selectedProducts.find(product => product.id === productoId);

                                if (productExists) {
                                    alert('El producto ya ha sido agregado.');
                                    return;
                                }

                                const productElement = document.createElement('div');
                                productElement.classList.add('flex', 'items-center', 'mb-2');
                                productElement.innerHTML = `<span class="mr-4">${productoNombre}</span>`;

                                const cantidadInput = document.createElement('input');
                                cantidadInput.type = 'number';
                                cantidadInput.name = `productos[${productoId}][cantidad]`;
                                cantidadInput.classList.add('form-input', 'mr-4', 'w-40', 'rounded-md', 'border-gray-300');
                                cantidadInput.required = true;
                                cantidadInput.placeholder = 'Cantidad';

                                const removeButton = document.createElement('button');
                                removeButton.type = 'button';
                                removeButton.innerText = 'Eliminar';
                                removeButton.classList.add('py-1', 'px-2', 'border', 'border-transparent', 'rounded-md', 'shadow-sm', 'text-sm', 'font-medium', 'bg-red-600', 'hover:bg-red-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-red-500');
                                removeButton.addEventListener('click', function() {
                                    productElement.remove();
                                    selectedProducts = selectedProducts.filter(product => product.id !== productoId);
                                });

                                productElement.appendChild(cantidadInput);
                                productElement.appendChild(removeButton);

                                selectedProductsContainer.appendChild(productElement);

                                selectedProducts.push({
                                    id: productoId,
                                    nombre: productoNombre
                                });

                                searchInput.value = '';
                                searchInput.dataset.id = '';
                                searchResults.innerHTML = '';
                            });
                        });
                    });
            } else {
                searchResults.innerHTML = '';
            }
        });

        // Event listener for form submission
        const form = document.getElementById('cotizacionesForm');
        const submitButton = document.getElementById('submitButton');

        form.addEventListener('submit', function() {
            submitButton.setAttribute('disabled', 'disabled');
            submitButton.innerText = 'Actualizando...';
        });
    });
</script>

@endsection