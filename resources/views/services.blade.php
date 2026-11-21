@extends('layouts.app')

@php
    $rawWhatsapp = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp', '212666569562')) ?: '212666569562';
    $displayWhatsapp = \App\Models\Setting::get('whatsapp', '+212 666-569562');
@endphp

@section('content')
<!-- Architectural Page Header -->
<div class="tf-mesh-light border-b border-slate-200/80 py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <div class="flex items-center gap-2 text-xs font-bold text-sky-600 uppercase tracking-[0.16em] mb-3">
                <a href="{{ route('home') }}" class="hover:underline">Accueil</a>
                <span>/</span>
                <span>Services Techniques</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-slate-950 mb-4">
                Nos Services de Maintenance
            </h1>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                Des solutions techniques fiables pour le secteur industriel, tertiaire et résidentiel partout au Maroc. Intervention rapide et respect strict des normes de sécurité.
            </p>
        </div>
    </div>
</div>

<!-- Main Services Listing -->
<div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($services as $service)
        <div class="tf-surface tf-surface-hover rounded-3xl p-8 flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-sky-50 border border-sky-100 text-sky-600 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full border border-emerald-200">
                        Intervention 7j/7
                    </span>
                </div>

                <h2 class="text-2xl font-extrabold text-slate-950 mb-2">{{ $service->name }}</h2>

                @if($service->name_ar)
                    <p class="text-sm font-bold text-slate-400 mb-4" dir="rtl">{{ $service->name_ar }}</p>
                @endif

                <p class="text-slate-600 text-sm leading-relaxed mb-6">{{ $service->description }}</p>

                @if($service->description_ar)
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 bg-slate-50 p-4 rounded-2xl border border-slate-100" dir="rtl">
                        {{ $service->description_ar }}
                    </p>
                @endif

                <div class="space-y-2.5 mb-8">
                    <div class="flex items-center gap-2.5 text-xs font-semibold text-slate-700">
                        <span class="w-5 h-5 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">✓</span>
                        <span>Diagnostic technique complet &amp; rapport d'intervention</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-xs font-semibold text-slate-700">
                        <span class="w-5 h-5 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">✓</span>
                        <span>Pièces de rechange certifiées et garanties</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-xs font-semibold text-slate-700">
                        <span class="w-5 h-5 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">✓</span>
                        <span>Assistance d'urgence disponible sous 1 heure</span>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row gap-3">
                <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite commander ou avoir un devis pour le service : ' . $service->name) }}"
                   target="_blank"
                   class="flex-1 inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-6 rounded-xl transition text-sm">
                    <span>Demander sur WhatsApp</span>
                </a>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-900 font-bold py-3.5 px-5 rounded-xl transition text-sm">
                    Devis en ligne
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Process Workflow Section -->
<div class="bg-white py-20 border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-sky-600 font-bold text-[11px] uppercase tracking-[0.16em]">Méthodologie</span>
            <h2 class="text-3xl font-extrabold text-slate-950 mt-2 mb-3">
                Comment se déroule notre intervention ?
            </h2>
            <p class="text-slate-600 text-sm sm:text-base">
                Un processus éprouvé garantissant rapidité, maîtrise du budget et haute qualité d'exécution.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="tf-surface p-6 rounded-2xl text-center">
                <div class="w-11 h-11 mx-auto rounded-full bg-slate-950 text-white font-mono font-bold text-base flex items-center justify-center mb-4">01</div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Prise de contact</h3>
                <p class="text-slate-500 text-xs leading-relaxed">Vous nous contactez sur WhatsApp ou par téléphone avec votre besoin.</p>
            </div>
            <div class="tf-surface p-6 rounded-2xl text-center">
                <div class="w-11 h-11 mx-auto rounded-full bg-sky-600 text-white font-mono font-bold text-base flex items-center justify-center mb-4">02</div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Diagnostic &amp; Devis</h3>
                <p class="text-slate-500 text-xs leading-relaxed">Évaluation technique sur site ou à distance et devis transparent.</p>
            </div>
            <div class="tf-surface p-6 rounded-2xl text-center">
                <div class="w-11 h-11 mx-auto rounded-full bg-slate-950 text-white font-mono font-bold text-base flex items-center justify-center mb-4">03</div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Intervention Qualifiée</h3>
                <p class="text-slate-500 text-xs leading-relaxed">Travaux réalisés avec pièces certifiées et outillage professionnel.</p>
            </div>
            <div class="tf-surface p-6 rounded-2xl text-center">
                <div class="w-11 h-11 mx-auto rounded-full bg-emerald-600 text-white font-mono font-bold text-base flex items-center justify-center mb-4">04</div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Contrôle &amp; Garantie</h3>
                <p class="text-slate-500 text-xs leading-relaxed">Vérification des performances et garantie pièce &amp; main d'œuvre.</p>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="max-w-4xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-extrabold text-slate-950 mb-3">Questions Fréquentes</h2>
        <p class="text-slate-600 text-sm">Tout ce que vous devez savoir avant de faire appel à nos services</p>
    </div>

    <div class="space-y-4">
        <div class="tf-surface p-6 rounded-2xl">
            <h3 class="font-bold text-slate-900 text-base mb-2">Dans quelles villes du Maroc intervenez-vous ?</h3>
            <p class="text-slate-600 text-sm leading-relaxed">
                Notre base principale est à Casablanca, mais nous intervenons régulièrement à Mohammédia, Rabat, Tanger, Kénitra, Marrakech et sur les zones industrielles de tout le Maroc.
            </p>
        </div>
        <div class="tf-surface p-6 rounded-2xl">
            <h3 class="font-bold text-slate-900 text-base mb-2">Le devis est-il gratuit ?</h3>
            <p class="text-slate-600 text-sm leading-relaxed">
                Oui, nos devis d'intervention et estimations de projets sont 100% gratuits et sans aucun engagement. Envoyez-nous simplement les photos ou détails sur WhatsApp.
            </p>
        </div>
        <div class="tf-surface p-6 rounded-2xl">
            <h3 class="font-bold text-slate-900 text-base mb-2">Proposez-vous des contrats de maintenance annuelle ?</h3>
            <p class="text-slate-600 text-sm leading-relaxed">
                Absolument. Nous proposons des contrats personnalisés pour usines, centres commerciaux, sièges sociaux et immeubles avec visites préventives mensuelles.
            </p>
        </div>
    </div>

    <div class="mt-12 text-center p-8 tf-surface rounded-3xl">
        <h3 class="text-xl font-bold text-slate-950 mb-2">Vous avez une question spécifique ?</h3>
        <p class="text-slate-600 text-sm mb-6">Notre équipe technique est disponible immédiatement sur WhatsApp.</p>
        <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, j\'ai une question technique.') }}"
           target="_blank"
           class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-3.5 rounded-xl shadow transition text-sm">
            <span>Discuter avec un technicien ({{ $displayWhatsapp }})</span>
        </a>
    </div>
</div>
@endsection
