@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Información de Vendedor</h2>
                    <a href="{{ route('vendedores.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <div class="grid grid-cols-2 gap-y-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700"><strong>Nombre:</strong></label>
                        <p class="mt-1">{{ $vendedore->nombre }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700"><strong>Teléfono:</strong></label>
                        <p class="mt-1">{{ $vendedore->telefono }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700"><strong>Correo Electrónico:</strong></label>
                        <p class="mt-1">{{ $vendedore->correo }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection