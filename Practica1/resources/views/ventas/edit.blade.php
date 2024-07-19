@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex md:w-4/4 mx-auto bg-white p-6 rounded-lg shadow-md">

        <div class="w-2/3 mr-4">
            <h2 class="text-2xl font-semibold mb-6">Editar Venta</h2>
            <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a><br><br>

            <div></div>

            <form id="ventasForm" action="{{ route('ventas.update', $venta->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" id="cambio" name="cambio" value="0.00">
                <input type="hidden" id="total" name="total" value="{{ $venta->total }}">
                <div class="mb-4">
                    <label for="id_clientes" class="block text-sm font-medium text-gray-700">Cliente</label>
                    <select id="id_clientes" name="id_clientes" class="form-select mt-1 block w-full rounded-md border-gray-300 @error('id_clientes') border-red-500 @enderror">
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $venta->id_clientes == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
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
                        <option value="{{ $vendedor->id }}" {{ $venta->id_vendedores == $vendedor->id ? 'selected' : '' }}>{{ $vendedor->nombre }}</option>
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
                        <option value="{{ $formapago->id }}" {{ $venta->id_formapagos == $formapago->id ? 'selected' : '' }}>{{ $formapago->nombre }}</option>
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
                        @foreach($venta->venta_productos as $producto)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $producto->productos->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="number" name="productos[{{ $producto->productos->id }}][cantidad]" class="form-input w-16" value="{{ $producto->cantidad }}" min="1" data-precio="{{ $producto->productos->precio_venta }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">${{ $producto->productos->precio_venta }}</td>
                            <td class="px-6 py-4 whitespace-nowrap subtotal">${{ $producto->cantidad * $producto->productos->precio_venta }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button type="button" class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded eliminar">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-lg font-semibold">Total: $<span id="total-amount">{{ $venta->total }}</span></span>
                    <button id="submit-sale" type="button" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded">Actualizar Venta</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('producto_search');
        const searchResults = document.getElementById('search_results');
        const cartItems = document.getElementById('cart-items');
        const totalAmountElement = document.getElementById('total-amount');
        const form = document.getElementById('ventasForm');
        const submitSaleButton = document.getElementById('submit-sale');
        const cambioInput = document.getElementById('cambio');
        const totalInput = document.getElementById('total');
        let selectedProducts = [];

        searchInput.addEventListener('input', function() {
            const searchValue = searchInput.value.trim();

            if (searchValue.length > 0) {
                fetch(`/search-productos?search=${searchValue}`)
                    .then(response => response.json())
                    .then(data => {
                        let resultsHtml = '';

                        data.forEach(producto => {
                            resultsHtml += `<div class="p-2 border-b border-gray-200 cursor-pointer" data-id="${producto.id}" data-nombre="${producto.nombre}" data-precio="${producto.precio_venta}">${producto.nombre}</div>`;
                        });

                        searchResults.innerHTML = resultsHtml;

                        const resultItems = searchResults.querySelectorAll('.p-2');

                        resultItems.forEach(item => {
                            item.addEventListener('click', function() {
                                const productoId = item.dataset.id;
                                const productoNombre = item.dataset.nombre;
                                const productoPrecio = parseFloat(item.dataset.precio);

                                const productExists = selectedProducts.find(product => product.id === productoId);

                                if (productExists) {
                                    alert('El producto ya ha sido agregado.');
                                    return;
                                }

                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                    <td class="px-6 py-4 whitespace-nowrap">${productoNombre}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="number" name="productos[${productoId}][cantidad]" class="form-input w-16" value="1" min="1" data-precio="${productoPrecio}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">$${productoPrecio.toFixed(2)}</td>
                                    <td class="px-6 py-4 whitespace-nowrap subtotal">$${productoPrecio.toFixed(2)}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button type="button" class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded eliminar">Eliminar</button>
                                    </td>
                                `;

                                cartItems.appendChild(tr);

                                selectedProducts.push({
                                    id: productoId,
                                    nombre: productoNombre,
                                    precio: productoPrecio
                                });

                                updateTotal();

                                searchResults.innerHTML = '';
                                searchInput.value = '';

                                const quantityInputs = tr.querySelectorAll('input[type="number"]');
                                const eliminarButton = tr.querySelector('.eliminar');

                                quantityInputs.forEach(input => {
                                    input.addEventListener('input', function() {
                                        const quantity = parseInt(input.value);
                                        const price = parseFloat(input.dataset.precio);
                                        const subtotal = quantity * price;

                                        tr.querySelector('.subtotal').innerText = `$${subtotal.toFixed(2)}`;
                                        updateTotal();
                                    });
                                });

                                eliminarButton.addEventListener('click', function() {
                                    tr.remove();
                                    selectedProducts = selectedProducts.filter(product => product.id !== productoId);
                                    updateTotal();
                                });
                            });
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                searchResults.innerHTML = '';
            }
        });

        function updateTotal() {
            let total = 0;

            const quantityInputs = cartItems.querySelectorAll('input[type="number"]');

            quantityInputs.forEach(input => {
                const quantity = parseInt(input.value);
                const price = parseFloat(input.dataset.precio);
                total += quantity * price;
            });

            totalAmountElement.innerText = total.toFixed(2);
            totalInput.value = total.toFixed(2);
        }

        cartItems.addEventListener('input', function(event) {
            if (event.target.tagName === 'INPUT' && event.target.type === 'number') {
                const quantity = parseInt(event.target.value);
                const price = parseFloat(event.target.dataset.precio);
                const subtotal = quantity * price;

                const tr = event.target.closest('tr');
                tr.querySelector('.subtotal').innerText = `$${subtotal.toFixed(2)}`;

                updateTotal();
            }
        });

        submitSaleButton.addEventListener('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas actualizar esta venta?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualizar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection