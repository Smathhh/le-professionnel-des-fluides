@extends('layouts.app')

@php
    $rawWhatsapp = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp', '212661533025')) ?: '212661533025';
@endphp

@section('content')
<!-- Architectural Header -->
<div class="tf-mesh-light border-b border-slate-200/80 py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <div class="flex items-center gap-2 text-xs font-bold text-sky-600 uppercase tracking-[0.16em] mb-3">
                <a href="{{ route('home') }}" class="hover:underline">Accueil</a>
                <span>/</span>
                <span>Réalisations</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-slate-950 mb-4">
                Galerie de nos Réalisations
            </h1>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                Découvrez en images la rigueur de nos interventions et les transformations Avant / Après réalisées pour nos clients à Casablanca et partout au Maroc.
            </p>
        </div>
    </div>
</div>

<!-- Gallery Grid -->
<div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
    @if($galleries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($galleries as $item)
            <div class="tf-surface tf-surface-hover rounded-3xl overflow-hidden flex flex-col justify-between">
                <div>
                    @if($item->before_image && $item->after_image && file_exists(public_path('storage/' . $item->before_image)) && file_exists(public_path('storage/' . $item->after_image)))
                        <div class="relative grid grid-cols-2 aspect-video bg-slate-900">
                            <div class="relative h-full overflow-hidden border-r border-white/20">
                                <img src="{{ asset('storage/' . $item->before_image) }}" alt="Avant" class="w-full h-full object-cover">
                                <span class="absolute top-2 left-2 bg-red-600/90 text-white text-[10px] font-bold px-2 py-0.5 rounded">AVANT</span>
                            </div>
                            <div class="relative h-full overflow-hidden">
                                <img src="{{ asset('storage/' . $item->after_image) }}" alt="Après" class="w-full h-full object-cover">
                                <span class="absolute top-2 right-2 bg-emerald-600/90 text-white text-[10px] font-bold px-2 py-0.5 rounded">APRÈS</span>
                            </div>
                        </div>
                    @else
                        <div class="relative aspect-video tf-obsidian flex items-center justify-center p-6 text-white overflow-hidden">
                            <svg class="w-10 h-10 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="absolute top-3 left-3 bg-sky-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                                {{ $item->category ?? 'Maintenance' }}
                            </span>
                            <span class="absolute bottom-3 right-3 bg-white/10 backdrop-blur-sm text-slate-200 text-[11px] px-2.5 py-0.5 rounded-full border border-white/15">
                                Chantier Maroc
                            </span>
                        </div>
                    @endif

                    <div class="p-6">
                        <h2 class="text-xl font-bold text-slate-950 mb-2">{{ $item->title }}</h2>

                        @if($item->title_ar)
                            <p class="text-xs font-semibold text-slate-400 mb-3" dir="rtl">{{ $item->title_ar }}</p>
                        @endif

                        @if($item->description)
                            <p class="text-slate-600 text-sm leading-relaxed mb-4">{{ $item->description }}</p>
                        @endif

                        @if($item->description_ar)
                            <p class="text-slate-500 text-xs leading-relaxed mb-4 bg-slate-50 p-3 rounded-xl border border-slate-100" dir="rtl">
                                {{ $item->description_ar }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="px-6 pb-6 pt-0">
                    <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite des informations sur le projet : ' . $item->title) }}"
                       target="_blank"
                       class="inline-flex items-center justify-center gap-2 w-full bg-slate-950 hover:bg-emerald-600 text-white font-bold py-3 px-4 rounded-xl transition text-xs">
                        <span>Demander un travail similaire sur WhatsApp</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
    @else
        <div class="tf-surface text-center py-16 rounded-3xl">
            <h3 class="text-lg font-bold text-slate-900 mb-2">Galerie en cours de mise à jour</h3>
            <p class="text-slate-500 text-sm mb-6">Demandez directement nos références de chantiers récents sur WhatsApp.</p>
            <a href="https://wa.me/{{ $rawWhatsapp }}" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 text-white font-bold px-6 py-3 rounded-xl shadow">
                Consulter les réalisations via WhatsApp
            </a>
        </div>
    @endif
</div>
@endsection
