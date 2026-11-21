@extends('layouts.admin')

@php
    $title = 'Tableau de Bord';
@endphp

@section('content')
<!-- Metric Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Produits Actifs</p>
                <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['products'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl font-bold">
                📦
            </div>
        </div>
        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Catalogue en ligne</span>
            <a href="{{ route('admin.products.index') }}" class="font-bold text-blue-600 hover:underline">Gérer ›</a>
        </div>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Services Proposés</p>
                <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['services'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl font-bold">
                🛠️
            </div>
        </div>
        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Prestations actives</span>
            <a href="{{ route('admin.services.index') }}" class="font-bold text-emerald-600 hover:underline">Gérer ›</a>
        </div>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Projets en Galerie</p>
                <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['gallery'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl font-bold">
                🖼️
            </div>
        </div>
        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Réalisations Avant/Après</span>
            <a href="{{ route('admin.gallery.index') }}" class="font-bold text-purple-600 hover:underline">Gérer ›</a>
        </div>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Messages Reçus</p>
                <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['messages'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl font-bold">
                ✉️
            </div>
        </div>
        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Demandes clients</span>
            <span class="font-bold text-amber-600">Formulaire contact</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Quick Actions -->
    <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-200">
        <h3 class="text-lg font-bold text-slate-900 mb-5">Actions Rapides</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('admin.products.create') }}" 
               class="flex flex-col items-center justify-center p-5 rounded-2xl bg-blue-50 text-blue-700 hover:bg-blue-100 transition font-bold text-xs text-center border border-blue-100">
                <span class="text-2xl mb-2">➕📦</span>
                <span>Nouveau Produit</span>
            </a>
            <a href="{{ route('admin.services.create') }}" 
               class="flex flex-col items-center justify-center p-5 rounded-2xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition font-bold text-xs text-center border border-emerald-100">
                <span class="text-2xl mb-2">➕🛠️</span>
                <span>Nouveau Service</span>
            </a>
            <a href="{{ route('admin.gallery.create') }}" 
               class="flex flex-col items-center justify-center p-5 rounded-2xl bg-purple-50 text-purple-700 hover:bg-purple-100 transition font-bold text-xs text-center border border-purple-100">
                <span class="text-2xl mb-2">➕🖼️</span>
                <span>Nouveau Projet</span>
            </a>
        </div>

        <div class="mt-6 pt-6 border-t border-slate-100 flex items-center justify-between">
            <span class="text-xs text-slate-500">Numéro WhatsApp actuel du site :</span>
            <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">
                {{ \App\Models\Setting::get('whatsapp', '+212666569562') }}
            </span>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="bg-white rounded-3xl p-7 shadow-sm border border-slate-200">
        <h3 class="text-lg font-bold text-slate-900 mb-5">Dernières Demandes de Contact</h3>
        @if($recentMessages->count() > 0)
            <div class="space-y-4">
                @foreach($recentMessages as $message)
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-bold text-sm text-slate-900">{{ $message->name }}</p>
                            <p class="text-xs text-slate-500">{{ $message->email }} • {{ $message->phone }}</p>
                            <p class="text-xs text-slate-700 mt-2 bg-white p-2.5 rounded-xl border border-slate-100">{{ Str::limit($message->message, 120) }}</p>
                        </div>
                        @if(!$message->is_read)
                            <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">Nouveau</span>
                        @endif
                    </div>
                    <p class="text-[11px] text-slate-400 mt-2">{{ $message->created_at->diffForHumans() }}</p>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10">
                <span class="text-3xl">📭</span>
                <p class="text-slate-500 text-xs mt-2">Aucun message pour le moment</p>
            </div>
        @endif
    </div>
</div>

<!-- Mobile Admin Tip -->
<div class="mt-8 bg-gradient-to-r from-blue-900 to-indigo-900 rounded-3xl p-6 text-white shadow-xl flex items-center gap-5">
    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center text-3xl flex-shrink-0">
        📱
    </div>
    <div>
        <h4 class="font-black text-base text-white">Gestion Mobile Optimisée</h4>
        <p class="text-xs text-blue-200 mt-1">Vous pouvez vous connecter à cette interface depuis votre smartphone pour prendre directement en photo vos équipements ou vos chantiers et les publier en 30 secondes.</p>
    </div>
</div>
@endsection
