@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Información de clientes</h2>
                    <a href="{{ route('clientes.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>

                <div class="grid grid-cols-2 gap-y-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700"><strong>Nombre:</strong></label>
                        <p class="mt-1">{{ $cliente->nombre}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="correo" class="block text-sm font-medium text-gray-700"><strong>Correo:</strong></label>
                        <p class="mt-1">{{ $cliente->correo}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="telefono" class="block text-sm font-medium text-gray-700"><strong>Telefono:</strong></label>
                        <p class="mt-1">{{ $cliente->telefono}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="direccion" class="block text-sm font-medium text-gray-700"><strong>Dirección:</strong></label>
                        <p class="mt-1">{{ $cliente->direccion}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="rfc" class="block text-sm font-medium text-gray-700"><strong>RFC:</strong></label>
                        <p class="mt-1">{{ $cliente->rfc}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="razon_social" class="block text-sm font-medium text-gray-700"><strong>Razón Social:</strong></label>
                        <p class="mt-1">{{ $cliente->razon_social}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="codigo_postal" class="block text-sm font-medium text-gray-700"><strong>Código Postal:</strong></label>
                        <p class="mt-1">{{ $cliente->codigo_postal}}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="regimen_fiscal" class="block text-sm font-medium text-gray-700"><strong>Regimen Fiscal:</strong></label>
                        <p class="mt-1">{{ $cliente->regimen_fiscal}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection