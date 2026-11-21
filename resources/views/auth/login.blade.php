<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion Administration - LE PROFESSIONNEL DES FLUIDES</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-icon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Brand Header -->
        <div class="text-center mb-8">
            <div class="mb-4">
                <img src="{{ asset('images/logo-white.svg') }}" alt="LE PROFESSIONNEL DES FLUIDES" class="h-14 w-auto mx-auto">
            </div>
            <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mt-1">Espace d'Administration Sécurisé</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-2xl border border-slate-100">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">Connexion Administrateur</h2>

            @if(isset($errors) && $errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 text-xs font-semibold p-4 rounded-xl mb-6">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Identifiant / Email</label>
                    <input type="email" name="email" required autofocus
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                           placeholder="admin@phemindustrie.ma"
                           value="{{ old('email') }}">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Mot de passe</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center text-slate-600 font-medium">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-blue-600 border-slate-300 mr-2">
                        <span>Se souvenir de moi</span>
                    </label>
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-3.5 px-4 rounded-xl shadow-lg shadow-blue-600/20 transition text-sm">
                    Se connecter à l'espace de gestion
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <a href="{{ route('home') }}" class="text-xs font-bold text-slate-500 hover:text-blue-600 transition inline-flex items-center gap-1">
                    ← Retourner au site public
                </a>
            </div>
        </div>
    </div>
</body>
</html>
