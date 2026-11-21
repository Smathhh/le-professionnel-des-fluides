<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administration - {{ $title ?? 'Tableau de bord' }} - LE PROFESSIONNEL DES FLUIDES</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-icon.svg') }}">
    <link rel="manifest" href="/manifest.json">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-slate-900 text-slate-300 flex-shrink-0 flex flex-col justify-between border-r border-slate-800">
            <div>
                <!-- Brand logo -->
                <div class="p-6 border-b border-slate-800">
                    <img src="{{ asset('images/logo-white.svg') }}" alt="LE PROFESSIONNEL DES FLUIDES" class="h-9 w-auto">
                    <p class="text-[10px] text-blue-400 font-bold uppercase tracking-wider mt-2">Panneau d'Administration</p>
                </div>

                <!-- Navigation -->
                <nav class="p-4 space-y-1.5 text-sm font-semibold">
                    <!-- Mobile Uploader Fast Shortcut -->
                    <a href="{{ route('admin.mobile.uploader') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-500 hover:to-emerald-600 text-white font-bold shadow-md shadow-emerald-900/30 transition transform hover:-translate-y-0.5 mb-3">
                        <span class="text-lg">📲</span>
                        <div class="leading-tight">
                            <span>App Mobile Express</span>
                            <span class="block text-[10px] text-emerald-200 font-normal">Ajout rapide de pièces</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <span>📊</span>
                        <span>Tableau de bord</span>
                    </a>

                    <a href="{{ route('admin.products.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <span>📦</span>
                        <span>Gestion Produits</span>
                    </a>

                    <a href="{{ route('admin.services.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.services.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <span>🛠️</span>
                        <span>Gestion Services</span>
                    </a>

                    <a href="{{ route('admin.gallery.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.gallery.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <span>🖼️</span>
                        <span>Galerie / Projets</span>
                    </a>

                    <a href="{{ route('admin.settings') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.settings') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <span>⚙️</span>
                        <span>Paramètres & WhatsApp</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom admin info & logout -->
            <div class="p-4 border-t border-slate-800 space-y-2">
                <a href="{{ route('home') }}" target="_blank" 
                   class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-slate-400 hover:bg-slate-800 hover:text-white transition">
                    <span>🌐</span>
                    <span>Voir le site public</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-red-400 hover:bg-red-950/40 hover:text-red-300 transition text-left">
                        <span>🚪</span>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center shadow-sm">
                <h2 class="text-xl font-extrabold text-slate-900">{{ $title ?? 'Administration' }}</h2>
                <div class="flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <span class="text-xs font-bold text-slate-700">{{ auth()->user()->name ?? 'Administrateur' }}</span>
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-6 md:p-8 flex-1">
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold px-4 py-3 rounded-2xl mb-6 shadow-sm">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 text-sm font-semibold px-4 py-3 rounded-2xl mb-6 shadow-sm">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
