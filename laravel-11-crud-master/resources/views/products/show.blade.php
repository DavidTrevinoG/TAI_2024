@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Product Information</h2>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>

                <div class="grid grid-cols-2 gap-y-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="code" class="block text-sm font-medium text-gray-700"><strong>Code:</strong></label>
                        <p class="mt-1">{{ $product->code }}</p>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700"><strong>Name:</strong></label>
                        <p class="mt-1">{{ $product->name }}</p>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="quantity" class="block text-sm font-medium text-gray-700"><strong>Quantity:</strong></label>
                        <p class="mt-1">{{ $product->quantity }}</p>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block text-sm font-medium text-gray-700"><strong>Price:</strong></label>
                        <p class="mt-1">{{ $product->price }}</p>
                    </div>

                    <div class="col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700"><strong>Description:</strong></label>
                        <p class="mt-1">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection