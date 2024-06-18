@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex md:w-4/4 mx-auto bg-white p-6 rounded-lg shadow-md">

        <div class="w-2/3 mr-4">
            <h2 class="text-2xl font-semibold mb-6">Ventas</h2>

            <div class="flex mb-4">
                <select id="customer" class="form-select rounded-md shadow-sm mt-1 block w-full">
                    <option value="walk-in"></option>
                    <option value="walk-in">Cliente Certificado</option>
                </select>
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
                </tbody>
            </table>

            <div class="flex justify-between items-center mt-4">
                <span class="text-lg font-semibold">Total: $<span id="total-amount">35.00</span></span>
                <button id="submit-sale" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded">Vender</button>
            </div>
        </div>

        <div class="w-1/3 bg-gray-100 p-4 rounded-lg shadow-inner">
            <div class="relative">
                <input type="text" id="product-search" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Buscar un producto...">
                <div id="search-results" class="absolute bg-white border border-gray-300 rounded-lg mt-1 w-full max-h-60 overflow-auto shadow-lg z-10 hidden">

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('product-search').addEventListener('input', function() {
        let query = this.value.toLowerCase();
        let searchResults = document.getElementById('search-results');

        if (query.length > 0) {
            searchResults.innerHTML = '';
            let products = ['Sabritas', 'Coca Cola', 'Pepsi', 'Doritos', 'Fanta'];
            let filteredProducts = products.filter(product => product.toLowerCase().includes(query));

            filteredProducts.forEach(product => {
                let item = document.createElement('div');
                item.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-200');
                item.textContent = product;
                searchResults.appendChild(item);

                item.addEventListener('click', function() {
                    document.getElementById('product-search').value = product;
                    searchResults.classList.add('hidden');
                });
            });

            searchResults.classList.remove('hidden');
        } else {
            searchResults.classList.add('hidden');
        }
    });

    document.addEventListener('click', function(event) {
        let searchResults = document.getElementById('search-results');
        if (!document.getElementById('product-search').contains(event.target)) {
            searchResults.classList.add('hidden');
        }
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