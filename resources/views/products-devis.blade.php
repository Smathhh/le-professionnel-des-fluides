@php
    $siteName = \App\Models\Setting::get('site_name', 'PHEM INDUSTRIE S.A.R.L');
    $phone = \App\Models\Setting::get('phone', '06 61 53 30 25');
    $fax = \App\Models\Setting::get('fax', '05 22 76 71 17');
    $email = \App\Models\Setting::get('email', 'phemindustrie20@gmail.com');
    $address = \App\Models\Setting::get('address', '75 BD 11 Janvier ETG 1 APT 169 Casablanca');
    $capital = \App\Models\Setting::get('capital', '100.000 DH');
    $rc = \App\Models\Setting::get('rc', '379533');
    $if = \App\Models\Setting::get('if', '20794461');
    $patente = \App\Models\Setting::get('patente', '33391116');
    $ice = \App\Models\Setting::get('ice', '001951579000095');
    $cnss = \App\Models\Setting::get('cnss', '5546281');

    $unitPrice = (float) ($product->price ?? 0);
    $totalHT = $unitPrice * $qty;
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DEVIS N° {{ $devisNumber }} - {{ $product->name }} | {{ $siteName }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-icon.svg') }}">
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body { background: #ffffff !important; padding: 0 !important; }
            .no-print { display: none !important; }
            .devis-sheet { box-shadow: none !important; border: none !important; margin: 0 !important; width: 100% !important; max-width: 100% !important; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-900 py-6 px-3 sm:px-6 font-sans">

    <!-- Interactive Customization Toolbar (Hidden on Print) -->
    <div class="no-print max-w-4xl mx-auto mb-6 bg-white rounded-2xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <form method="GET" action="{{ route('products.devis', $product) }}" class="grid grid-cols-1 sm:grid-cols-5 gap-3 items-end">
            <div class="sm:col-span-2">
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Client / Société</label>
                <input type="text" name="client" value="{{ $clientName }}" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Ville / Adresse</label>
                <input type="text" name="client_address" value="{{ $clientAddress }}" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Quantité</label>
                <input type="number" min="1" name="qty" value="{{ $qty }}" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-[#1E2430] hover:bg-slate-800 text-white font-bold text-xs py-2.5 px-3 rounded-lg transition">
                    Actualiser
                </button>
                <button type="button" onclick="window.print()" class="flex-1 bg-[#C81E2B] hover:bg-red-700 text-white font-bold text-xs py-2.5 px-3 rounded-lg transition">
                    Imprimer / PDF
                </button>
            </div>
        </form>
        <div class="mt-3 flex justify-between items-center text-xs text-slate-500">
            <a href="{{ route('products') }}" class="hover:text-[#C81E2B] font-semibold">← Retour au catalogue</a>
            <span>Astuce : Cliquez sur <strong>Imprimer / PDF</strong> puis choisissez <strong>Enregistrer au format PDF</strong>.</span>
        </div>
    </div>

    <!-- Official A4 DEVIS Sheet Matching Letterhead -->
    <div class="devis-sheet max-w-4xl mx-auto bg-white shadow-xl border border-slate-200 overflow-hidden flex flex-col justify-between min-h-[1040px]">
        <div class="p-8 sm:p-12">
            <!-- Header: Logo Left + Company Details Right -->
            <div class="flex flex-col sm:flex-row justify-between items-start gap-6 pb-6">
                <div>
                    <img src="{{ asset('images/logo.svg') }}" alt="{{ $siteName }}" class="h-16 w-auto">
                </div>
                <div class="text-left sm:text-right max-w-md">
                    <h1 class="text-lg font-black tracking-wide text-[#1E2430] uppercase">{{ $siteName }}</h1>
                    <p class="text-[11px] font-bold text-slate-700 leading-snug uppercase mt-1">
                        ACHAT, VENTE ET COMMERCIALISATION DES FOURNITURES<br>
                        ET ÉQUIPEMENTS INDUSTRIE HYDRAULIQUE, PNEUMATIQUES,<br>
                        MÉCANIQUE, TOURNAGE FRAISAGE.
                    </p>
                </div>
            </div>

            <!-- Client Box (Top Right) -->
            <div class="flex justify-end mt-2 mb-6">
                <div class="border-2 border-[#1E2430] rounded-2xl px-6 py-4 min-w-[260px] max-w-sm">
                    <p class="text-xs font-extrabold text-[#1E2430] uppercase tracking-wide">{{ $clientName }}</p>
                    <p class="text-xs font-semibold text-slate-700 uppercase mt-1">{{ $clientAddress }}</p>
                </div>
            </div>

            <!-- Date -->
            <div class="text-right text-sm font-semibold text-slate-800 mb-6">
                Casablanca, le {{ date('d/m/Y') }}
            </div>

            <!-- Objet & Concerne -->
            <div class="space-y-1 text-sm mb-6 font-mono">
                <p><span class="font-bold underline">Objet</span> : <span class="font-bold text-[#1E2430]">DEVIS n° {{ $devisNumber }}</span></p>
                <p><span class="font-bold underline">Concerne</span> : <span class="font-bold">FOURNITURE</span></p>
                <p class="pt-3 text-xs sm:text-sm font-semibold tracking-wide uppercase">
                    SUITE À VOTRE DEMANDE NOUS VOUS PROPOSONS UNE MEILLEURE OFFRE DE PRIX ET DÉLAI POUR :
                </p>
            </div>

            <!-- Devis Table -->
            <div class="border border-slate-800">
                <table class="w-full text-xs sm:text-sm border-collapse font-mono">
                    <thead>
                        <tr class="border-b border-slate-800 bg-slate-50 text-slate-900">
                            <th class="border-r border-slate-800 px-3 py-2 text-center w-16">N° Prix</th>
                            <th class="border-r border-slate-800 px-3 py-2 text-left">Désignation des ouvrages</th>
                            <th class="border-r border-slate-800 px-3 py-2 text-center w-12">U</th>
                            <th class="border-r border-slate-800 px-3 py-2 text-center w-16">Qté</th>
                            <th class="border-r border-slate-800 px-3 py-2 text-right w-28">P.U</th>
                            <th class="px-3 py-2 text-right w-28">P.T</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-top">
                            <td class="border-r border-slate-800 px-3 py-4 text-center font-bold">01</td>
                            <td class="border-r border-slate-800 px-3 py-4">
                                <div class="font-bold uppercase text-[#1E2430]">{{ $product->name }}</div>
                                @if($product->description)
                                    <div class="text-[11px] text-slate-600 mt-1">{{ $product->description }}</div>
                                @endif
                                <div class="text-[10px] text-slate-400 mt-1">Réf : PH-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td class="border-r border-slate-800 px-3 py-4 text-center">U</td>
                            <td class="border-r border-slate-800 px-3 py-4 text-center font-bold">{{ str_pad((string) $qty, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="border-r border-slate-800 px-3 py-4 text-right">{{ number_format($unitPrice, 2, ',', ' ') }}</td>
                            <td class="px-3 py-4 text-right font-bold">{{ number_format($totalHT, 2, ',', ' ') }}</td>
                        </tr>
                        <!-- Blank spacer rows for authentic A4 sheet look -->
                        <tr class="h-56">
                            <td class="border-r border-slate-800"></td>
                            <td class="border-r border-slate-800"></td>
                            <td class="border-r border-slate-800"></td>
                            <td class="border-r border-slate-800"></td>
                            <td class="border-r border-slate-800"></td>
                            <td></td>
                        </tr>
                        <!-- Total Row -->
                        <tr class="border-t border-slate-800 bg-slate-50">
                            <td colspan="5" class="border-r border-slate-800 px-4 py-3 text-center font-extrabold text-slate-900">
                                Total Général H.T (DH)
                            </td>
                            <td class="px-3 py-3 text-right font-black text-base text-[#1E2430]">
                                {{ number_format($totalHT, 2, ',', ' ') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Delay & Signature -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mt-10 gap-6 font-mono text-xs">
                <div>
                    <span class="font-bold">DÉLAI :</span> <span class="uppercase font-bold text-[#1E2430]">{{ $delai }}</span>
                </div>
                <div class="text-center">
                    <p class="font-bold uppercase tracking-wider mb-3">SINCÈRES SALUTATIONS</p>
                    <div class="border-2 border-sky-700/70 text-sky-800/80 rounded-lg px-4 py-2 inline-block transform -rotate-2">
                        <div class="font-black text-[11px] uppercase">{{ $siteName }}</div>
                        <div class="text-[9px]">{{ $address }}</div>
                        <div class="text-[9px]">Tél : {{ $phone }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Official Dark Footer with Red Strip -->
        <div class="relative bg-[#1E2430] text-white text-center px-6 py-4 border-t-4 border-[#C81E2B]">
            <p class="text-[11px] font-bold">ADRESSE : {{ $address }}</p>
            <p class="text-[11px] mt-0.5">
                Tél/Fax : {{ $fax }} / GSM : {{ $phone }} &nbsp;|&nbsp; Email : {{ $email }}
            </p>
            <p class="text-[10px] text-slate-300 mt-1">
                CAPITAL DE {{ $capital }} &nbsp;•&nbsp; RC : {{ $rc }} &nbsp;•&nbsp; IF : {{ $if }} &nbsp;•&nbsp; PATENTE : {{ $patente }} &nbsp;•&nbsp; ICE : {{ $ice }} &nbsp;•&nbsp; CNSS : {{ $cnss }}
            </p>
        </div>
    </div>

</body>
</html>
