<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

public function toLogin(LoginRequest $req)
{
    $credentials = $req->validated();

    if (Auth::attempt($credentials)) {
        $req->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.categories.index');
        }

        // utilisateur simple
        return redirect('/accueil');
    }

    return to_route('login')
        ->withErrors(['email' => 'Email ou mot de passe invalide'])
        ->withInput(['email']);
}

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
