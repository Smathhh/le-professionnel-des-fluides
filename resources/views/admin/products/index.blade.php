@extends('layouts.admin')

@php
    $title = 'Products';
@endphp

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 inline-block font-semibold text-lg">
        ➕ Add Product
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($products as $product)
            <tr>
                <td class="px-6 py-4">
                    <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                        @if($product->image && $product->image != 'default.jpg')
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover rounded">
                        @else
                            📦
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="font-medium">{{ $product->name }}</div>
                    @if($product->name_ar)
                        <div class="text-sm text-gray-500">{{ $product->name_ar }}</div>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if($product->price)
                        {{ number_format($product->price, 2) }} DH
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 bg-gray-100 rounded text-sm">
                        {{ $product->category ?? 'N/A' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($product->is_active)
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Active</span>
                    @else
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm">Inactive</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $products->links() }}
</div>
@endsection
