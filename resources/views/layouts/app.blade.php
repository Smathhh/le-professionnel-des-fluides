@php
    $rawWhatsapp = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp', '212661533025')) ?: '212661533025';
    $displayPhone = \App\Models\Setting::get('phone', '06 61 53 30 25');
    $displayFax = \App\Models\Setting::get('fax', '05 22 76 71 17');
    $displayWhatsapp = \App\Models\Setting::get('whatsapp', '+212661533025');
    $email = \App\Models\Setting::get('email', 'phemindustrie20@gmail.com');
    $address = \App\Models\Setting::get('address', '75 BD 11 Janvier ETG 1 APT 169 Casablanca');
    $siteName = \App\Models\Setting::get('site_name', 'PHEM INDUSTRIE S.A.R.L');
    $capital = \App\Models\Setting::get('capital', '100.000 DH');
    $rc = \App\Models\Setting::get('rc', '379533');
    $if = \App\Models\Setting::get('if', '20794461');
    $patente = \App\Models\Setting::get('patente', '33391116');
    $ice = \App\Models\Setting::get('ice', '001951579000095');
    $cnss = \App\Models\Setting::get('cnss', '5546281');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? $siteName . ' - Maintenance Machines Hydrauliques & Pneumatiques au Maroc' }}</title>
    <meta name="description" content="{{ $siteName }} : Spécialiste au Maroc de la maintenance et réparation de toutes les machines hydrauliques et pneumatiques.">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-icon.svg') }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#090D16">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=JetBrains+Mono:wght@500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f8fa] text-slate-900 antialiased selection:bg-sky-600 selection:text-white">

    <!-- TasteFlow Floating Glassmorphic Navigation -->
    <div class="sticky top-3 z-40 px-3 sm:px-6 lg:px-8 mt-3">
        <nav class="max-w-7xl mx-auto rounded-2xl bg-white/85 backdrop-blur-xl border border-slate-200/80 shadow-[0_8px_30px_rgb(15,23,42,0.06)] transition duration-200">
            <div class="px-4 sm:px-6">
                <div class="flex justify-between items-center h-16 sm:h-[72px]">
                    <!-- Brand Logo -->
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                        <img src="{{ asset('images/logo.svg') }}" alt="{{ $siteName }}" class="h-10 sm:h-11 w-auto transition-transform duration-300 group-hover:scale-[1.03]">
                    </a>

                    <!-- Desktop Navigation Links -->
                    <div class="hidden lg:flex items-center gap-1 bg-slate-100/80 p-1 rounded-xl border border-slate-200/60">
                        <a href="{{ route('home') }}"
                           class="px-3.5 py-2 rounded-lg text-[13px] font-semibold transition {{ request()->routeIs('home') ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                            Accueil
                        </a>
                        <a href="{{ route('services') }}"
                           class="px-3.5 py-2 rounded-lg text-[13px] font-semibold transition {{ request()->routeIs('services') ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                            Services
                        </a>
                        <a href="{{ route('products') }}"
                           class="px-3.5 py-2 rounded-lg text-[13px] font-semibold transition {{ request()->routeIs('products') ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                            Catalogue
                        </a>
                        <a href="{{ route('gallery') }}"
                           class="px-3.5 py-2 rounded-lg text-[13px] font-semibold transition {{ request()->routeIs('gallery') ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                            Réalisations
                        </a>
                        <a href="{{ route('about') }}"
                           class="px-3.5 py-2 rounded-lg text-[13px] font-semibold transition {{ request()->routeIs('about') ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                            À propos
                        </a>
                        <a href="{{ route('contact') }}"
                           class="px-3.5 py-2 rounded-lg text-[13px] font-semibold transition {{ request()->routeIs('contact') ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                            Contact
                        </a>
                    </div>

                    <!-- Call to Action Buttons -->
                    <div class="hidden sm:flex items-center gap-2.5">
                        <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite un devis gratuit pour une intervention.') }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-xs sm:text-sm shadow-sm transition hover:-translate-y-0.5">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            <span>WhatsApp</span>
                        </a>

                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center gap-1.5 bg-[#090d16] hover:bg-sky-600 text-white px-4 py-2.5 rounded-xl font-semibold text-xs sm:text-sm shadow-sm transition hover:-translate-y-0.5">
                            <span>Devis Gratuit</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Mobile menu toggle button -->
                    <div class="lg:hidden flex items-center gap-2">
                        <a href="https://wa.me/{{ $rawWhatsapp }}" target="_blank" class="p-2 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-200/70">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                        <button id="mobile-menu-btn" aria-label="Menu" class="p-2 rounded-xl text-slate-700 hover:text-sky-600 hover:bg-slate-100 transition focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu dropdown -->
            <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-slate-100 rounded-b-2xl">
                <div class="px-4 pt-3 pb-5 space-y-1.5">
                    <a href="{{ route('home') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('home') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-50' }}">Accueil</a>
                    <a href="{{ route('services') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('services') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-50' }}">Services de Maintenance</a>
                    <a href="{{ route('products') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('products') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-50' }}">Catalogue Produits</a>
                    <a href="{{ route('gallery') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('gallery') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-50' }}">Réalisations</a>
                    <a href="{{ route('about') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('about') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-50' }}">À propos</a>
                    <a href="{{ route('contact') }}" class="block px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('contact') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-50' }}">Contact &amp; Devis</a>

                    <div class="pt-3 mt-2 border-t border-slate-100 grid grid-cols-2 gap-2">
                        <a href="https://wa.me/{{ $rawWhatsapp }}" target="_blank" class="flex items-center justify-center gap-1.5 bg-emerald-600 text-white py-2.5 rounded-xl font-bold text-xs">
                            WhatsApp
                        </a>
                        <a href="tel:{{ $rawWhatsapp }}" class="flex items-center justify-center gap-1.5 bg-[#090d16] text-white py-2.5 rounded-xl font-bold text-xs">
                            Appeler
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content Area -->
    <main class="min-h-[calc(100vh-280px)]">
        @yield('content')
    </main>

    <!-- Floating WhatsApp Interactive Widget -->
    <div class="fixed bottom-6 right-6 z-50 flex items-end gap-3 group">
        <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite une information ou un devis.') }}"
           target="_blank"
           class="hidden md:flex items-center gap-3 bg-white/95 backdrop-blur-md text-slate-800 px-4 py-3 rounded-2xl shadow-xl border border-slate-200/80 transition-all duration-300 transform group-hover:-translate-x-1">
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
            <div class="text-left text-xs">
                <p class="font-bold text-slate-900">Assistance WhatsApp 7j/7</p>
                <p class="text-slate-500">Réponse rapide en direct</p>
            </div>
        </a>

        <a href="https://wa.me/{{ $rawWhatsapp }}?text={{ urlencode('Bonjour, je souhaite vous contacter pour un projet de maintenance.') }}"
           target="_blank"
           aria-label="Contacter sur WhatsApp"
           class="relative flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white shadow-2xl whatsapp-pulse transition-all transform hover:scale-105 active:scale-95">
            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
        </a>
    </div>

    <!-- Editorial Footer -->
    <footer class="tf-obsidian text-slate-300 border-t-4 border-[#C81E2B] mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <div>
                    <div class="mb-5">
                        <img src="{{ asset('images/logo-white.svg') }}" alt="{{ $siteName }}" class="h-12 w-auto">
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        {{ \App\Models\Setting::get('about_text', 'Achat, vente et commercialisation des fournitures et équipements industrie hydraulique, pneumatiques, mécanique, tournage fraisage.') }}
                    </p>
                    <div class="inline-flex items-center gap-2 text-xs text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1.5 rounded-full font-medium">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Disponible 24/7 pour urgences
                    </div>
                </div>

                <div>
                    <h3 class="text-rose-400 font-bold mb-5 uppercase tracking-[0.14em] text-[11px]">Navigation</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Nos Services Techniques</a></li>
                        <li><a href="{{ route('products') }}" class="hover:text-white transition">Catalogue Produits</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-white transition">Galerie Avant / Après</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">À Propos</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Demander un Devis</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-rose-400 font-bold mb-5 uppercase tracking-[0.14em] text-[11px]">Domaines d'Expertise</h3>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li>Maintenance Hydraulique Industrielle</li>
                        <li>Maintenance Pneumatique &amp; Air Comprimé</li>
                        <li>Révision de Machines &amp; Vérins</li>
                        <li>Mécanique, Tournage &amp; Fraisage</li>
                        <li>Contrats de Maintenance Préventive</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-rose-400 font-bold mb-5 uppercase tracking-[0.14em] text-[11px]">Contact Direct Maroc</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <span class="block text-xs text-slate-500">GSM / WhatsApp</span>
                            <a href="https://wa.me/{{ $rawWhatsapp }}" target="_blank" class="font-bold text-white hover:text-emerald-400 transition">{{ $displayPhone }}</a>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">Tél / Fax</span>
                            <span class="font-bold text-slate-200">{{ $displayFax }}</span>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">Courriel</span>
                            <a href="mailto:{{ $email }}" class="text-slate-200 hover:text-white transition">{{ $email }}</a>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-500">Adresse</span>
                            <span class="text-slate-300 text-xs">{{ $address }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} {{ $siteName }}. Tous droits réservés.</p>
                <p class="text-[11px] text-slate-500 text-center md:text-right">
                    CAPITAL DE {{ $capital }} • RC : {{ $rc }} • IF : {{ $if }} • PATENTE : {{ $patente }} • ICE : {{ $ice }} • CNSS : {{ $cnss }}
                </p>
            </div>
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
