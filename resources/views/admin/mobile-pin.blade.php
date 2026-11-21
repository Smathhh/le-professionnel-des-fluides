<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <title>Phem Mobile Admin - Déverrouillage</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-icon.svg') }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0F172A">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-950 text-white min-h-full flex flex-col justify-between p-6 select-none font-sans">
    <!-- Top Branding -->
    <div class="text-center pt-8">
        <div class="w-20 h-20 mx-auto rounded-3xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center p-3 shadow-2xl mb-4">
            <img src="{{ asset('images/logo-icon.svg') }}" alt="Phem Industrie" class="w-full h-full">
        </div>
        <h1 class="text-2xl font-black tracking-tight text-white">PHEM ADMIN MOBILE</h1>
        <p class="text-xs font-semibold text-slate-400 mt-1 uppercase tracking-wider">Application Express Pièces & Matériel</p>
    </div>

    <!-- PIN Entry Card -->
    <div class="max-w-xs mx-auto w-full my-auto">
        @if($errors->any())
            <div class="bg-red-500/20 border border-red-500/40 text-red-300 text-xs font-bold p-3 rounded-2xl mb-6 text-center animate-shake">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.mobile.pin') }}" id="pin-form" class="space-y-6">
            @csrf

            <div class="text-center">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">
                    Entrez votre Code PIN Admin
                </label>
                <input type="password" name="pin" id="pin-input" required maxlength="6" autofocus inputmode="numeric"
                       class="w-full text-center tracking-[1em] text-3xl font-black py-4 bg-slate-900 border-2 border-slate-800 rounded-2xl text-white focus:outline-none focus:border-blue-500 transition shadow-inner"
                       placeholder="••••">
                <p class="text-[11px] text-slate-500 mt-2 font-medium">
                    Accès réservé aux techniciens et à l'administration
                </p>
            </div>

            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-black py-4 rounded-2xl shadow-xl shadow-blue-600/25 transition active:scale-95 text-sm uppercase tracking-wider">
                Déverrouiller l'App 🔓
            </button>
        </form>
    </div>

    <!-- Bottom Links -->
    <div class="text-center pb-4 text-xs text-slate-500 space-y-2">
        <a href="{{ route('login') }}" class="text-slate-400 hover:text-white block font-semibold underline">
            Se connecter avec email & mot de passe
        </a>
        <a href="{{ route('home') }}" class="text-slate-600 hover:text-slate-400 block">
            ← Retour au site public
        </a>
    </div>
</body>
</html>

