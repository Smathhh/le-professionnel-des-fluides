@extends('layouts.app')

@php
    $rawWhatsapp = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp', '212666569562')) ?: '212666569562';
    $displayPhone = \App\Models\Setting::get('phone', '+212 666-569562');
    $displayWhatsapp = \App\Models\Setting::get('whatsapp', '+212 666-569562');
    $siteName = \App\Models\Setting::get('site_name', 'LE PROFESSIONNEL DES FLUIDES');
@endphp

@section('content')
<!-- TasteFlow Asymmetric Bento Hero -->
<section class="tf-mesh-light pt-8 pb-16 lg:pt-14 lg:pb-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch">
            <!-- Left Editorial Column (7 cols) -->
            <div class="lg:col-span-7 flex flex-col justify-center text-center lg:text-left">
                <div class="inline-flex items-center gap-2 self-center lg:self-start px-3.5 py-1.5 rounded-full bg-white border border-slate-200/90 shadow-sm text-slate-700 text-xs font-semibold mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Partenaire Technique &amp; Fluides — Maroc</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-[56px] font-extrabold tracking-[-0.03em] leading-[1.06] text-slate-950 mb-6">
                    Maintenance de Machines <span class="text-sky-600">Hydrauliques</span> &amp; Pneumatiques
                </h1>

                <p class="text-base sm:text-lg text-slate-600 mb-8 max-w-2xl leading-relaxed mx-auto lg:mx-0">
                    Diagnostic, réparation et entretien de toutes vos machines hydrauliques et pneumatiques : pompes, vérins, centrales haute pression, compresseurs et distributeurs. Intervention rapide partout au Maroc.
                </p>

                <!-- Action Flow Buttons -->
                <div class="flex flex-col sm:flex-row gap-3.5 justify-center lg:justify-start mb-10">
                    <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite une intervention ou un devis.') }}"
                       target="_blank"
                       class="inline-flex items-center justify-center gap-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm sm:text-base px-7 py-4 rounded-2xl shadow-lg shadow-emerald-600/20 transition transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        <span>WhatsApp Express : {{ $displayWhatsapp }}</span>
                    </a>

                    <a href="{{ route('services') }}"
                       class="inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-900 font-bold text-sm sm:text-base px-7 py-4 rounded-2xl border border-slate-200/90 shadow-sm transition">
                        <span>Découvrir les services</span>
                        <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <!-- 4-Column Metric Bento Strip -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="tf-surface rounded-2xl p-4 text-left">
                        <div class="text-xl sm:text-2xl font-extrabold text-slate-950 font-mono">10+ Ans</div>
                        <div class="text-xs text-slate-500 mt-0.5">Expertise terrain</div>
                    </div>
                    <div class="tf-surface rounded-2xl p-4 text-left">
                        <div class="text-xl sm:text-2xl font-extrabold text-sky-600 font-mono">500+</div>
                        <div class="text-xs text-slate-500 mt-0.5">Chantiers livrés</div>
                    </div>
                    <div class="tf-surface rounded-2xl p-4 text-left">
                        <div class="text-xl sm:text-2xl font-extrabold text-emerald-600 font-mono">24/7</div>
                        <div class="text-xs text-slate-500 mt-0.5">Astreinte urgence</div>
                    </div>
                    <div class="tf-surface rounded-2xl p-4 text-left">
                        <div class="text-xl sm:text-2xl font-extrabold text-slate-950 font-mono">100%</div>
                        <div class="text-xs text-slate-500 mt-0.5">Devis transparent</div>
                    </div>
                </div>
            </div>

            <!-- Right Interactive Flow Panel (5 cols) -->
            <div class="lg:col-span-5 flex">
                <div class="tf-obsidian relative w-full rounded-3xl p-6 sm:p-8 text-white shadow-2xl border border-white/10 overflow-hidden flex flex-col justify-between">
                    <div class="tf-grid-subtle absolute inset-0 opacity-40 pointer-events-none"></div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between pb-5 border-b border-white/10">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                                <span class="text-sm font-bold text-white tracking-tight">Flux d'Assistance Technique</span>
                            </div>
                            <span class="text-[11px] font-mono bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 px-2.5 py-1 rounded-full">
                                EN LIGNE
                            </span>
                        </div>

                        <div class="mt-6 space-y-3.5">
                            <div class="p-4 rounded-2xl bg-white/[0.04] hover:bg-white/[0.07] border border-white/10 transition flex items-start gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/></svg>
                                </div>
                                <div>
                                    <h2 class="text-sm font-bold text-white">Machines Hydrauliques</h2>
                                    <p class="text-xs text-slate-400 mt-0.5">Centrales, pompes haute pression, vérins, distributeurs &amp; flexibles.</p>
                                </div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/[0.04] hover:bg-white/[0.07] border border-white/10 transition flex items-start gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                                </div>
                                <div>
                                    <h2 class="text-sm font-bold text-white">Machines Pneumatiques</h2>
                                    <p class="text-xs text-slate-400 mt-0.5">Compresseurs, vérins pneumatiques, électrovannes &amp; air comprimé.</p>
                                </div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/[0.04] hover:bg-white/[0.07] border border-white/10 transition flex items-start gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <h2 class="text-sm font-bold text-white">Révision &amp; Préventif</h2>
                                    <p class="text-xs text-slate-400 mt-0.5">Contrôle de pression, remplacement de joints &amp; remise à neuf.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 mt-6 pt-5 border-t border-white/10 space-y-2.5">
                        <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, j\'ai une urgence technique.') }}"
                           target="_blank"
                           class="flex items-center justify-center gap-2 w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg transition text-sm">
                            <span>Dépannage Express sur WhatsApp</span>
                        </a>
                        <a href="tel:{{ $rawWhatsapp }}"
                           class="flex items-center justify-center gap-2 w-full bg-white/5 hover:bg-white/10 text-slate-200 font-semibold py-2.5 px-4 rounded-xl border border-white/10 transition text-xs font-mono">
                            <span>Appel direct : {{ $displayPhone }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4 Strengths Bento Strip -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4 mb-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="tf-surface tf-surface-hover rounded-2xl p-6 flex items-start gap-4">
            <div class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-slate-900">Intervention Rapide</h2>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Déploiement immédiat sur Casablanca et zones industrielles.</p>
            </div>
        </div>

        <div class="tf-surface tf-surface-hover rounded-2xl p-6 flex items-start gap-4">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-slate-900">Garantie &amp; Normes</h2>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Conformité aux standards de sécurité industrielle.</p>
            </div>
        </div>

        <div class="tf-surface tf-surface-hover rounded-2xl p-6 flex items-start gap-4">
            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-slate-900">Équipe Habilitée</h2>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Techniciens certifiés pour équipements industriels.</p>
            </div>
        </div>

        <div class="tf-surface tf-surface-hover rounded-2xl p-6 flex items-start gap-4">
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-slate-900">Tarifs Transparents</h2>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Devis clair et détaillé avant chaque intervention.</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
        <div>
            <span class="text-sky-600 font-bold text-[11px] uppercase tracking-[0.16em]">Expertise &amp; Prestations</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-950 mt-2">
                Nos Domaines d'Intervention
            </h2>
        </div>
        <a href="{{ route('services') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-900 hover:text-sky-600 transition">
            <span>Tous nos services</span>
            <span>→</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($services as $service)
        <div class="tf-surface tf-surface-hover rounded-3xl p-7 flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-sky-50 border border-sky-100 text-sky-600 flex items-center justify-center mb-6">
                    @if(str_contains(strtolower($service->icon ?? ''), 'elect') || str_contains(strtolower($service->name), 'lectr'))
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    @elseif(str_contains(strtolower($service->icon ?? ''), 'plumb') || str_contains(strtolower($service->name), 'plomb'))
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/></svg>
                    @elseif(str_contains(strtolower($service->icon ?? ''), 'hvac') || str_contains(strtolower($service->name), 'clim'))
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    @endif
                </div>

                <h3 class="text-lg font-extrabold text-slate-900 mb-2">{{ $service->name }}</h3>

                @if($service->name_ar)
                    <p class="text-xs font-semibold text-slate-400 mb-3" dir="rtl">{{ $service->name_ar }}</p>
                @endif

                <p class="text-sm text-slate-600 leading-relaxed mb-6">
                    {{ Str::limit($service->description, 115) }}
                </p>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite un devis pour : ' . $service->name) }}"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-2 w-full bg-slate-950 hover:bg-emerald-600 text-white py-2.5 px-4 rounded-xl text-xs font-bold transition">
                    <span>Devis via WhatsApp</span>
                    <span>→</span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Products Catalog Showcase -->
<section class="py-20 bg-white border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <span class="text-sky-600 font-bold text-[11px] uppercase tracking-[0.16em]">Matériel &amp; Équipements</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-950 mt-2">
                    Catalogue Produits
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-1">Équipements certifiés disponibles en stock avec livraison et installation.</p>
            </div>
            <a href="{{ route('products') }}" class="inline-flex items-center gap-1.5 text-sky-600 hover:text-sky-700 font-bold text-sm">
                Voir tout le catalogue ({{ count($products) }}+) →
            </a>
        </div>

        <!-- Category Filter Chips -->
        <div class="flex flex-wrap items-center gap-2 mb-8" id="home-product-filters">
            <button class="filter-btn active px-4 py-2 rounded-xl text-xs font-bold bg-slate-950 text-white transition" data-filter="all">
                Tous les produits
            </button>
            <button class="filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition" data-filter="hydraulique">
                Hydraulique
            </button>
            <button class="filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition" data-filter="pneumatique">
                Pneumatique
            </button>
            <button class="filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition" data-filter="pompes">
                Pompes &amp; Vérins
            </button>
            <button class="filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition" data-filter="pieces">
                Pièces &amp; Flexibles
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="products-grid">
            @foreach($products as $product)
            <div class="product-item tf-surface tf-surface-hover rounded-3xl overflow-hidden flex flex-col justify-between"
                 data-cat="{{ strtolower($product->category ?? '') }}">
                <div>
                    <div class="relative aspect-[4/3] bg-slate-100 flex items-center justify-center overflow-hidden border-b border-slate-100">
                        <span class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur-sm text-slate-800 text-[11px] font-bold px-2.5 py-1 rounded-full border border-slate-200 uppercase">
                            {{ $product->category ?? 'Équipement' }}
                        </span>
                        <span class="absolute top-4 right-4 z-10 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                            En stock
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
                                <span class="text-xs font-semibold text-slate-500">Matériel Certifié</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <h3 class="font-extrabold text-slate-900 text-lg line-clamp-1">{{ $product->name }}</h3>
                            <span class="text-[11px] font-mono text-slate-400 shrink-0">PH-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        @if($product->name_ar)
                            <p class="text-xs font-medium text-slate-400 mb-2" dir="rtl">{{ $product->name_ar }}</p>
                        @endif

                        <p class="text-slate-600 text-xs leading-relaxed line-clamp-2 mb-4">
                            {{ $product->description }}
                        </p>

                        @if($product->price)
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-2xl font-extrabold text-slate-950 font-mono">{{ number_format($product->price, 2) }}</span>
                                <span class="text-xs font-bold text-slate-500 uppercase">DH TTC</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="px-6 pb-6 pt-0">
                    <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite commander ou avoir des détails sur : ' . $product->name . ' (' . number_format($product->price, 2) . ' DH)') }}"
                       target="_blank"
                       class="inline-flex items-center justify-center gap-2 w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl transition text-sm">
                        <span>Commander sur WhatsApp</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Gallery Showcase -->
@if($gallery->count() > 0)
<section class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
        <div>
            <span class="text-sky-600 font-bold text-[11px] uppercase tracking-[0.16em]">Qualité Démontrée</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-950 mt-2">
                Nos Dernières Réalisations
            </h2>
        </div>
        <a href="{{ route('gallery') }}" class="inline-flex items-center gap-1.5 text-slate-900 hover:text-sky-600 font-bold text-sm">
            Voir toute la galerie →
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($gallery as $item)
        <div class="tf-surface tf-surface-hover rounded-3xl overflow-hidden">
            <div class="relative aspect-video bg-slate-900 flex items-center justify-center text-white">
                @if($item->after_image && file_exists(public_path('storage/' . $item->after_image)))
                    <img src="{{ asset('storage/' . $item->after_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                @else
                    <svg class="w-10 h-10 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                @endif
                <span class="absolute bottom-3 left-3 text-[11px] font-bold bg-slate-950/80 backdrop-blur-sm px-2.5 py-1 rounded-full text-white border border-white/15">
                    {{ ucfirst($item->category ?? 'Maintenance') }}
                </span>
            </div>
            <div class="p-6">
                <h3 class="font-bold text-slate-900 text-lg mb-2">{{ $item->title }}</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-4">{{ Str::limit($item->description, 100) }}</p>
                <a href="{{ route('gallery') }}" class="text-sky-600 font-bold text-xs inline-flex items-center gap-1 hover:text-sky-700">
                    Voir les détails →
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- Testimonials -->
<section class="tf-obsidian text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-sky-400 font-bold text-[11px] uppercase tracking-[0.16em]">Témoignages Clients</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-2 mb-3">
                La Confiance de nos Partenaires au Maroc
            </h2>
            <p class="text-slate-400 text-sm sm:text-base">
                Industries, syndics et gestionnaires immobiliers témoignent de notre réactivité.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/[0.04] p-7 rounded-3xl border border-white/10">
                <div class="flex text-amber-400 text-sm mb-4">★★★★★</div>
                <p class="text-slate-300 text-sm leading-relaxed mb-6">
                    "Intervention d'urgence sur notre presse hydraulique à Casablanca un dimanche. Fuite de vérin réparée et machine remise en production en moins de 3 heures."
                </p>
                <div class="flex items-center gap-3 border-t border-white/10 pt-4">
                    <div class="w-9 h-9 rounded-full bg-sky-600 text-white font-bold flex items-center justify-center text-xs">KA</div>
                    <div>
                        <div class="font-bold text-white text-sm">Karim A.</div>
                        <div class="text-xs text-slate-400">Directeur Technique, Mohammédia</div>
                    </div>
                </div>
            </div>

            <div class="bg-white/[0.04] p-7 rounded-3xl border border-white/10">
                <div class="flex text-amber-400 text-sm mb-4">★★★★★</div>
                <p class="text-slate-300 text-sm leading-relaxed mb-6">
                    "Révision complète de nos pompes hydrauliques et remplacement des flexibles haute pression. Matériel d'origine et garantie respectée."
                </p>
                <div class="flex items-center gap-3 border-t border-white/10 pt-4">
                    <div class="w-9 h-9 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center text-xs">SB</div>
                    <div>
                        <div class="font-bold text-white text-sm">Samir B.</div>
                        <div class="text-xs text-slate-400">Responsable Production, Ain Sebaa</div>
                    </div>
                </div>
            </div>

            <div class="bg-white/[0.04] p-7 rounded-3xl border border-white/10">
                <div class="flex text-amber-400 text-sm mb-4">★★★★★</div>
                <p class="text-slate-300 text-sm leading-relaxed mb-6">
                    "Contrat de maintenance annuelle pour nos compresseurs et lignes pneumatiques. Zéro arrêt imprévu depuis 2 ans grâce à leur suivi rigoureux."
                </p>
                <div class="flex items-center gap-3 border-t border-white/10 pt-4">
                    <div class="w-9 h-9 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-xs">HE</div>
                    <div>
                        <div class="font-bold text-white text-sm">Hicham E.</div>
                        <div class="text-xs text-slate-400">Responsable Maintenance, Tanger Med</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="max-w-7xl mx-auto px-4 pt-16 sm:px-6 lg:px-8">
    <div class="tf-surface rounded-3xl p-8 sm:p-14 text-center relative overflow-hidden">
        <div class="tf-dots-light absolute inset-0 opacity-60 pointer-events-none"></div>
        <div class="relative z-10 max-w-2xl mx-auto">
            <span class="inline-block bg-sky-50 text-sky-700 border border-sky-200 text-xs font-bold uppercase tracking-wider px-3.5 py-1 rounded-full mb-4">
                Devis Gratuit &amp; Sans Engagement
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 mb-4 tracking-tight">
                Besoin d'un Dépannage ou d'un Projet Fluides ?
            </h2>
            <p class="text-base text-slate-600 mb-8">
                Discutez directement avec nos techniciens sur WhatsApp pour obtenir une estimation immédiate.
            </p>
            <div class="flex flex-col sm:flex-row gap-3.5 justify-center">
                <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite un devis gratuit pour une intervention.') }}"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm sm:text-base px-8 py-4 rounded-2xl shadow-lg shadow-emerald-600/20 transition">
                    <span>Contacter sur WhatsApp ({{ $displayWhatsapp }})</span>
                </a>
                <a href="tel:{{ $rawWhatsapp }}"
                   class="inline-flex items-center justify-center gap-2 bg-[#090d16] hover:bg-slate-800 text-white font-bold text-sm sm:text-base px-8 py-4 rounded-2xl transition">
                    <span>{{ $displayPhone }}</span>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    const filterBtns = document.querySelectorAll('#home-product-filters .filter-btn');
    const productItems = document.querySelectorAll('#products-grid .product-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => {
                b.classList.remove('bg-slate-950', 'text-white');
                b.classList.add('bg-slate-100', 'text-slate-700');
            });
            this.classList.remove('bg-slate-100', 'text-slate-700');
            this.classList.add('bg-slate-950', 'text-white');

            const filter = this.getAttribute('data-filter');
            productItems.forEach(item => {
                const cat = (item.getAttribute('data-cat') || '').toLowerCase();
                item.style.display = (filter === 'all' || cat.includes(filter)) ? 'flex' : 'none';
            });
        });
    });
</script>
@endsection
