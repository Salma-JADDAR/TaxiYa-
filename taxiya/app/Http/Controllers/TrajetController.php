<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Taxi;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrajetController extends Controller
{
    // Search and List
    public function index(Request $request)
    {
        $query = Trajet::query()->with('chauffeur', 'taxi');

        if ($request->filled('depart')) {
            $query->where('depart', 'like', '%' . $request->depart . '%');
        }
        if ($request->filled('arrivee')) {
            $query->where('arrivee', 'like', '%' . $request->arrivee . '%');
        }
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $trajets = $query->orderBy('date')->orderBy('heure')->get();

        return view('trajets.index', compact('trajets'));
    }

    // Show Trip Details & Seats
    public function show(Trajet $trajet)
    {
        $trajet->load(['places' => function($query) {
            $query->orderBy('position');
        }, 'chauffeur', 'taxi']);
        
        return view('trajets.show', compact('trajet'));
    }

    // Show Create Form (Drivers Only)
    public function create()
    {
        // Ensure user is a chauffeur
        if (Auth::user()->type !== 'chauffeur') {
            return redirect('/')->with('error', 'Accès réservé aux chauffeurs.');
        }

        // Get driver's taxi (Simplified: assumes 1 taxi per driver for MVP)
        $taxi = Taxi::where('chauffeur_id', Auth::id())->first();

        if (!$taxi) {
            // In a real app, redirect to "Add Taxi" page. For MVP, we might need to seed this or handle it.
            // Let's assume for now they need to have a taxi.
            return redirect('/')->with('error', 'Vous devez avoir un taxi enregistré.');
        }

        return view('trajets.create', compact('taxi'));
    }

    // Store New Trip
    public function store(Request $request)
    {
        if (Auth::user()->type !== 'chauffeur') {
            abort(403);
        }

        $request->validate([
            'depart' => 'required|string|max:255',
            'arrivee' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required',
            'prix' => 'required|numeric|min:0',
        ]);

        $taxi = Taxi::where('chauffeur_id', Auth::id())->firstOrFail();

        $trajet = Trajet::create([
            'chauffeur_id' => Auth::id(),
            'taxi_id' => $taxi->id,
            'depart' => $request->depart,
            'arrivee' => $request->arrivee,
            'date' => $request->date,
            'heure' => $request->heure,
            'prix' => $request->prix,
            'statut' => 'planifié',
            'places_disponibles' => 6,
            'places_total' => 6,
        ]);

        // Auto-generate 6 seats
        for ($i = 1; $i <= 6; $i++) {
            Place::create([
                'trajet_id' => $trajet->id,
                'position' => $i,
                'type' => ($i <= 2) ? 'premium' : 'standard', // Front seats premium
                'statut' => 'disponible',
            ]);
        }

        return redirect()->route('trajets.index')->with('success', 'Trajet créé avec succès !');
    }
}