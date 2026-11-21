@extends('layouts.admin')

@php
    $title = 'Gestion de la Galerie';
@endphp

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-xl font-black text-slate-900">Galerie de Réalisations & Projets</h2>
        <p class="text-xs text-slate-500 mt-1">Gérez vos chantiers avec photos Avant / Après.</p>
    </div>
    <a href="{{ route('admin.gallery.create') }}" 
       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-xl shadow-md shadow-blue-600/20 transition text-sm">
        <span>➕ Ajouter un Projet</span>
    </a>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Aperçu</th>
                    <th class="px-6 py-4">Titre du Projet</th>
                    <th class="px-6 py-4">Catégorie</th>
                    <th class="px-6 py-4">Statut</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($galleries as $item)
                <tr class="hover:bg-slate-50/80 transition">
                    <td class="px-6 py-4">
                        <div class="w-16 h-12 rounded-xl bg-slate-800 flex items-center justify-center text-white overflow-hidden">
                            @if($item->after_image && $item->after_image !== 'default_after.jpg' && file_exists(public_path('storage/' . $item->after_image)))
                                <img src="{{ asset('storage/' . $item->after_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xl">📸</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900">{{ $item->title }}</div>
                        <div class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $item->description }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-xs font-semibold">
                            {{ $item->category ?? 'Maintenance' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($item->is_active)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                ✓ Publié
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600">
                                Masqué
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.gallery.edit', $item->id) }}" 
                           class="inline-block px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 font-bold rounded-lg text-xs transition">
                            ✏️ Modifier
                        </a>
                        <form method="POST" action="{{ route('admin.gallery.destroy', $item->id) }}" class="inline-block" onsubmit="return confirm('Supprimer ce projet ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-lg text-xs transition">
                                🗑️ Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                        Aucun projet dans la galerie pour le moment.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($galleries->hasPages())
        <div class="p-6 border-t border-slate-100">
            {{ $galleries->links() }}
        </div>
    @endif
</div>
@endsection

