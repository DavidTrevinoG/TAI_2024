@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-4/4 mx-auto">

        @session('success')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ $value }}</span>
        </div>
        @endsession


        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-6">Inventario</h2>

                <a href="{{ route('inventarios.create') }}" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded inline-flex items-center mb-4">
                    <i class="bi bi-plus-circle mr-2"></i> Agregar nuevo inventario
                </a>

                <a href="{{ route('inventarios.pdf.all') }}" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded inline-flex items-center mb-4">
                    <i class="bi bi-plus-circle mr-2"></i> Reportes
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
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha_Entrada</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha_Salida</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Movimiento</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motivo</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($inventarios as $inven)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $inven->id }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $inven->producto->nombre }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $inven->fecha_entrada }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $inven->fecha_salida }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $inven->movimiento }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $inven->motivo }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $inven->cantidad }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <form id="deleteForm" action="{{ route('inventarios.destroy', $inven->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('inventarios.show', $inven->id) }}" class="bg-yellow-500 hover:bg-yellow-700 font-bold py-1 px-2 rounded"><i class="bi bi-eye"></i>Mostrar</a>
                                        <a href="{{ route('inventarios.edit', $inven->id) }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-1 px-2 rounded"><i class="bi bi-pencil-square"></i>Editar</a>
                                        <button id="deleteButton" type="submit" class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded"><i class="bi bi-trash"></i>Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty

                            <tr>
                                <td colspan="6" class="text-center">No hay Inventarios.</td>
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