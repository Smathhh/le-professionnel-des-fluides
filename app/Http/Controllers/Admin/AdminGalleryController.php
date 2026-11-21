<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order')->paginate(10);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'before_image' => 'nullable|mimes:jpeg,jpg,png,webp|max:8192',
            'after_image' => 'required|mimes:jpeg,jpg,png,webp|max:8192',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('before_image')) {
            $validated['before_image'] = $request->file('before_image')->store('gallery', 'public');
        }

        if ($request->hasFile('after_image')) {
            $validated['after_image'] = $request->file('after_image')->store('gallery', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? (Gallery::max('order') + 1);

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Projet ajouté à la galerie.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'before_image' => 'nullable|mimes:jpeg,jpg,png,webp|max:8192',
            'after_image' => 'nullable|mimes:jpeg,jpg,png,webp|max:8192',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('before_image')) {
            if ($gallery->before_image) {
                Storage::disk('public')->delete($gallery->before_image);
            }
            $validated['before_image'] = $request->file('before_image')->store('gallery', 'public');
        }

        if ($request->hasFile('after_image')) {
            if ($gallery->after_image) {
                Storage::disk('public')->delete($gallery->after_image);
            }
            $validated['after_image'] = $request->file('after_image')->store('gallery', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Projet mis à jour avec succès.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->before_image) {
            Storage::disk('public')->delete($gallery->before_image);
        }
        if ($gallery->after_image) {
            Storage::disk('public')->delete($gallery->after_image);
        }
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Projet supprimé.');
    }
}
