@extends('layouts.app')

@section('title', 'Nouveau Trajet')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800"><i class="fas fa-plus-circle text-yellow-500 mr-2"></i>Publier un trajet</h2>
    
    <form action="{{ route('trajets.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Départ</label>
                <input type="text" name="depart" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Arrivée</label>
                <input type="text" name="arrivee" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                <input type="date" name="date" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Heure</label>
                <input type="time" name="heure" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Prix par place (MAD)</label>
            <input type="number" name="prix" step="0.01" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div class="bg-gray-50 p-4 rounded text-sm text-gray-600 mb-6 border border-gray-200">
            <p><i class="fas fa-info-circle mr-1"></i> Votre taxi <strong>{{ $taxi->marque }} {{ $taxi->modele }}</strong> sera utilisé pour ce trajet.</p>
            <p class="mt-1"><i class="fas fa-check-circle mr-1"></i> 6 places seront automatiquement mises en vente.</p>
        </div>

        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline transition">
            Publier le trajet
        </button>
    </form>
</div>
@endsection