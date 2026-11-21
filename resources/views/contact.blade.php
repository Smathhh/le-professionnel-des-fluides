@extends('layouts.app')

@php
    $rawWhatsapp = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp', '212661533025')) ?: '212661533025';
    $displayPhone = \App\Models\Setting::get('phone', '0661533025');
    $displayWhatsapp = \App\Models\Setting::get('whatsapp', '0661533025');
    $email = \App\Models\Setting::get('email', 'phemindustrie20@gmail.com');
    $address = \App\Models\Setting::get('address', 'Casablanca, Maroc');
@endphp

@section('content')
<!-- Architectural Header -->
<div class="tf-mesh-light border-b border-slate-200/80 py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <div class="flex items-center gap-2 text-xs font-bold text-sky-600 uppercase tracking-[0.16em] mb-3">
                <a href="{{ route('home') }}" class="hover:underline">Accueil</a>
                <span>/</span>
                <span>Contact &amp; Devis</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-slate-950 mb-4">
                Contactez-Nous
            </h1>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                Une urgence, une question ou une demande de devis ? Nos techniciens et conseillers sont à votre entière disposition 7j/7.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Left Contact Info Cards (5 cols) -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-emerald-600 text-white p-7 rounded-3xl shadow-xl shadow-emerald-600/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-11 h-11 rounded-2xl bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-extrabold text-lg text-white">WhatsApp Express</h2>
                        <p class="text-xs text-emerald-100">Le canal le plus rapide pour vos devis</p>
                    </div>
                </div>
                <p class="text-sm text-emerald-50 mb-6 leading-relaxed">
                    Envoyez vos photos de panne ou détails de chantier directement sur notre ligne officielle WhatsApp :
                </p>
                <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite un devis ou une intervention.') }}"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-2 w-full bg-white text-emerald-800 hover:bg-emerald-50 font-extrabold py-3.5 px-6 rounded-xl shadow transition text-sm">
                    <span>Ouvrir WhatsApp : {{ $displayWhatsapp }}</span>
                </a>
            </div>

            <div class="tf-surface p-8 rounded-3xl space-y-6">
                <h2 class="text-xl font-bold text-slate-950 border-b border-slate-100 pb-4">Nos Coordonnées</h2>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-slate-500 uppercase">Téléphone Direct</span>
                        <a href="tel:{{ $rawWhatsapp }}" class="text-base font-bold text-slate-950 hover:text-sky-600 transition">{{ $displayPhone }}</a>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-slate-500 uppercase">Courrier Électronique</span>
                        <a href="mailto:{{ $email }}" class="text-base font-bold text-slate-950 hover:text-sky-600 transition">{{ $email }}</a>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-slate-500 uppercase">Adresse</span>
                        <p class="text-sm font-bold text-slate-950">{{ $address }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-slate-500 uppercase">Horaires</span>
                        <p class="text-sm font-bold text-slate-950">Lundi - Samedi : 08:00 - 19:00</p>
                        <span class="block text-xs text-emerald-600 font-bold mt-0.5">Astreinte d'urgence : 24h/24 &amp; 7j/7</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Form (7 cols) -->
        <div class="lg:col-span-7">
            <div class="tf-surface rounded-3xl p-8 sm:p-10">
                <span class="text-sky-600 font-bold text-[11px] uppercase tracking-[0.16em]">Formulaire en ligne</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-950 mt-2 mb-2">
                    Envoyez-nous votre demande
                </h2>
                <p class="text-slate-500 text-sm mb-8">
                    Remplissez ce formulaire et notre équipe technique vous recontactera rapidement.
                </p>

                @if(session('success'))
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-3 mb-6">
                        <span>✓ {{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Votre Nom Complet *</label>
                            <input type="text" name="name" required
                                   class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition"
                                   placeholder="Ex: Mohammed Alami"
                                   value="{{ old('name') }}">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Adresse Email *</label>
                            <input type="email" name="email" required
                                   class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition"
                                   placeholder="alami@entreprise.ma"
                                   value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Numéro de Téléphone *</label>
                            <input type="tel" name="phone" required
                                   class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition"
                                   placeholder="06 XX XX XX XX"
                                   value="{{ old('phone') }}">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Type d'Intervention</label>
                            <select name="service_type" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition">
                                <option value="hydraulique">Maintenance Machine Hydraulique</option>
                                <option value="pneumatique">Maintenance Machine Pneumatique</option>
                                <option value="revision">Révision Pompes / Vérins / Compresseurs</option>
                                <option value="maintenance">Contrat de Maintenance Préventive</option>
                                <option value="produit">Achat de Pièces &amp; Composants</option>
                                <option value="autre">Autre demande</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Détails de votre besoin / Message *</label>
                        <textarea name="message" required rows="5"
                                  class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition"
                                  placeholder="Décrivez votre projet, localisation du chantier et vos contraintes de délais...">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-[#090d16] hover:bg-sky-600 text-white font-extrabold py-4 px-6 rounded-xl shadow-lg transition text-base">
                        Envoyer la demande de devis
                    </button>

                    <div class="text-center pt-1">
                        <span class="text-xs text-slate-500">Vos informations restent strictement confidentielles.</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
