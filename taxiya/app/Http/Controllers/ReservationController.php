<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    
    public function index()
    {
        $reservations = Reservation::where('voyageur_id', Auth::id())
            ->with(['trajet.chauffeur', 'trajet.taxi', 'place'])
            ->orderByDesc('created_at')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    // Store Reservation (Book a seat)
    public function store(Request $request, Trajet $trajet)
    {
        $request->validate([
            'place_id' => 'required|exists:places,id',
        ]);

        $place = Place::findOrFail($request->place_id);

        if ($place->trajet_id !== $trajet->id) {
            return back()->with('error', 'Place invalide pour ce trajet.');
        }

        if ($place->statut !== 'disponible') {
            return back()->with('error', 'Cette place est déjà réservée.');
        }

        // Check if user already booked a seat on this trip (Business Rule RB-005)
        $existingReservation = Reservation::where('voyageur_id', Auth::id())
            ->where('trajet_id', $trajet->id)
            ->whereIn('statut', ['confirmée', 'en_attente'])
            ->exists();

        if ($existingReservation) {
            return back()->with('error', 'Vous avez déjà réservé une place sur ce trajet.');
        }

        // Transaction to ensure atomicity
        DB::transaction(function () use ($trajet, $place) {
            // Update Place status
            $place->update(['statut' => 'réservée']);

            // Create Reservation
            Reservation::create([
                'voyageur_id' => Auth::id(),
                'trajet_id' => $trajet->id,
                'place_id' => $place->id,
                'date_reservation' => now(),
                'statut' => 'confirmée',
                'prix_paye' => $trajet->prix,
            ]);

            // Update Trajet available seats
            $trajet->decrement('places_disponibles');
        });

        return redirect()->route('reservations.index')->with('success', 'Réservation confirmée !');
    }
}