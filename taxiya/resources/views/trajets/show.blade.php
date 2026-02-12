@extends('layouts.app')

@section('title', 'Sélection de place')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Back Link -->
    <a href="{{ route('trajets.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-900 mb-6 transition">
        <i class="fas fa-arrow-left mr-2"></i> Retour aux résultats
    </a>

    <div class="grid lg:grid-cols-3 gap-8 items-start">
        
        <!-- Left: Visual Seat Map -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Choisissez votre place</h2>
            <p class="text-gray-500 mb-8">Les places avant sont plus spacieuses (Premium).</p>

            <div class="flex justify-center mb-10">
                <!-- Car Container -->
                <div class="relative w-[280px] bg-gray-50 rounded-[3rem] border-4 border-gray-200 p-6 pb-12 shadow-inner">
                    <!-- Windshield -->
                    <div class="h-24 bg-blue-100/50 rounded-t-[2rem] mb-6 border-b-2 border-gray-200 mx-2"></div>

                    <!-- Front Row -->
                    <div class="grid grid-cols-2 gap-4 mb-12 px-2">
                        <!-- Driver Seat (Visual) -->
                        <div class="bg-gray-200 rounded-2xl h-24 flex flex-col items-center justify-center text-gray-400 border-2 border-gray-300 border-dashed">
                            <i class="fas fa-dharmachakra text-2xl mb-1"></i>
                            <span class="text-xs font-bold uppercase">Chauffeur</span>
                        </div>

                        <!-- Passenger Front Slots (1-2) -->
                        <div class="grid grid-cols-2 gap-2">
                             @foreach($trajet->places->where('position', '<=', 2) as $place)
                                <form action="{{ route('reservations.store', $trajet) }}" method="POST" class="h-full">
                                    @csrf
                                    <input type="hidden" name="place_id" value="{{ $place->id }}">
                                    <button type="submit" 
                                        class="w-full h-full rounded-xl flex items-center justify-center font-bold text-lg transition-all transform hover:scale-105 shadow-sm
                                        {{ $place->statut === 'disponible' 
                                            ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-400 hover:text-white border-2 border-yellow-300' 
                                            : 'bg-gray-200 text-gray-400 cursor-not-allowed border-2 border-gray-200' }}"
                                        {{ $place->statut !== 'disponible' ? 'disabled' : '' }}
                                        title="{{ $place->type }} - {{ $place->statut }}">
                                        {{ $place->position }}
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>

                    <!-- Rear Row (3-6) -->
                    <div class="grid grid-cols-4 gap-2 px-1">
                        @foreach($trajet->places->where('position', '>', 2) as $place)
                            <form action="{{ route('reservations.store', $trajet) }}" method="POST">
                                @csrf
                                <input type="hidden" name="place_id" value="{{ $place->id }}">
                                <button type="submit" 
                                    class="w-full aspect-square rounded-xl flex items-center justify-center font-bold text-lg transition-all transform hover:scale-105 shadow-sm
                                    {{ $place->statut === 'disponible' 
                                        ? 'bg-white text-gray-700 hover:bg-green-500 hover:text-white border-2 border-gray-300 hover:border-green-500' 
                                        : 'bg-gray-200 text-gray-400 cursor-not-allowed border-2 border-gray-200' }}"
                                    {{ $place->statut !== 'disponible' ? 'disabled' : '' }}
                                    title="Standard - {{ $place->statut }}">
                                    {{ $place->position }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="flex justify-center gap-6 text-sm flex-wrap">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded bg-yellow-100 border border-yellow-300"></div>
                    <span class="text-gray-600">Avant (Premium)</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded bg-white border border-gray-300"></div>
                    <span class="text-gray-600">Arrière (Standard)</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded bg-gray-200 border border-gray-200"></div>
                    <span class="text-gray-400">Occupé</span>
                </div>
            </div>
        </div>

        <!-- Right: Trip Summary -->
        <div class="lg:col-span-1">
            <div class="bg-gray-900 rounded-3xl p-6 text-white shadow-xl sticky top-24">
                <h3 class="text-xl font-bold mb-6 border-b border-gray-700 pb-4">Résumé du trajet</h3>
                
                <div class="space-y-6">
                    <!-- Route -->
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-0.5 h-full bg-gray-700 my-1"></div>
                            <div class="w-3 h-3 bg-white rounded-full"></div>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <span class="text-xs text-gray-400 uppercase tracking-wider">Départ</span>
                                <p class="font-bold text-lg">{{ $trajet->depart }}</p>
                                <p class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($trajet->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($trajet->heure)->format('H:i') }}</p>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 uppercase tracking-wider">Arrivée</span>
                                <p class="font-bold text-lg">{{ $trajet->arrivee }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Driver -->
                    <div class="bg-gray-800 rounded-xl p-4 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300">Votre chauffeur</p>
                            <p class="font-bold">{{ $trajet->chauffeur->name }}</p>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="pt-4 border-t border-gray-700">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-400">Prix par place</span>
                            <span class="text-2xl font-bold text-yellow-500">{{ number_format($trajet->prix, 0) }} MAD</span>
                        </div>
                        
                        @guest
                            <a href="{{ route('login') }}" class="w-full block bg-white text-gray-900 text-center font-bold py-3 rounded-xl hover:bg-gray-100 transition">
                                Connectez-vous
                            </a>
                        @else
                            <div class="p-3 bg-yellow-500/10 rounded-lg border border-yellow-500/20 text-yellow-200 text-xs text-center">
                                <i class="fas fa-info-circle mr-1"></i> Sélectionnez une place sur le plan pour réserver.
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection