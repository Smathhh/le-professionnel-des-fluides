<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <title>Phem Mobile Admin - Ajout Pièce Express</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-icon.svg') }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0F172A">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-900 text-slate-100 min-h-full pb-28 font-sans selection:bg-blue-600 selection:text-white">

    <!-- Top Native Mobile Header -->
    <header class="sticky top-0 z-40 bg-slate-950/90 backdrop-blur-md border-b border-slate-800 px-4 py-3.5 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-blue-600/20 border border-blue-500/40 p-2 flex items-center justify-center">
                <img src="{{ asset('images/logo-icon.svg') }}" alt="Logo" class="w-full h-full">
            </div>
            <div>
                <span class="text-sm font-black tracking-tight text-white block">PHEM EXPRESS</span>
                <span class="text-[10px] font-bold text-emerald-400 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    App Mobile Connectée
                </span>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" target="_blank" class="text-[11px] font-bold bg-slate-800 hover:bg-slate-700 text-slate-300 px-3 py-1.5 rounded-xl border border-slate-700">
                Site Public ↗
            </a>
            <a href="{{ route('admin.dashboard') }}" class="text-[11px] font-bold bg-blue-600/30 text-blue-400 px-3 py-1.5 rounded-xl border border-blue-500/30">
                Admin
            </a>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-md mx-auto px-4 pt-5 space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs font-bold flex items-center gap-3 shadow-lg">
                <span class="text-xl">✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-2xl bg-red-500/20 border border-red-500/40 text-red-300 text-xs font-bold shadow-lg">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card: Add New Piece Form -->
        <div class="bg-slate-950 rounded-3xl p-6 border border-slate-800 shadow-2xl">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-lg font-black text-white">Ajouter une Pièce / Matériel</h2>
                    <p class="text-xs text-slate-400">Prenez la photo et publiez en 30 secondes</p>
                </div>
                <span class="w-8 h-8 rounded-full bg-blue-600/20 text-blue-400 flex items-center justify-center font-bold text-sm">
                    📸
                </span>
            </div>

            <form method="POST" action="{{ route('admin.mobile.store') }}" enctype="multipart/form-data" id="upload-form" class="space-y-5">
                @csrf

                <!-- Big Camera Shutter Trigger -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        Photo de la pièce / équipement *
                    </label>

                    <div id="drop-zone" class="relative group cursor-pointer border-2 border-dashed border-slate-700 hover:border-blue-500 rounded-3xl bg-slate-900/60 p-6 text-center transition-all overflow-hidden">
                        <!-- Hidden Camera Input -->
                        <input type="file" name="image" id="camera-input" accept="image/*" capture="environment" required class="absolute inset-0 opacity-0 cursor-pointer z-20">

                        <!-- Empty State -->
                        <div id="camera-prompt" class="space-y-3">
                            <div class="w-16 h-16 mx-auto rounded-3xl bg-blue-600 text-white flex items-center justify-center shadow-xl shadow-blue-600/30 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-white">Appuyez pour prendre la photo</p>
                                <p class="text-xs text-slate-400 mt-0.5">Ouvre l'appareil photo ou la galerie</p>
                            </div>
                        </div>

                        <!-- Live Photo Preview Container -->
                        <div id="preview-container" class="hidden relative">
                            <img id="image-preview" src="#" alt="Aperçu" class="w-full max-h-64 object-cover rounded-2xl mx-auto shadow-lg">
                            <div class="mt-3 flex items-center justify-center gap-2">
                                <span class="text-xs bg-emerald-500/20 text-emerald-300 px-3 py-1 rounded-full font-bold">
                                    ✓ Photo prête
                                </span>
                                <span class="text-xs text-blue-400 font-semibold underline">Changer la photo</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Piece Name -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        Nom de la pièce / Matériel *
                    </label>
                    <input type="text" name="name" id="name-input" required
                           class="w-full px-4 py-3.5 bg-slate-900 border border-slate-800 rounded-2xl text-white text-base font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                           placeholder="Ex: Pompe Immergée 2CV, Disjoncteur 63A...">
                </div>

                <!-- Quick Category Selector Chips -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        Catégorie *
                    </label>
                    <input type="hidden" name="category" id="selected-category" value="electricite">

                    <div class="grid grid-cols-2 gap-2 text-xs font-bold" id="cat-chips">
                        <button type="button" data-cat="Électricité" class="cat-chip active p-3 rounded-xl bg-blue-600 text-white border border-blue-500 text-left transition">
                            ⚡ Électricité
                        </button>
                        <button type="button" data-cat="Plomberie" class="cat-chip p-3 rounded-xl bg-slate-900 text-slate-300 border border-slate-800 text-left transition">
                            🔧 Plomberie
                        </button>
                        <button type="button" data-cat="Climatisation" class="cat-chip p-3 rounded-xl bg-slate-900 text-slate-300 border border-slate-800 text-left transition">
                            ❄️ Climatisation
                        </button>
                        <button type="button" data-cat="Pompes & Moteurs" class="cat-chip p-3 rounded-xl bg-slate-900 text-slate-300 border border-slate-800 text-left transition">
                            ⚙️ Moteurs & Pompes
                        </button>
                        <button type="button" data-cat="Tuyauterie" class="cat-chip p-3 rounded-xl bg-slate-900 text-slate-300 border border-slate-800 text-left transition">
                            🚰 Tuyauterie Inox
                        </button>
                        <button type="button" data-cat="Outillage Pro" class="cat-chip p-3 rounded-xl bg-slate-900 text-slate-300 border border-slate-800 text-left transition">
                            🛠️ Outillage
                        </button>
                    </div>
                </div>

                <!-- Price (DH) -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        Prix en Dirhams (DH) (Optionnel)
                    </label>
                    <div class="relative">
                        <input type="number" step="0.01" min="0" name="price"
                               class="w-full pl-4 pr-16 py-3.5 bg-slate-900 border border-slate-800 rounded-2xl text-white text-base font-bold focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                               placeholder="Ex: 1450.00">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-black text-blue-400 uppercase">
                            DH TTC
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        Description / Référence rapide
                    </label>
                    <textarea name="description" rows="2"
                              class="w-full px-4 py-3 bg-slate-900 border border-slate-800 rounded-2xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                              placeholder="Spécifications techniques, état de la pièce, marque..."></textarea>
                </div>

                <!-- Big Action Button -->
                <button type="submit" id="submit-btn"
                        class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-white font-black py-4 px-6 rounded-2xl shadow-xl shadow-emerald-500/30 transition text-base uppercase tracking-wider active:scale-95 flex items-center justify-center gap-2">
                    <span>🚀 Publier la pièce sur le site</span>
                </button>
            </form>
        </div>

        <!-- Recent Uploads List -->
        <div class="bg-slate-950 rounded-3xl p-6 border border-slate-800 shadow-xl">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-800">
                <h3 class="text-sm font-black text-white">Dernières Pièces Ajoutées</h3>
                <span class="text-xs text-slate-400">{{ $recentProducts->count() }} articles</span>
            </div>

            <div class="space-y-3">
                @forelse($recentProducts as $prod)
                <div class="p-3 rounded-2xl bg-slate-900/80 border border-slate-800 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-14 h-14 rounded-xl bg-slate-800 flex-shrink-0 overflow-hidden flex items-center justify-center">
                            @if($prod->image && $prod->image !== 'default.jpg' && file_exists(public_path('storage/' . $prod->image)))
                                <img src="{{ asset('storage/' . $prod->image) }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl">📦</span>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-white text-xs truncate">{{ $prod->name }}</h4>
                            <span class="text-[10px] text-blue-400 font-semibold block">{{ $prod->category ?? 'Équipement' }}</span>
                            @if($prod->price)
                                <span class="text-xs font-black text-emerald-400">{{ number_format($prod->price, 2) }} DH</span>
                            @endif
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.mobile.destroy', $prod->id) }}" onsubmit="return confirm('Supprimer cet article ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-slate-500 hover:text-red-400 rounded-lg hover:bg-slate-800 transition text-xs font-bold" title="Supprimer">
                            🗑️
                        </button>
                    </form>
                </div>
                @empty
                <p class="text-xs text-slate-500 text-center py-4">Aucune pièce pour le moment.</p>
                @endforelse
            </div>
        </div>

        <!-- Add to Home Screen Tip -->
        <div class="p-4 rounded-2xl bg-blue-950/60 border border-blue-800/50 text-blue-200 text-xs flex items-center gap-3">
            <span class="text-2xl">📲</span>
            <div>
                <p class="font-bold text-white">Astuce Écran d'Accueil :</p>
                <p class="text-[11px] text-blue-300 mt-0.5">Appuyez sur "Partager" (iOS) ou les 3 points (Android) puis <strong>"Ajouter à l'écran d'accueil"</strong> pour l'utiliser comme une vraie application mobile.</p>
            </div>
        </div>
    </main>

    <!-- Bottom Native App Navigation Tab Bar -->
    <nav class="fixed bottom-0 inset-x-0 z-50 bg-slate-950/95 backdrop-blur-lg border-t border-slate-800 max-w-md mx-auto py-2.5 px-6 flex justify-around items-center shadow-2xl">
        <a href="{{ route('admin.mobile.uploader') }}" class="flex flex-col items-center gap-1 text-blue-400 font-bold text-[10px]">
            <span class="text-xl">📷</span>
            <span>Ajout Express</span>
        </a>
        <a href="{{ route('products') }}" target="_blank" class="flex flex-col items-center gap-1 text-slate-400 hover:text-white transition font-medium text-[10px]">
            <span class="text-xl">🛍️</span>
            <span>Catalogue</span>
        </a>
        <a href="{{ route('home') }}" target="_blank" class="flex flex-col items-center gap-1 text-slate-400 hover:text-white transition font-medium text-[10px]">
            <span class="text-xl">🌐</span>
            <span>Site Public</span>
        </a>
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-white transition font-medium text-[10px]">
            <span class="text-xl">⚙️</span>
            <span>Tableau</span>
        </a>
    </nav>

    <!-- Scripts -->
    <script>
        // Camera live preview
        const cameraInput = document.getElementById('camera-input');
        const cameraPrompt = document.getElementById('camera-prompt');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');

        cameraInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    imagePreview.src = evt.target.result;
                    cameraPrompt.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Category chips quick select
        const chips = document.querySelectorAll('.cat-chip');
        const selectedCatInput = document.getElementById('selected-category');

        chips.forEach(chip => {
            chip.addEventListener('click', function() {
                chips.forEach(c => {
                    c.classList.remove('bg-blue-600', 'text-white', 'border-blue-500');
                    c.classList.add('bg-slate-900', 'text-slate-300', 'border-slate-800');
                });
                this.classList.remove('bg-slate-900', 'text-slate-300', 'border-slate-800');
                this.classList.add('bg-blue-600', 'text-white', 'border-blue-500');
                selectedCatInput.value = this.getAttribute('data-cat');
            });
        });
    </script>
</body>
</html>

