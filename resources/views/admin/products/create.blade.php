@extends('layouts.admin')

@php
    $title = 'Add Product';
@endphp

@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2 text-lg">Photo *</label>
            <input type="file" name="image" accept="image/*" capture="environment" required
                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 text-lg">
            <p class="text-gray-500 text-sm mt-1">Take a photo or select from gallery</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2 text-lg">Name *</label>
            <input type="text" name="name" required
                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 text-lg"
                   placeholder="Product name">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Name (Arabic)</label>
            <input type="text" name="name_ar" dir="rtl"
                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                   placeholder="اسم المنتج">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2 text-lg">Description *</label>
            <textarea name="description" required rows="3"
                      class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 text-lg"
                      placeholder="Short description"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Description (Arabic)</label>
            <textarea name="description_ar" rows="3" dir="rtl"
                      class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                      placeholder="وصف قصير"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2 text-lg">Price (DH)</label>
            <input type="number" name="price" step="0.01" min="0"
                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 text-lg"
                   placeholder="Optional">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Category</label>
            <input type="text" name="category"
                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                   placeholder="e.g., plumbing, electrical">
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" checked class="mr-2 h-5 w-5">
                <span class="text-gray-700 font-bold text-lg">Active</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 text-white px-8 py-4 rounded-lg hover:bg-green-700 font-bold text-lg flex-1">
                ✓ Save Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-300 text-gray-700 px-8 py-4 rounded-lg hover:bg-gray-400 font-bold text-lg text-center">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
