@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex md:w-4/4 mx-auto bg-white p-6 rounded-lg shadow-md">

        <div class="w-2/3 mr-4">
            <h2 class="text-2xl font-semibold mb-6">Vender</h2>
            <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a><br><br>


            <div></div>

            <form id="ventasForm" action="{{ route('ventas.store') }}" method="post">
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
                    <label for="id_vendedores" class="block text-sm font-medium text-gray-700">Vendedor</label>
                    <select id="id_vendedores" name="id_vendedores" class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_vendedores') border-red-500 @enderror">
                        @foreach($vendedores as $vendedor)
                        <option value="{{ $vendedor->id }}">{{ $vendedor->nombre }}</option>
                        @endforeach
                    </select>
                    @error('id_vendedores')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="id_formapagos" class="block text-sm font-medium text-gray-700">Forma de Pago</label>
                    <select id="id_formapagos" name="id_formapagos" class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_formapagos') border-red-500 @enderror">
                        @foreach($forma_pago as $formapago)
                        <option value="{{ $formapago->id }}">{{ $formapago->nombre }}</option>
                        @endforeach
                    </select>
                    @error('id_formapagos')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>



                <table class="min-w-full divide-y divide-gray-200">

                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items" class="bg-white divide-y divide-gray-200">
                        <div id="selected_products" class="mb-4">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Sabritas</td>
                                <td class="px-6 py-4 whitespace-nowrap">2</td>
                                <td class="px-6 py-4 whitespace-nowrap">$10.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">$20.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded">Eliminar</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Coca Cola</td>
                                <td class="px-6 py-4 whitespace-nowrap">1</td>
                                <td class="px-6 py-4 whitespace-nowrap">$15.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">$15.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded">Eliminar</button>
                                </td>
                            </tr>
                        </div>

                    </tbody>
                </table>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-lg font-semibold">Total: $<span id="total-amount">35.00</span></span>
                    <button id="submit-sale" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded">Vender</button>
                </div>

        </div>

        <div class="w-1/3 bg-gray-100 p-4 rounded-lg shadow-inner">
            <div class="mb-4">
                <label for="producto_search" class="block text-sm font-medium text-gray-700">Buscar Producto</label>
                <input type="text" id="producto_search" class="form-input mt-1 block w-full rounded-md border-gray-300" placeholder="Buscar producto" autocomplete="off">
                <div id="search_results" class="mt-2"></div>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('producto_search');
        const searchResults = document.getElementById('search_results');
        const selectedProductsContainer = document.getElementById('selected_products');

        let selectedProducts = [];

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
                                const cantidadInput = document.createElement('input');
                                const removeButton = document.createElement('button');

                                const productExists = selectedProducts.find(product => product.id === productoId);

                                if (productExists) {
                                    alert('El producto ya ha sido agregado.');
                                    return;
                                }

                                const productElement = document.createElement('div');
                                productElement.classList.add('flex', 'items-center', 'mb-2');
                                productElement.innerHTML = `<span class="mr-4">${productoNombre}</span>`;

                                cantidadInput.type = 'number';
                                cantidadInput.name = `productos[${productoId}][cantidad]`;
                                cantidadInput.classList.add('form-input', 'mr-4', 'w-40', 'rounded-md', 'border-gray-300');
                                cantidadInput.required = true;
                                cantidadInput.placeholder = 'Cantidad';

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

        const form = document.getElementById('ventasForm');
        const submitButton = document.getElementById('submitButton');

        form.addEventListener('submit', function() {
            submitButton.setAttribute('disabled', 'disabled');
            submitButton.innerText = 'Enviando...';
        });
    });
</script>

<style>
    .form-input,
    .form-select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .bg-green-500:hover {
        background-color: #38a169;
    }

    .bg-red-500:hover {
        background-color: #e53e3e;
    }
</style>

@endsection