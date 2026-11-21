<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('order')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_ar' => 'nullable|string',
            'image' => 'required|mimes:jpeg,jpg,png,webp|max:8192',
            'price' => 'nullable|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);
        \App\Services\NoSqlStore::save('products', $product->toArray());

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,jpg,png,webp|max:8192',
            'price' => 'nullable|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        \App\Services\NoSqlStore::save('products', $product->fresh()->toArray());

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        \App\Services\NoSqlStore::delete('products', $product->id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
