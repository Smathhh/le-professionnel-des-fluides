<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <title>PHEM INDUSTRIE - Déverrouillage</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-icon.svg') }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#1E2430">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#1E2430] text-white min-h-full flex flex-col justify-between p-6 select-none font-sans">
    <!-- Top Branding -->
    <div class="text-center pt-8">
        <div class="w-20 h-20 mx-auto rounded-3xl bg-white/5 border border-[#C81E2B]/40 flex items-center justify-center p-3 shadow-2xl mb-4">
            <img src="{{ asset('images/logo-icon.svg') }}" alt="PHEM INDUSTRIE" class="w-full h-full">
        </div>
        <h1 class="text-2xl font-black tracking-tight text-white">PHEM <span class="text-[#C81E2B]">INDUSTRIE</span></h1>
        <p class="text-[11px] font-semibold text-slate-400 mt-1 uppercase tracking-wider">Application Express Hydraulique &amp; Pneumatique</p>
    </div>

    <!-- PIN Entry Card -->
    <div class="max-w-xs mx-auto w-full my-auto">
        @if($errors->any())
            <div class="bg-red-500/20 border border-red-500/40 text-red-300 text-xs font-bold p-3 rounded-2xl mb-6 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.mobile.pin') }}" id="pin-form" class="space-y-6">
            @csrf

            <div class="text-center">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">
                    Code PIN Technicien / Admin
                </label>
                <input type="password" name="pin" id="pin-input" required maxlength="6" autofocus inputmode="numeric"
                       class="w-full text-center tracking-[1em] text-3xl font-black py-4 bg-[#141821] border-2 border-slate-700 rounded-2xl text-white focus:outline-none focus:border-[#C81E2B] transition shadow-inner"
                       placeholder="••••">
                <p class="text-[11px] text-slate-400 mt-2 font-medium">
                    Accès réservé à l'équipe PHEM INDUSTRIE S.A.R.L
                </p>
            </div>

            <button type="submit"
                    class="w-full bg-[#C81E2B] hover:bg-red-700 text-white font-black py-4 rounded-2xl shadow-xl shadow-red-900/30 transition active:scale-95 text-sm uppercase tracking-wider">
                Déverrouiller l'App
            </button>
        </form>
    </div>

    <!-- Bottom Links -->
    <div class="text-center pb-4 text-xs text-slate-500 space-y-2">
        <a href="{{ route('login') }}" class="text-slate-300 hover:text-white block font-semibold underline">
            Connexion par email &amp; mot de passe
        </a>
        <a href="{{ route('home') }}" class="text-slate-400 hover:text-white block">
            ← Retour au site public
        </a>
    </div>
</body>
</html>
