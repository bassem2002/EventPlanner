<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\UserBw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BwRegisterController extends Controller
{
    // Afficher le formulaire
    public function create()
    {
        return view('user.register');
    }

    // Enregistrer l'utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users_bw,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        UserBw::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // tous les nouveaux sont users
        ]);

        return redirect('/')->with('success', 'Compte créé avec succès !');
    }
}