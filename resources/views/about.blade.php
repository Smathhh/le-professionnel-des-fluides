@extends('layouts.app')

@php
    $rawWhatsapp = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp', '212666569562')) ?: '212666569562';
    $displayPhone = \App\Models\Setting::get('phone', '+212 666-569562');
    $displayWhatsapp = \App\Models\Setting::get('whatsapp', '+212 666-569562');
    $email = \App\Models\Setting::get('email', 'contact@phemindustrie.ma');
    $address = \App\Models\Setting::get('address', 'Casablanca, Maroc');
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
                <span>À Propos</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-slate-950 mb-4">
                À Propos de Nous
            </h1>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                Votre partenaire technique de référence au Maroc pour la maintenance, la réparation et la révision de toutes les machines hydrauliques et pneumatiques.
            </p>
        </div>
    </div>
</div>

<!-- Main About Content -->
<div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20">
        <div class="lg:col-span-7">
            <span class="text-sky-600 font-bold text-[11px] uppercase tracking-[0.16em]">Notre Histoire &amp; Mission</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 mt-3 mb-6 leading-tight tracking-tight">
                Une Expertise Reconnue au Service de l'Industrie Marocaine
            </h2>

            <p class="text-slate-700 text-base leading-relaxed mb-4">
                {{ \App\Models\Setting::get('about_text', 'Spécialisés dans les travaux de maintenance préventive et corrective, l\'installation d\'équipements haute performance et l\'assistance technique d\'urgence au Maroc.') }}
            </p>

            @if(\App\Models\Setting::get('about_text_ar'))
                <div class="bg-white border border-slate-200 p-5 rounded-2xl mb-6 text-slate-700 text-base leading-relaxed font-semibold" dir="rtl">
                    {{ \App\Models\Setting::get('about_text_ar') }}
                </div>
            @endif

            <p class="text-slate-600 text-sm leading-relaxed mb-8">
                Basés à Casablanca, nous intervenons avec réactivité auprès des usines et entreprises industrielles pour garantir la continuité, la pression optimale et la fiabilité de toutes leurs machines hydrauliques et pneumatiques.
            </p>

            <div class="grid grid-cols-2 gap-6 pt-6 border-t border-slate-200">
                <div>
                    <h3 class="font-extrabold text-2xl text-sky-600 mb-1 font-mono">100% Conforme</h3>
                    <p class="text-xs text-slate-500">Normes de sécurité et conformité réglementaire marocaine.</p>
                </div>
                <div>
                    <h3 class="font-extrabold text-2xl text-emerald-600 mb-1 font-mono">24/7 Disponible</h3>
                    <p class="text-xs text-slate-500">Service d'astreinte permanente pour dépannages critiques.</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="tf-obsidian relative rounded-3xl p-8 text-white shadow-2xl border border-white/10">
                <div class="inline-block bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[11px] font-bold px-3 py-1 rounded-full mb-4">
                    Assistance Directe
                </div>
                <h3 class="text-2xl font-extrabold mb-3">{{ $siteName }}</h3>
                <p class="text-slate-300 text-sm leading-relaxed mb-6">
                    Pour toute étude technique, devis d'appel d'offres ou intervention sur site, notre direction technique est à votre écoute immédiate.
                </p>

                <div class="space-y-3.5 pt-4 border-t border-white/10 text-sm">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-emerald-400 font-semibold">WhatsApp</span>
                        <a href="https://wa.me/{{ $rawWhatsapp }}" target="_blank" class="text-white hover:text-emerald-400 font-bold">{{ $displayWhatsapp }}</a>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-sky-400 font-semibold">Téléphone</span>
                        <a href="tel:{{ $rawWhatsapp }}" class="text-white hover:text-sky-400 font-bold">{{ $displayPhone }}</a>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-sky-400 font-semibold">Courriel</span>
                        <span class="text-slate-300">{{ $email }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-sky-400 font-semibold">Adresse</span>
                        <span class="text-slate-300 text-right">{{ $address }}</span>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite vous contacter.') }}"
                       target="_blank"
                       class="flex items-center justify-center gap-2 w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg transition text-sm">
                        <span>Contacter sur WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 3 Values -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="tf-surface tf-surface-hover rounded-3xl p-8">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mb-6">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-xl font-extrabold text-slate-950 mb-2">Excellence Technique</h3>
            <p class="text-slate-600 text-sm leading-relaxed">
                Des interventions précises, des diagnostics rigoureux et l'utilisation exclusive de matériaux et pièces d'origine certifiés.
            </p>
        </div>

        <div class="tf-surface tf-surface-hover rounded-3xl p-8">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-6">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h3 class="text-xl font-extrabold text-slate-950 mb-2">Réactivité &amp; Disponibilité</h3>
            <p class="text-slate-600 text-sm leading-relaxed">
                Parce qu'une panne peut paralyser toute votre activité, nous nous engageons sur des délais de déplacement d'urgence imbattables.
            </p>
        </div>

        <div class="tf-surface tf-surface-hover rounded-3xl p-8">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="text-xl font-extrabold text-slate-950 mb-2">Partenariat Durable</h3>
            <p class="text-slate-600 text-sm leading-relaxed">
                Des contrats clairs, un suivi préventif régulier et des conseils personnalisés pour optimiser la longévité de vos installations.
            </p>
        </div>
    </div>
</div>
@endsection
