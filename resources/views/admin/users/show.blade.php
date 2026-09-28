@extends('layouts.admin')

@section('title', 'Détails: ' . $user->name)

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-users.css') }}">

<div class="container-fluid content-wrapper">
    <div class="row">
        <!-- Informations utilisateur -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-info">
                    <h2 style="margin: 0;"><i class="bi bi-person-circle"></i> Informations utilisateur</h2>
                </div>
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd><strong>#{{ $user->id }}</strong></dd>

                        <dt>Nom:</dt>
                        <dd>{{ $user->name }}</dd>

                        <dt>Email:</dt>
                        <dd><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></dd>

                        <dt>Rôle:</dt>
                        <dd>
                            @if($user->role === 'admin')
                                <span class="badge bg-danger"><i class="bi bi-shield-lock"></i> Administrateur</span>
                            @else
                                <span class="badge bg-primary"><i class="bi bi-person"></i> Utilisateur</span>
                            @endif
                        </dd>

                        <dt>Créé:</dt>
                        <dd>{{ $user->created_at->format('d/m/Y à H:i') }}</dd>

                        <dt>Modifié:</dt>
                        <dd>{{ $user->updated_at->format('d/m/Y à H:i') }}</dd>
                    </dl>
                </div>

                <!-- Actions -->
                <div class="card-footer bg-light">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Éditer
                    </a>
                    @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        <!-- Inscriptions -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-success">
                    <h2 style="margin: 0; display: flex; justify-content: space-between; align-items: center;">
                        <span><i class="bi bi-calendar-check"></i> Inscriptions</span>
                        <span class="badge bg-light text-success">{{ $user->registrations->count() }}</span>
                    </h2>
                </div>
                <div class="card-body">
                    @if($user->registrations->count() > 0)
                        <div class="overflow-y-auto">
                            @foreach($user->registrations as $registration)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                                            <h5 style="margin: 0;">{{ $registration->event->title }}</h5>
                                            <small class="text-muted">{{ $registration->created_at->format('d/m/Y') }}</small>
                                        </div>
                                        <p class="text-muted" style="margin: 0 0 8px 0;">
                                            <i class="bi bi-calendar-event"></i> {{ $registration->event->start_date }}
                                        </p>
                                        <p class="text-muted" style="margin: 0;">
                                            <i class="bi bi-tag"></i> {{ $registration->event->category->name ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="bi bi-inbox empty-state-icon"></i>
                            <p class="empty-state-text">Cet utilisateur n'a aucune inscription</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
