@extends('layouts.admin')

@php
    $title = 'Paramètres Généraux & Contact';
@endphp

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-200">
        <div class="mb-8 pb-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-black text-slate-900">Configuration du Site & Ligne WhatsApp</h3>
                <p class="text-xs text-slate-500 mt-1">Modifiez vos numéros de contact, textes de présentation et coordonnées officielles.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold border border-emerald-100">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                WhatsApp Actif
            </span>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
            @csrf

            <!-- Site Name -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nom de l'Entreprise</label>
                <input type="text" name="site_name" required
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                       value="{{ old('site_name', $settings['site_name'] ?? 'Phem Industrie') }}">
            </div>

            <!-- WhatsApp Number (Highlighted) -->
            <div class="p-5 rounded-2xl bg-emerald-50/70 border border-emerald-200">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xl">💬</span>
                    <label class="block text-xs font-black text-emerald-900 uppercase tracking-wider">
                        Numéro WhatsApp Officiel (Boutons flottants, commandes, devis) *
                    </label>
                </div>
                <input type="text" name="whatsapp" required
                       class="w-full px-4 py-3 bg-white border border-emerald-300 rounded-xl text-slate-900 font-bold text-base focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                       placeholder="+212666569562"
                       value="{{ old('whatsapp', $settings['whatsapp'] ?? '+212666569562') }}">
                <p class="text-[11px] text-emerald-700 mt-2">
                    Format international recommandé : <strong>+212666569562</strong>. Les liens directs générés ouvriront la discussion WhatsApp avec ce numéro.
                </p>
            </div>

            <!-- Phone & Email Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Numéro Téléphone d'Appel Direct *</label>
                    <input type="text" name="phone" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                           placeholder="+212 666-569562"
                           value="{{ old('phone', $settings['phone'] ?? '+212 666-569562') }}">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Courrier Électronique (Email) *</label>
                    <input type="email" name="email" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                           placeholder="contact@phemindustrie.ma"
                           value="{{ old('email', $settings['email'] ?? 'contact@phemindustrie.ma') }}">
                </div>
            </div>

            <!-- Address -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Adresse / Ville</label>
                <input type="text" name="address"
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                       placeholder="Casablanca, Maroc"
                       value="{{ old('address', $settings['address'] ?? 'Casablanca, Maroc') }}">
            </div>

            <!-- About Text French -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Texte de Présentation (Français)</label>
                <textarea name="about_text" rows="3"
                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">{{ old('about_text', $settings['about_text'] ?? '') }}</textarea>
            </div>

            <!-- About Text Arabic -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Texte de Présentation (Arabe)</label>
                <textarea name="about_text_ar" rows="3" dir="rtl"
                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">{{ old('about_text_ar', $settings['about_text_ar'] ?? '') }}</textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-600/20 transition text-sm">
                    💾 Enregistrer les Modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

