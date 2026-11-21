@extends('layouts.admin')

@php
    $title = 'Modifier le Service';
@endphp

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-200">
        <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-xl font-black text-slate-900">Modifier : {{ $service->name }}</h2>
            <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-500 hover:text-blue-600">
                ← Retour à la liste
            </a>
        </div>

        <form method="POST" action="{{ route('admin.services.update', $service->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nom du Service (Français) *</label>
                    <input type="text" name="name" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                           value="{{ old('name', $service->name) }}">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nom du Service (Arabe)</label>
                    <input type="text" name="name_ar" dir="rtl"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                           value="{{ old('name_ar', $service->name_ar) }}">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Description Détaillée (Français) *</label>
                <textarea name="description" rows="3" required
                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">{{ old('description', $service->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Description en Arabe</label>
                <textarea name="description_ar" rows="3" dir="rtl"
                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">{{ old('description_ar', $service->description_ar) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Type d'icône</label>
                    <select name="icon" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                        <option value="electricity" {{ $service->icon == 'electricity' ? 'selected' : '' }}>⚡ Électricité</option>
                        <option value="plumbing" {{ $service->icon == 'plumbing' ? 'selected' : '' }}>🔧 Plomberie & Fluides</option>
                        <option value="hvac" {{ $service->icon == 'hvac' ? 'selected' : '' }}>❄️ Climatisation & Froid</option>
                        <option value="mechanical" {{ $service->icon == 'mechanical' ? 'selected' : '' }}>⚙️ Mécanique & Pompes</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Ordre d'affichage</label>
                    <input type="number" name="order" value="{{ old('order', $service->order) }}"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $service->is_active ? 'checked' : '' }} class="w-4 h-4 rounded text-blue-600 border-slate-300">
                <label for="is_active" class="text-sm font-bold text-slate-700">Activer et afficher ce service sur le site public</label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.services.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-sm transition">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-sm shadow-md shadow-blue-600/20 transition">
                    Mettre à jour le Service
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

