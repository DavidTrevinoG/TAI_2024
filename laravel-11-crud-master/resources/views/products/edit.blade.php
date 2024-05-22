@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-8">
    <div class="md:w-3/4 mx-auto">

        @session('success')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ $value }}
        </div>
        @endsession

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Edit Product</h2>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>

                <form action="{{ route('products.update', $product->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-4">
                        <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('code') border-red-500 @enderror" id="code" name="code" value="{{ $product->code }}">
                        @error('code')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('name') border-red-500 @enderror" id="name" name="name" value="{{ $product->name }}">
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('quantity') border-red-500 @enderror" id="quantity" name="quantity" value="{{ $product->quantity }}">
                        @error('quantity')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" step="0.01" class="form-input mt-1 block w-full rounded-md border-gray-300 @error('price') border-red-500 @enderror" id="price" name="price" value="{{ $product->price }}">
                        @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 @error('description') border-red-500 @enderror" id="description" name="description">{{ $product->description }}</textarea>
                        @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium  bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection