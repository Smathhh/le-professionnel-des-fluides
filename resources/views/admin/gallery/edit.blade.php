@extends('layouts.admin')

@php
    $title = 'Modifier le Projet de Galerie';
@endphp

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-200">
        <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-xl font-black text-slate-900">Modifier : {{ $gallery->title }}</h2>
            <a href="{{ route('admin.gallery.index') }}" class="text-xs font-bold text-slate-500 hover:text-blue-600">
                ← Retour à la liste
            </a>
        </div>

        <form method="POST" action="{{ route('admin.gallery.update', $gallery->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Photos Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-5 rounded-2xl bg-slate-50 border border-slate-200">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Photo AVANT</label>
                    @if($gallery->before_image && file_exists(public_path('storage/' . $gallery->before_image)))
                        <img src="{{ asset('storage/' . $gallery->before_image) }}" alt="Avant" class="w-full h-32 object-cover rounded-xl mb-3 border">
                    @endif
                    <input type="file" name="before_image" accept="image/*"
                           class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Photo APRÈS (Résultat)</label>
                    @if($gallery->after_image && file_exists(public_path('storage/' . $gallery->after_image)))
                        <img src="{{ asset('storage/' . $gallery->after_image) }}" alt="Après" class="w-full h-32 object-cover rounded-xl mb-3 border">
                    @endif
                    <input type="file" name="after_image" accept="image/*"
                           class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                </div>
            </div>

            <!-- Title -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Titre du Projet (Français) *</label>
                    <input type="text" name="title" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                           value="{{ old('title', $gallery->title) }}">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Titre en Arabe</label>
                    <input type="text" name="title_ar" dir="rtl"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                           value="{{ old('title_ar', $gallery->title_ar) }}">
                </div>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Catégorie</label>
                <input type="text" name="category"
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                       value="{{ old('category', $gallery->category) }}">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Description du Chantier</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">{{ old('description', $gallery->description) }}</textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $gallery->is_active ? 'checked' : '' }} class="w-4 h-4 rounded text-blue-600 border-slate-300">
                <label for="is_active" class="text-sm font-bold text-slate-700">Publié sur la galerie du site</label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.gallery.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-sm transition">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-sm shadow-md shadow-blue-600/20 transition">
                    Mettre à jour le Projet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

