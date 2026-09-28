@extends('layouts.admin')

@section('title', 'Gestion des utilisateurs')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-users.css') }}">

<div class="container-fluid content-wrapper">
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h1 style="margin: 0;"><i class="bi bi-people"></i> Gestion des utilisateurs</h1>
            <p class="text-muted" style="margin: 5px 0 0 0;">Créez, modifiez ou supprimez les utilisateurs de l'application</p>
        </div>
        <div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nouvel utilisateur
            </a>
        </div>
    </div>

    <!-- Messages -->
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <i class="bi bi-check-circle"></i>
            <span>{{ $message }}</span>
        </div>
    @endif

    @if($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            <i class="bi bi-exclamation-circle"></i>
            <span>{{ $message }}</span>
        </div>
    @endif

    <!-- Tableau -->
    <div class="card">
        @if($users->count())
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Date création</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><strong>#{{ $user->id }}</strong></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role === 'admin')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-shield-lock"></i> Admin
                                        </span>
                                    @else
                                        <span class="badge bg-primary">
                                            <i class="bi bi-person"></i> Utilisateur
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td style="text-align: right;">
                                    <div style="display: flex; gap: 8px; justify-content: flex-end; flex-wrap: wrap;">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-eye"></i> Voir
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Éditer
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> Supprimer
                                                </button>
                                            </form>
                                        @else
                                            <span style="font-size: 12px; color: var(--gray-600);">(Votre compte)</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-inbox empty-state-icon"></i>
                <p class="empty-state-text">Aucun utilisateur trouvé</p>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="margin-top: 15px;">
                    <i class="bi bi-plus-circle"></i> Créer le premier utilisateur
                </a>
            </div>
        @endif

        <!-- Pagination -->
        @if($users->hasPages())
            <div style="padding: 15px 20px; background-color: var(--light-color); border-top: 1px solid var(--gray-300);">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
