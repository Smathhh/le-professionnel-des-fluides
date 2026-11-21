<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <title>PHEM INDUSTRIE - Mobile Express</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-icon.svg') }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#1E2430">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#141821] text-slate-100 min-h-full pb-28 font-sans selection:bg-[#C81E2B] selection:text-white">

    <!-- Top Native Mobile Header -->
    <header class="sticky top-0 z-40 bg-[#1E2430]/95 backdrop-blur-md border-b border-white/10 px-4 py-3 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-white/5 border border-[#C81E2B]/40 p-1.5 flex items-center justify-center">
                <img src="{{ asset('images/logo-icon.svg') }}" alt="Logo" class="w-full h-full">
            </div>
            <div>
                <span class="text-sm font-black tracking-tight text-white block">PHEM <span class="text-[#C81E2B]">INDUSTRIE</span></span>
                <span class="text-[10px] font-bold text-emerald-400 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Connecté • Hydraulique &amp; Pneumatique
                </span>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" target="_blank" class="text-[11px] font-bold bg-white/10 hover:bg-white/20 text-slate-200 px-3 py-1.5 rounded-xl border border-white/10">
                Site ↗
            </a>
            <a href="{{ route('admin.dashboard') }}" class="text-[11px] font-bold bg-[#C81E2B]/20 text-rose-300 px-3 py-1.5 rounded-xl border border-[#C81E2B]/40">
                Admin
            </a>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-md mx-auto px-4 pt-5 space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs font-bold flex items-center gap-3 shadow-lg">
                <span>✓ {{ session('success') }}</span>
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
        <div class="bg-[#1E2430] rounded-3xl p-6 border border-white/10 shadow-2xl">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-lg font-black text-white">Ajouter une Pièce / Matériel</h2>
                    <p class="text-xs text-slate-400">Compression auto &amp; publication instantanée</p>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-[#C81E2B]/20 border border-[#C81E2B]/40 text-rose-300 font-bold text-[10px] uppercase">
                    Express
                </span>
            </div>

            <form method="POST" action="{{ route('admin.mobile.store') }}" enctype="multipart/form-data" id="upload-form" class="space-y-5">
                @csrf

                <!-- Camera / Gallery Trigger -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        Photo de la pièce / équipement *
                    </label>

                    <div id="drop-zone" class="relative group cursor-pointer border-2 border-dashed border-slate-600 hover:border-[#C81E2B] rounded-3xl bg-[#141821] p-6 text-center transition-all overflow-hidden">
                        <input type="file" name="image" id="camera-input" accept="image/*" required class="absolute inset-0 opacity-0 cursor-pointer z-20">

                        <div id="camera-prompt" class="space-y-3">
                            <div class="w-16 h-16 mx-auto rounded-3xl bg-[#C81E2B] text-white flex items-center justify-center shadow-xl shadow-red-900/30 group-hover:scale-105 transition-transform">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-white">Appuyez pour prendre ou choisir une photo</p>
                                <p class="text-xs text-slate-400 mt-0.5">Caméra ou Galerie (optimisation automatique)</p>
                            </div>
                        </div>

                        <div id="preview-container" class="hidden relative">
                            <img id="image-preview" src="#" alt="Aperçu" class="w-full max-h-64 object-cover rounded-2xl mx-auto shadow-lg">
                            <div class="mt-3 flex items-center justify-center gap-2">
                                <span id="compression-badge" class="text-xs bg-emerald-500/20 text-emerald-300 px-3 py-1 rounded-full font-bold">
                                    ✓ Photo optimisée
                                </span>
                                <span class="text-xs text-rose-400 font-semibold underline">Changer</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Piece Name -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        Nom / Désignation de la pièce *
                    </label>
                    <input type="text" name="name" id="name-input" required
                           class="w-full px-4 py-3.5 bg-[#141821] border border-slate-700 rounded-2xl text-white text-base font-semibold focus:outline-none focus:ring-2 focus:ring-[#C81E2B] transition"
                           placeholder="Ex: Manomètre 250 bar, Limiteur de débit 1/2...">
                </div>

                <!-- Updated Hydraulic & Pneumatic Category Selector Chips -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        Catégorie *
                    </label>
                    <input type="hidden" name="category" id="selected-category" value="Hydraulique">

                    <div class="grid grid-cols-2 gap-2 text-xs font-bold" id="cat-chips">
                        <button type="button" data-cat="Hydraulique" class="cat-chip active p-3 rounded-xl bg-[#C81E2B] text-white border border-rose-500 text-left transition">
                            Hydraulique
                        </button>
                        <button type="button" data-cat="Pneumatique" class="cat-chip p-3 rounded-xl bg-[#141821] text-slate-300 border border-slate-700 text-left transition">
                            Pneumatique
                        </button>
                        <button type="button" data-cat="Électro-pompes & Centrales" class="cat-chip p-3 rounded-xl bg-[#141821] text-slate-300 border border-slate-700 text-left transition">
                            Électro-pompes &amp; Centrales
                        </button>
                        <button type="button" data-cat="Vérins & Accumulateurs" class="cat-chip p-3 rounded-xl bg-[#141821] text-slate-300 border border-slate-700 text-left transition">
                            Vérins &amp; Accumulateurs
                        </button>
                        <button type="button" data-cat="Flexibles & Raccords" class="cat-chip p-3 rounded-xl bg-[#141821] text-slate-300 border border-slate-700 text-left transition">
                            Flexibles &amp; Raccords
                        </button>
                        <button type="button" data-cat="Mécanique & Usinage" class="cat-chip p-3 rounded-xl bg-[#141821] text-slate-300 border border-slate-700 text-left transition">
                            Mécanique &amp; Usinage
                        </button>
                    </div>
                </div>

                <!-- Price (DH) -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        Prix Unitaire H.T (DH)
                    </label>
                    <div class="relative">
                        <input type="number" step="0.01" min="0" name="price"
                               class="w-full pl-4 pr-16 py-3.5 bg-[#141821] border border-slate-700 rounded-2xl text-white text-base font-bold focus:outline-none focus:ring-2 focus:ring-[#C81E2B] transition"
                               placeholder="Ex: 420.00">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-black text-rose-400 uppercase">
                            DH
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        Description / Référence
                    </label>
                    <textarea name="description" rows="2"
                              class="w-full px-4 py-3 bg-[#141821] border border-slate-700 rounded-2xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#C81E2B] transition"
                              placeholder="Pression, dimensions, référence constructeur..."></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submit-btn"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 px-6 rounded-2xl shadow-xl shadow-emerald-900/30 transition text-sm uppercase tracking-wider active:scale-95 flex items-center justify-center gap-2">
                    <span>Publier la pièce sur le site</span>
                </button>
            </form>
        </div>

        <!-- Recent Uploads List -->
        <div class="bg-[#1E2430] rounded-3xl p-6 border border-white/10 shadow-xl">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/10">
                <h3 class="text-sm font-black text-white">Dernières Pièces Ajoutées</h3>
                <span class="text-xs text-slate-400">{{ $recentProducts->count() }} articles</span>
            </div>

            <div class="space-y-3">
                @forelse($recentProducts as $prod)
                <div class="p-3 rounded-2xl bg-[#141821] border border-white/10 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-14 h-14 rounded-xl bg-slate-800 shrink-0 overflow-hidden flex items-center justify-center">
                            @if($prod->image && $prod->image !== 'default.jpg' && file_exists(public_path('storage/' . $prod->image)))
                                <img src="{{ asset('storage/' . $prod->image) }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xs font-bold text-slate-500">IMG</span>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-white text-xs truncate">{{ $prod->name }}</h4>
                            <span class="text-[10px] text-rose-400 font-semibold block">{{ $prod->category ?? 'Hydraulique' }}</span>
                            @if($prod->price)
                                <span class="text-xs font-black text-emerald-400">{{ number_format($prod->price, 2) }} DH</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-1.5 shrink-0">
                        <a href="{{ route('products.devis', $prod) }}" target="_blank" class="px-2.5 py-1.5 rounded-lg bg-white/10 hover:bg-[#C81E2B] text-white text-[10px] font-bold transition">
                            Devis
                        </a>
                        <form method="POST" action="{{ route('admin.mobile.destroy', $prod->id) }}" onsubmit="return confirm('Supprimer cet article ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2.5 py-1.5 text-slate-400 hover:text-red-400 rounded-lg bg-white/5 hover:bg-red-500/10 transition text-[10px] font-bold" title="Supprimer">
                                Suppr.
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <p class="text-xs text-slate-500 text-center py-4">Aucune pièce pour le moment.</p>
                @endforelse
            </div>
        </div>
    </main>

    <!-- Bottom Native App Navigation Tab Bar -->
    <nav class="fixed bottom-0 inset-x-0 z-50 bg-[#1E2430]/95 backdrop-blur-lg border-t border-white/10 max-w-md mx-auto py-2.5 px-6 flex justify-around items-center shadow-2xl">
        <a href="{{ route('admin.mobile.uploader') }}" class="flex flex-col items-center gap-0.5 text-[#C81E2B] font-bold text-[11px]">
            <span>+ Ajout Express</span>
        </a>
        <a href="{{ route('products') }}" target="_blank" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-white transition font-medium text-[11px]">
            <span>Catalogue</span>
        </a>
        <a href="{{ route('services') }}" target="_blank" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-white transition font-medium text-[11px]">
            <span>Services</span>
        </a>
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-white transition font-medium text-[11px]">
            <span>Admin</span>
        </a>
    </nav>

    <script>
        const cameraInput = document.getElementById('camera-input');
        const cameraPrompt = document.getElementById('camera-prompt');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const badge = document.getElementById('compression-badge');
        const uploadForm = document.getElementById('upload-form');
        const submitBtn = document.getElementById('submit-btn');

        // Client-side image compression for fast mobile uploads (max 1280px, JPEG 82%)
        cameraInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(evt) {
                const img = new Image();
                img.onload = function() {
                    const maxDim = 1280;
                    let w = img.width, h = img.height;
                    if (w > maxDim || h > maxDim) {
                        if (w > h) { h = Math.round(h * maxDim / w); w = maxDim; }
                        else { w = Math.round(w * maxDim / h); h = maxDim; }
                    }
                    const canvas = document.createElement('canvas');
                    canvas.width = w; canvas.height = h;
                    canvas.getContext('2d').drawImage(img, 0, 0, w, h);

                    canvas.toBlob(function(blob) {
                        if (blob && blob.size < file.size) {
                            const dt = new DataTransfer();
                            dt.items.add(new File([blob], file.name.replace(/\.\w+$/, '.jpg'), { type: 'image/jpeg' }));
                            cameraInput.files = dt.files;
                            badge.textContent = '✓ Optimisée (' + Math.round(blob.size / 1024) + ' Ko)';
                        } else {
                            badge.textContent = '✓ Photo prête';
                        }
                        imagePreview.src = canvas.toDataURL('image/jpeg', 0.82);
                        cameraPrompt.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                    }, 'image/jpeg', 0.82);
                };
                img.src = evt.target.result;
            };
            reader.readAsDataURL(file);
        });

        // Category chips quick select
        const chips = document.querySelectorAll('.cat-chip');
        const selectedCatInput = document.getElementById('selected-category');

        chips.forEach(chip => {
            chip.addEventListener('click', function() {
                chips.forEach(c => {
                    c.classList.remove('bg-[#C81E2B]', 'text-white', 'border-rose-500');
                    c.classList.add('bg-[#141821]', 'text-slate-300', 'border-slate-700');
                });
                this.classList.remove('bg-[#141821]', 'text-slate-300', 'border-slate-700');
                this.classList.add('bg-[#C81E2B]', 'text-white', 'border-rose-500');
                selectedCatInput.value = this.getAttribute('data-cat');
            });
        });

        // Prevent double submit & show loading indicator
        uploadForm.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-70');
            submitBtn.innerHTML = '<span>Publication en cours...</span>';
        });
    </script>
</body>
</html>
