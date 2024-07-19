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
                <input type="hidden" id="cambio" name="cambio" value="0.00">
                <input type="hidden" id="total" name="total" value="0.00">
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
                        <!-- Aquí se añadirán los productos seleccionados -->
                    </tbody>
                </table>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-lg font-semibold">Total: $<span id="total-amount">0.00</span></span>
                    <button id="submit-sale" type="button" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded">Vender</button>
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
                                    precio: productoPrecio,
                                    cantidad: 1
                                });

                                updateTotal();

                                const cantidadInput = tr.querySelector('input');
                                const eliminarButton = tr.querySelector('.eliminar');

                                cantidadInput.addEventListener('input', function() {
                                    const cantidad = parseInt(cantidadInput.value);
                                    const subtotalElement = tr.querySelector('.subtotal');
                                    const subtotal = cantidad * productoPrecio;

                                    subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
                                    updateTotal();
                                });

                                eliminarButton.addEventListener('click', function() {
                                    tr.remove();
                                    selectedProducts = selectedProducts.filter(product => product.id !== productoId);
                                    updateTotal();
                                });

                                searchInput.value = '';
                                searchResults.innerHTML = '';
                            });
                        });
                    });
            } else {
                searchResults.innerHTML = '';
            }
        });

        function updateTotal() {
            let total = 0;
            selectedProducts.forEach(product => {
                const cantidadInput = document.querySelector(`input[name="productos[${product.id}][cantidad]"]`);
                const cantidad = parseInt(cantidadInput.value);
                total += product.precio * cantidad;
            });

            totalAmountElement.textContent = total.toFixed(2);
        }

        submitSaleButton.addEventListener('click', function() {
            const formaPagoSelect = document.getElementById('id_formapagos');
            const formaPago = formaPagoSelect.options[formaPagoSelect.selectedIndex].text.toLowerCase();
            const totalAmount = parseFloat(totalAmountElement.textContent);
            totalInput.value = totalAmount.toFixed(2);

            if (formaPago === 'efectivo') {
                Swal.fire({
                    title: 'Ingresar dinero recibido',
                    input: 'number',
                    inputAttributes: {
                        min: 0,
                        step: 0.01
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Vender',
                    cancelButtonText: 'Cancelar',
                    inputValidator: (value) => {
                        if (!value || parseFloat(value) < totalAmount) {
                            return `El monto ingresado debe ser mayor o igual al total: $${totalAmount.toFixed(2)}`;
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const dineroIngresado = parseFloat(result.value);
                        const cambio = dineroIngresado - totalAmount;
                        cambioInput.value = cambio.toFixed(2);

                        Swal.fire({
                            title: 'Cambio',
                            text: `El cambio es: $${cambio.toFixed(2)}`,
                            icon: 'success'
                        }).then(() => {
                            Swal.fire({
                                title: 'Venta realizada',
                                text: 'La venta se ha realizado con éxito.',
                                icon: 'success'
                            }).then(() => {
                                form.submit();
                            });

                        });
                    }
                });

            } else {
                cambioInput.value = '0.00';
                Swal.fire({
                    title: 'Confirmar venta',
                    text: 'Por favor, confirme que ha realizado el pago con tarjeta u otro método.',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    Swal.fire({
                        title: 'Venta realizada',
                        text: 'La venta se ha realizado con éxito.',
                        icon: 'success'
                    }).then(() => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });

            }

        });
    });
</script>

@endsection