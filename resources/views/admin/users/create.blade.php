@extends('layouts.admin')

@section('title', 'Créer un utilisateur')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-users.css') }}">

<div class="container-fluid content-wrapper">
    <div style="max-width: 600px; margin: 0 auto;">
        <div class="card">
            <!-- Header -->
            <div class="card-header bg-primary">
                <h1 style="margin: 0;"><i class="bi bi-plus-circle"></i> Créer un nouvel utilisateur</h1>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.users.store') }}" class="card-body">
                @csrf

                <!-- Nom -->
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nom complet <span style="color: var(--danger-color);">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                           placeholder="ex: Jean Dupont" required
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email <span style="color: var(--danger-color);">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                           placeholder="ex: jean@example.com" required
                           class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        Mot de passe <span style="color: var(--danger-color);">*</span>
                    </label>
                    <input type="password" id="password" name="password" 
                           placeholder="Minimum 8 caractères" required
                           class="form-control @error('password') is-invalid @enderror">
                    <small class="form-text text-muted">Minimum 8 caractères</small>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirmation mot de passe -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">
                        Confirmer le mot de passe <span style="color: var(--danger-color);">*</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           placeholder="Confirmer le mot de passe" required
                           class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Rôle -->
                <div class="mb-3">
                    <label for="role" class="form-label">
                        Rôle <span style="color: var(--danger-color);">*</span>
                    </label>
                    <select id="role" name="role" required
                            class="form-select @error('role') is-invalid @enderror">
                        <option value="">-- Sélectionner un rôle --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}" @selected(old('role') === $role)>
                                @if($role === 'admin')
                                    Administrateur
                                @else
                                    Utilisateur
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Boutons -->
                <div class="d-flex gap-2 pt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Créer l'utilisateur
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
