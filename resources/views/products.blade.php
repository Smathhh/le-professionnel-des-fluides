@extends('layouts.app')

@php
    $rawWhatsapp = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp', '212666569562')) ?: '212666569562';
    $displayWhatsapp = \App\Models\Setting::get('whatsapp', '+212 666-569562');
    $siteName = \App\Models\Setting::get('site_name', 'LE PROFESSIONNEL DES FLUIDES');
@endphp

@section('content')
<!-- Architectural Header -->
<div class="tf-mesh-light border-b border-slate-200/80 py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <div class="flex items-center gap-2 text-xs font-bold text-sky-600 uppercase tracking-[0.16em] mb-3">
                <a href="{{ route('home') }}" class="hover:underline">Accueil</a>
                <span>/</span>
                <span>Catalogue Produits</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-slate-950 mb-4">
                Équipements &amp; Matériel Industriel
            </h1>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                Fourniture de matériel et composants certifiés pour machines hydrauliques et pneumatiques : pompes, vérins, distributeurs, flexibles, électrovannes et raccords.
            </p>
        </div>
    </div>
</div>

<!-- Assurance Strip -->
<div class="bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">✓</div>
                <div>
                    <h2 class="text-xs font-bold text-slate-900">Disponibilité Immédiate</h2>
                    <p class="text-[11px] text-slate-500">Stock permanent à Casablanca</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">✓</div>
                <div>
                    <h2 class="text-xs font-bold text-slate-900">Livraison Partout au Maroc</h2>
                    <p class="text-[11px] text-slate-500">Expédition rapide et sécurisée</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">✓</div>
                <div>
                    <h2 class="text-xs font-bold text-slate-900">Garantie Matériel</h2>
                    <p class="text-[11px] text-slate-500">Produits originaux certifiés CE</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">✓</div>
                <div>
                    <h2 class="text-xs font-bold text-slate-900">Installation Disponible</h2>
                    <p class="text-[11px] text-slate-500">Par nos techniciens qualifiés</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Grid -->
<div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-10 pb-6 border-b border-slate-200">
        <div class="text-sm font-semibold text-slate-600">
            Affichage de <span class="font-bold text-slate-950 font-mono">{{ $products->count() }}</span> articles disponibles
        </div>
        <div class="flex items-center gap-2 text-xs">
            <span class="text-slate-500">Commande express :</span>
            <span class="font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                WhatsApp : {{ $displayWhatsapp }}
            </span>
        </div>
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
            <div class="tf-surface tf-surface-hover rounded-3xl overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="relative aspect-[4/3] bg-slate-100 flex items-center justify-center overflow-hidden border-b border-slate-100">
                        <span class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur-sm text-slate-800 text-[11px] font-bold px-3 py-1 rounded-full border border-slate-200 uppercase">
                            {{ $product->category ?? 'Équipement' }}
                        </span>
                        <span class="absolute top-4 right-4 z-10 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                            En Stock
                        </span>

                        @if($product->image && $product->image != 'default.jpg' && file_exists(public_path('storage/' . $product->image)))
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-center p-6">
                                <div class="w-16 h-16 mx-auto rounded-2xl bg-white shadow-sm flex items-center justify-center text-sky-600 mb-2">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-slate-500">{{ $siteName }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <h2 class="text-xl font-extrabold text-slate-950 mb-1">{{ $product->name }}</h2>

                        @if($product->name_ar)
                            <p class="text-xs font-semibold text-slate-400 mb-3" dir="rtl">{{ $product->name_ar }}</p>
                        @endif

                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6">{{ $product->description }}</p>

                        @if($product->description_ar)
                            <p class="text-slate-500 text-xs leading-relaxed mb-4 p-3 bg-slate-50 rounded-xl" dir="rtl">
                                {{ $product->description_ar }}
                            </p>
                        @endif

                        <div class="flex items-baseline justify-between pt-4 border-t border-slate-100">
                            <div>
                                <span class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Prix Professionnel</span>
                                @if($product->price)
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-2xl font-extrabold text-slate-950 font-mono">{{ number_format($product->price, 2) }}</span>
                                        <span class="text-xs font-bold text-slate-500 uppercase">DH TTC</span>
                                    </div>
                                @else
                                    <span class="text-sm font-bold text-slate-700">Sur Devis</span>
                                @endif
                            </div>
                            <span class="text-xs font-mono font-semibold text-slate-400">PH-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>

                <div class="px-6 pb-6 pt-0 flex flex-col sm:flex-row gap-2.5">
                    <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite commander : ' . $product->name . ' (Prix: ' . number_format($product->price, 2) . ' DH)') }}"
                       target="_blank"
                       class="flex-1 inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl transition text-xs sm:text-sm">
                        <span>WhatsApp</span>
                    </a>
                    <a href="{{ route('products.devis', $product) }}"
                       class="flex-1 inline-flex items-center justify-center gap-1.5 bg-[#1E2430] hover:bg-[#C81E2B] text-white font-bold py-3 px-4 rounded-xl transition text-xs sm:text-sm">
                        <span>Générer Devis</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @else
        <div class="tf-surface text-center py-16 rounded-3xl">
            <h3 class="text-lg font-bold text-slate-900 mb-2">Catalogue en cours de mise à jour</h3>
            <p class="text-slate-500 text-sm mb-6">Contactez-nous directement sur WhatsApp pour connaître nos disponibilités.</p>
            <a href="https://wa.me/{{ $rawWhatsapp }}" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 text-white font-bold px-6 py-3 rounded-xl shadow">
                Contacter sur WhatsApp
            </a>
        </div>
    @endif
</div>
@endsection
