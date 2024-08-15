@extends('layouts.app')

@section('content')

<style>
    .image-container {
        width: 100px;
        /* Ajusta el tamaño del contenedor según sea necesario */
        height: 100px;
        /* Ajusta el tamaño del contenedor según sea necesario */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .img-responsive {
        width: 100%;
        height: auto;
        object-fit: cover;
        /* Mantiene la relación de aspecto y cubre el contenedor sin deformar la imagen */
    }
</style>


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
                            <th scope="col" class="px-5 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                            <th scope="col" class="px-5 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                            <th scope="col" class="px-5 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                            <th scope="col" class="px-5 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Unitario</th>
                            <th scope="col" class="px-5 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IVA</th>
                            <th scope="col" class="px-5 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                            <th scope="col" class="px-5 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th scope="col" class="px-5 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items" class="bg-white divide-y divide-gray-200">
                        @foreach($venta->venta_productos as $producto)
                        <tr>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="image-container">
                                    <img src="{{ asset('storage')."/".$producto->productos->image}}" alt="{{$producto->productos->image}}" class="img-responsive rounded">
                                </div>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">{{ $producto->productos->nombre }}</td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <input type="number" name="productos[{{ $producto->productos->id }}][cantidad]" class="form-input w-16" value="{{ $producto->cantidad }}" min="1" max="{{ $producto->productos->existencia()}}" data-precio="{{ $producto->productos->precio_venta }}">
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">${{ $producto->productos->precio_venta }}</td>
                            <input type="hidden" value="{{ $producto->productos->existencia()}}">
                            <td class="px-5 py-4 whitespace-nowrap iva">${{ number_format($producto->cantidad * $producto->productos->precio_venta - ($producto->cantidad * $producto->productos->precio_venta)/1.16, 2, '.', '') }}</td>
                            <td class="px-5 py-4 whitespace-nowrap subtotal">${{ number_format(($producto->cantidad * $producto->productos->precio_venta)/1.16, 2, '.', '') }}</td>
                            <td class="px-5 py-4 whitespace-nowrap total">${{ number_format($producto->cantidad * $producto->productos->precio_venta, 2, '.', '') }}</td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <button type="button" class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded eliminar">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-between items-center mt-5">
                    <span class="text-lg font-semibold">IVA: $<span id="iva-amount">{{number_format($venta->total - $venta->total/1.16, 2, '.', '')}}</span></span>
                </div>
                <div class="flex justify-between items-center mt-5">
                    <span class="text-lg font-semibold">Subtotal: $<span id="subtotal-amount">{{ number_format($venta->total/1.16, 2, '.', '')}}</span></span>
                </div>
                <div class="flex justify-between items-center mt-5">
                    <span class="text-lg font-semibold">Total: $<span id="total-amount">{{ number_format($venta->total, 2, '.', '') }}</span></span>
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
        const subtotalAmountElement = document.getElementById('subtotal-amount');
        const ivaAmountElement = document.getElementById('iva-amount');
        const form = document.getElementById('ventasForm');
        const submitSaleButton = document.getElementById('submit-sale');
        const cambioInput = document.getElementById('cambio');
        const totalInput = document.getElementById('total');
        let selectedProducts = [];

        // Función para recalcular IVA, Subtotal y Total
        function recalculateTotals() {
            let subtotal = 0;
            let total = 0;
            let iva = 0;

            const rows = cartItems.querySelectorAll('tr');
            rows.forEach(row => {


                if (row.querySelector('input[type="number"]').value < 0) {
                    row.querySelector('input[type="number"]').value = 1;
                }


                if (row.querySelector('input[type="number"]').value > parseInt(row.querySelector('input[type="hidden"]').value)) {
                    row.querySelector('input[type="number"]').value = parseInt(row.querySelector('input[type="hidden"]').value);
                }

                if (row.querySelector('input[type="number"]').value == 0) {
                    row.querySelector('input[type="number"]').value = 1;
                }

                const cantidad = parseFloat(row.querySelector('input[type="number"]').value);

                const precioUnitario = parseFloat(row.querySelector('td:nth-child(4)').textContent.replace('$', ''));
                const subtotalProducto = (cantidad * precioUnitario) / 1.16;
                const ivaProducto = cantidad * precioUnitario - subtotalProducto;
                const totalProducto = cantidad * precioUnitario;

                row.querySelector('.subtotal').textContent = `$${subtotalProducto.toFixed(2)}`;
                row.querySelector('.iva').textContent = `$${ivaProducto.toFixed(2)}`;
                row.querySelector('.total').textContent = `$${totalProducto.toFixed(2)}`;

                subtotal += subtotalProducto;
                iva += ivaProducto;
                total += totalProducto;
            });

            subtotalAmountElement.textContent = subtotal.toFixed(2);
            ivaAmountElement.textContent = iva.toFixed(2);
            totalAmountElement.textContent = total.toFixed(2);
            totalInput.value = total.toFixed(2);
        }

        // Escuchar cambios en las cantidades para recalcular los totales
        cartItems.addEventListener('input', function(e) {
            if (e.target.type === 'number') {
                recalculateTotals();
            }
        });

        // Función para eliminar un producto del carrito
        function eliminarProducto(e) {
            const row = e.target.closest('tr');
            const productId = row.querySelector('input[type="number"]').name.match(/\d+/)[0]; // Extraer el ID del producto

            // Eliminar el producto de selectedProducts
            selectedProducts = selectedProducts.filter(id => id !== parseInt(productId));

            // Eliminar la fila de la tabla
            row.remove();

            // Recalcular los totales
            recalculateTotals();
        }

        // Escuchar clics en el botón de eliminar
        cartItems.addEventListener('click', function(e) {
            if (e.target.classList.contains('eliminar')) {
                eliminarProducto(e);
            }
        });


        searchInput.addEventListener('input', function() {
            const searchValue = searchInput.value.trim();

            if (searchValue.length > 0) {
                fetch(`/search-productos?search=${searchValue}`)
                    .then(response => response.json())
                    .then(data => {
                        let resultsHtml = '';

                        data.forEach(producto => {
                            var nombre = producto.nombre;

                            if (parseInt(producto.existencia) == 0) {
                                nombre = nombre + "&nbsp;&nbsp;  <span style='color: red;'>(Fuera de Existencia)</span>";
                            }
                            resultsHtml += `
                                <div class="p-2 border-b border-gray-200 cursor-pointer flex items-center" data-id="${producto.id}" data-nombre="${producto.nombre}" data-precio="${producto.precio_venta}" data-existencia="${producto.existencia}">
                                     <div class="image-container">
                                        <img src="{{ asset('storage') }}/${producto.image}" alt="${producto.nombre}"  class="img-responsive rounded">
                                    </div>
                                        <span>${nombre}</span>
                                </div>
                            `;
                        });

                        searchResults.innerHTML = resultsHtml;

                        const resultItems = searchResults.querySelectorAll('.p-2');

                        resultItems.forEach(item => {
                            item.addEventListener('click', function() {
                                const existencia = item.dataset.existencia;
                                const productoId = item.dataset.id;
                                const productoNombre = item.dataset.nombre;
                                const productoPrecio = parseFloat(item.dataset.precio);
                                const productoImage = item.querySelector('img').src;

                                const productExists = selectedProducts.find(product => product.id === productoId);

                                if (productExists) {
                                    alert('El producto ya ha sido agregado.');
                                    return;
                                }

                                selectedProducts.push({
                                    id: productoId,
                                    nombre: productoNombre,
                                    precio: productoPrecio
                                });

                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="image-container">  
                                            <img src="${productoImage}" alt="${productoNombre}"  class="img-responsive rounded">
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">${productoNombre}</td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <input type="number" name="productos[${productoId}][cantidad]" class="form-input w-16" value="1" min="1" max="${existencia}" data-precio="${productoPrecio}" >
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">$${productoPrecio.toFixed(2)}</td>
                                    <td class="px-5 py-4 whitespace-nowrap iva">$${(productoPrecio - productoPrecio / 1.16).toFixed(2)}</td>
                                    <td class="px-5 py-4 whitespace-nowrap subtotal">$${(productoPrecio / 1.16).toFixed(2)}</td>
                                    <td class="px-5 py-4 whitespace-nowrap total">$${productoPrecio.toFixed(2)}</td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <button type="button" class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded eliminar">Eliminar</button>
                                    </td>
                                `;

                                cartItems.appendChild(tr);

                                recalculateTotals(); // Recalcular los totales después de agregar un nuevo producto

                                tr.querySelector('.eliminar').addEventListener('click', function() {
                                    tr.remove();
                                    recalculateTotals(); // Recalcular los totales después de eliminar un producto
                                });

                            });
                        });
                    });
            } else {
                searchResults.innerHTML = '';
            }
        });

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