@extends('layouts.admin')

@php
    $title = 'Gestion des Services';
@endphp

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-xl font-black text-slate-900">Services Techniques & Prestations</h2>
        <p class="text-xs text-slate-500 mt-1">Gérez la liste des prestations affichées sur le site public.</p>
    </div>
    <a href="{{ route('admin.services.create') }}" 
       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-xl shadow-md shadow-blue-600/20 transition text-sm">
        <span>➕ Ajouter un Service</span>
    </a>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Icône</th>
                    <th class="px-6 py-4">Nom du Service</th>
                    <th class="px-6 py-4">Nom en Arabe</th>
                    <th class="px-6 py-4">Ordre</th>
                    <th class="px-6 py-4">Statut</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($services as $service)
                <tr class="hover:bg-slate-50/80 transition">
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">
                            @if(str_contains(strtolower($service->icon ?? ''), 'elect') || str_contains(strtolower($service->name), 'lectr'))
                                ⚡
                            @elseif(str_contains(strtolower($service->icon ?? ''), 'plumb') || str_contains(strtolower($service->name), 'plomb'))
                                🔧
                            @elseif(str_contains(strtolower($service->icon ?? ''), 'hvac') || str_contains(strtolower($service->name), 'clim'))
                                ❄️
                            @else
                                ⚙️
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900">{{ $service->name }}</div>
                        <div class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $service->description }}</div>
                    </td>
                    <td class="px-6 py-4 text-slate-600" dir="rtl">
                        {{ $service->name_ar ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-xs font-bold text-slate-500">
                        #{{ $service->order }}
                    </td>
                    <td class="px-6 py-4">
                        @if($service->is_active)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                ✓ Actif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600">
                                Inactif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.services.edit', $service->id) }}" 
                           class="inline-block px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 font-bold rounded-lg text-xs transition">
                            ✏️ Modifier
                        </a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}" class="inline-block" onsubmit="return confirm('Confirmer la suppression de ce service ?');">
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
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                        Aucun service enregistré.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

