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
    <div class="md:w-4/4 mx-auto">

        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            {{ session('error') }}
            <br>
        </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-6">Lista de Productos</h2>

                <a href="{{ route('products.create') }}" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded inline-flex items-center mb-4">
                    <i class="bi bi-plus-circle mr-2"></i> Agregar un Producto
                </a>

                <a href="{{ route('products.pdf.all') }}" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded inline-flex items-center mb-4">
                    <i class="bi bi-plus-circle mr-2"></i> Reporte
                </a>

                <a href="{{ route('products.pdf.stock') }}" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded inline-flex items-center mb-4">
                    <i class="bi bi-plus-circle mr-2"></i> Reporte Stock
                </a>

                <div class="mb-4">
                    <input
                        type="text"
                        id="searchInput"
                        onkeyup="filterTable()"
                        placeholder="Buscar en la tabla..."
                        class="px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div class="overflow-x-auto">


                    <table id="Table" class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Venta</th>
                                <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Compra</th>
                                <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Compra</th>
                                <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color</th>
                                <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                                <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Existencia</th>
                                <th scope="col" class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($products as $product)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $product->id }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $product->nombre }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $product->category->nombre }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $product->precio_venta }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $product->precio_compra }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $product->fecha_compra }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $product->color }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($product->image)
                                    <div class="image-container">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nombre }}" class="img-responsive rounded">
                                    </div>
                                    @else
                                    <span>No Imagen</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $product->existencia() }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <form id="deleteForm" action="{{ route('products.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('products.show', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-700 font-bold py-1 px-2 rounded"><i class="bi bi-eye"></i>Mostrar</a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-1 px-2 rounded"><i class="bi bi-pencil-square"></i>Editar</a>
                                        <button id="deleteButton" type="submit" class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded"><i class="bi bi-trash"></i>Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">No hay productos.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function filterTable() {
        // Get the input value and convert to lowercase
        const filter = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#Table tbody tr');

        rows.forEach(row => {
            // Get all the text content of the cells in the current row
            const cells = row.querySelectorAll('td');
            let found = false;

            cells.forEach(cell => {
                if (cell.textContent.toLowerCase().includes(filter)) {
                    found = true;
                }
            });

            // Show or hide the row based on whether it matches the filter
            row.style.display = found ? '' : 'none';
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('deleteForm');
        const submitButton = document.getElementById('deleteButton');

        form.addEventListener('submit', function() {
            submitButton.setAttribute('disabled', 'disabled');
            submitButton.innerText = 'Eliminando...';
        });
    });
</script>

@endsection