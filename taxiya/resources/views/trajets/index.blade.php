@extends('layouts.app')

@section('title', 'Rechercher un trajet')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Search Bar (Sticky-ish) -->
    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-lg border border-gray-100 mb-10 transition-all hover:shadow-xl">
        <form action="{{ route('trajets.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <!-- Locations -->
            <div class="md:col-span-5 grid grid-cols-2 gap-2 bg-gray-50 p-2 rounded-xl border border-gray-200">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-circle text-xs text-green-500"></i>
                    </div>
                    <input type="text" name="depart" value="{{ request('depart') }}" placeholder="Départ" class="w-full pl-8 pr-3 py-2 bg-transparent text-gray-900 placeholder-gray-400 focus:outline-none text-sm font-medium border-r border-gray-200" />
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-circle text-xs text-red-500"></i>
                    </div>
                    <input type="text" name="arrivee" value="{{ request('arrivee') }}" placeholder="Arrivée" class="w-full pl-8 pr-3 py-2 bg-transparent text-gray-900 placeholder-gray-400 focus:outline-none text-sm font-medium" />
                </div>
            </div>

            <!-- Date -->
            <div class="md:col-span-3 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="far fa-calendar text-gray-400"></i>
                </div>
                <input type="date" name="date" value="{{ request('date') }}" class="w-full pl-10 pr-3 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition font-medium" />
            </div>

            <!-- Submit -->
            <div class="md:col-span-4">
                <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white font-bold py-4 rounded-xl transition shadow-md hover:shadow-lg flex justify-center items-center gap-2">
                    <i class="fas fa-search"></i>
                    <span>Trouver mon taxi</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Results Header -->
    <div class="flex justify-between items-end mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Trajets disponibles</h2>
            <p class="text-gray-500 text-sm mt-1">{{ count($trajets) }} résultats trouvés</p>
        </div>
        
    </div>

    <!-- Results Grid -->
    <div class="grid gap-6">
        @forelse($trajets as $trajet)
            <div class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-yellow-200 transition-all duration-300 relative overflow-hidden">
                <!-- Hover Accent -->
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-yellow-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                <div class="grid md:grid-cols-4 gap-6 items-center">
                    <!-- Time & Route -->
                    <div class="md:col-span-2 space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="flex flex-col items-center">
                                <span class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($trajet->heure)->format('H:i') }}</span>
                                <div class="h-8 w-0.5 bg-gray-200 my-1 relative"></div>
                                <span class="text-sm text-gray-400">Arrivée</span>
                            </div>
                            <div class="flex-1 space-y-6 pt-2">
                                <div class="relative">
                                    <div class="absolute -left-[25px] top-1.5 w-2 h-2 rounded-full bg-white border-2 border-gray-900"></div>
                                    <h3 class="font-bold text-lg text-gray-900 leading-none">{{ $trajet->depart }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">Gare Routière</p>
                                </div>
                                <div class="relative">
                                    <div class="absolute -left-[25px] top-1.5 w-2 h-2 rounded-full bg-gray-900"></div>
                                    <h3 class="font-bold text-lg text-gray-900 leading-none">{{ $trajet->arrivee }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">Centre Ville</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Driver & Car Info -->
                    <div class="flex items-center gap-3 md:justify-center border-t md:border-t-0 md:border-l border-gray-100 pt-4 md:pt-0 pl-0 md:pl-6">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-sm text-gray-900">{{ $trajet->chauffeur->name }}</p>
                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span>4.8</span>
                                <span class="text-gray-300">|</span>
                                <span>{{ $trajet->taxi->marque ?? 'Taxi' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Price & CTA -->
                    <div class="flex flex-row md:flex-col justify-between items-center md:items-end gap-2 border-t md:border-t-0 border-gray-100 pt-4 md:pt-0">
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-gray-900">{{ number_format($trajet->prix, 0) }} MAD</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs font-bold {{ $trajet->places_disponibles > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                <i class="fas {{ $trajet->places_disponibles > 0 ? 'fa-check' : 'fa-times' }}"></i>
                                {{ $trajet->places_disponibles }} places
                            </span>
                        </div>
                        
                        <a href="{{ route('trajets.show', $trajet) }}" class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-2.5 px-6 rounded-xl transition shadow hover:shadow-md text-sm">
                            Réserver
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-gray-300">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="fas fa-search text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Aucun trajet trouvé</h3>
                <p class="text-gray-500 mt-2">Essayez de changer vos dates ou votre destination.</p>
                <a href="{{ route('trajets.index') }}" class="inline-block mt-4 text-yellow-600 font-semibold hover:underline">Voir tous les trajets</a>
            </div>
        @endforelse
    </div>
</div>
@endsection