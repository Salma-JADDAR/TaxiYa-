<?php
// app/Http/Controllers/Auth/RegisteredUserController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'type' => ['required', 'in:voyageur,chauffeur'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            // Validation conditionnelle pour chauffeurs
            'cin' => ['required_if:type,chauffeur', 'string', 'max:20'],
            'permis_numero' => ['required_if:type,chauffeur', 'string', 'max:20'],
            'carte_grise' => ['required_if:type,chauffeur', 'string', 'max:50'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'password' => Hash::make($request->password),
            'cin' => $request->cin,
            'permis_numero' => $request->permis_numero,
            'carte_grise' => $request->carte_grise,
            'validated' => $request->type === 'voyageur' ? true : false, // Voyageurs validés d'office
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirection selon le type
        if ($user->isChauffeur()) {
            return redirect('/chauffeur/dashboard')->with('status', 'Votre compte est en attente de validation par l\'admin.');
        }

        return redirect('/voyageur/dashboard');
    }
}