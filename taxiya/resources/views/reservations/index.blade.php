@extends('layouts.app')

@section('title', 'Mes Réservations')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800"><i class="fas fa-ticket-alt text-yellow-500 mr-2"></i>Mes Réservations</h2>

    <div class="space-y-4">
        @forelse($reservations as $reservation)
            <div class="bg-white p-6 rounded-lg shadow border-l-4 {{ $reservation->statut === 'annulée' ? 'border-red-400' : 'border-green-500' }}">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <div class="flex items-center text-xl font-bold text-gray-800 mb-2">
                            <span>{{ $reservation->trajet->depart }}</span>
                            <i class="fas fa-arrow-right mx-3 text-yellow-500"></i>
                            <span>{{ $reservation->trajet->arrivee }}</span>
                        </div>
                        
                        <div class="text-gray-600 mb-1">
                            <i class="far fa-calendar-alt mr-2"></i> {{ \Carbon\Carbon::parse($reservation->trajet->date)->format('d/m/Y') }}
                            <i class="far fa-clock ml-4 mr-2"></i> {{ \Carbon\Carbon::parse($reservation->trajet->heure)->format('H:i') }}
                        </div>
                        
                        <div class="text-sm text-gray-500 mt-2">
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded mr-2">
                                Place #{{ $reservation->place->position }}
                            </span>
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded">
                                Taxi : {{ $reservation->trajet->taxi->marque }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-4 md:mt-0 text-right">
                        <div class="text-lg font-bold text-gray-800 mb-1">{{ number_format($reservation->prix_paye, 0) }} MAD</div>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold 
                            {{ $reservation->statut === 'confirmée' ? 'bg-green-100 text-green-800' : 
                               ($reservation->statut === 'annulée' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($reservation->statut) }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded shadow-md">
                <i class="fas fa-suitcase-rolling fa-4x text-gray-300 mb-4"></i>
                <p class="text-xl text-gray-600 mb-4">Vous n'avez pas encore de réservations.</p>
                <a href="{{ route('trajets.index') }}" class="bg-yellow-500 text-white font-bold py-2 px-6 rounded-full hover:bg-yellow-600 transition">
                    Trouver un trajet
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection