@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        @session('success')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ $value }}</span>
        </div>
        @endsession

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-6">Lista de Ventas</h2>

                <a href="{{ route('ventas.create') }}" class="bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded inline-flex items-center mb-4">
                    <i class="bi bi-plus-circle mr-2"></i> Agregar nueva venta
                </a>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Venta</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IVA</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>

                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($ventas as $venta)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $venta->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $venta->products->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $venta->categories->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $venta->cliente->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $venta->cantidad }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $venta->fecha_venta }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $venta->subtotal }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $venta->iva }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $venta->total }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('ventas.destroy', $venta->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('ventas.show', $venta->id) }}" class="bg-yellow-500 hover:bg-yellow-700 font-bold py-1 px-2 rounded"><i class="bi bi-eye"></i> Show</a>
                                    <a href="{{ route('ventas.edit', $venta->id) }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-1 px-2 rounded"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty

                        <tr>
                            <td colspan="6" class="text-center">No sells found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection