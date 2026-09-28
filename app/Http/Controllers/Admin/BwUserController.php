<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserBw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controller pour la gestion des utilisateurs (Admin only)
 * Permet à l'admin de créer, lire, modifier et supprimer des utilisateurs
 */
class BwUserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs
     * GET /admin/users
     */
    public function index()
    {
        $users = UserBw::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Afficher le formulaire de création d'un nouvel utilisateur
     * GET /admin/users/create
     */
    public function create()
    {
        $roles = ['admin', 'user'];
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Enregistrer un nouvel utilisateur en base de données
     * POST /admin/users
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users_bw,email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ], [
            'name.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.unique' => 'Cet email est déjà utilisé',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.confirmed' => 'Les mots de passe ne correspondent pas',
            'role.required' => 'Le rôle est obligatoire',
        ]);

        UserBw::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "Utilisateur {$validated['name']} créé avec succès");
    }

    /**
     * Afficher les détails d'un utilisateur
     * GET /admin/users/{id}
     */
    public function show(string $id)
    {
        $user = UserBw::with('registrations.event')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Afficher le formulaire d'édition d'un utilisateur
     * GET /admin/users/{id}/edit
     */
    public function edit(string $id)
    {
        $user = UserBw::findOrFail($id);
        $roles = ['admin', 'user'];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Mettre à jour un utilisateur
     * PUT /admin/users/{id}
     */
    public function update(Request $request, string $id)
    {
        $user = UserBw::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users_bw,email,' . $user->id . '|max:255',
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'name.required' => 'Le nom est obligatoire',
            'email.unique' => 'Cet email est déjà utilisé',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ]);

        // Mettre à jour le mot de passe uniquement s'il est fourni
        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', "Utilisateur {$validated['name']} mis à jour avec succès");
    }

    /**
     * Supprimer un utilisateur
     * DELETE /admin/users/{id}
     */
    public function destroy(string $id)
    {
        $user = UserBw::findOrFail($id);

        // Empêcher la suppression de soi-même
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte');
        }

        // Optionnel: Supprimer les inscriptions de l'utilisateur
        $user->registrations()->delete();

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "Utilisateur supprimé avec succès");
    }
}
