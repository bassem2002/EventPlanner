@extends('layouts.user')

@section('title', 'Accueil - Event Planner')

@section('content')
<div class="container py-5">
    @auth
        <!-- Authenticated User Home -->
        <div class="row mb-5">
            <div class="col-lg-10">
                <h1 class="display-5 fw-bold mb-3">
                    👋 Bienvenue, {{ Auth::user()->name }} !
                </h1>
                <p class="lead text-muted">
                    Découvrez et participez aux meilleurs événements de votre région.
                </p>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 text-center p-4">
                    <div class="display-6 mb-3">📂</div>
                    <h5 class="card-title">Catégories</h5>
                    <p class="card-text text-muted">Explorez les catégories d'événements</p>
                    <a href="{{ route('user.categories.index') }}" class="btn btn-primary mt-auto">
                        Voir les catégories
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 text-center p-4">
                    <div class="display-6 mb-3">📅</div>
                    <h5 class="card-title">Événements</h5>
                    <p class="card-text text-muted">Découvrez les événements à venir</p>
                    <a href="{{ route('user.events.index') }}" class="btn btn-primary mt-auto">
                        Voir les événements
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 text-center p-4">
                    <div class="display-6 mb-3">🎫</div>
                    <h5 class="card-title">Mes inscriptions</h5>
                    <p class="card-text text-muted">Gérez vos événements inscrits</p>
                    <a href="{{ route('user.my-events') }}" class="btn btn-primary mt-auto" disabled>
                        Bientôt disponible
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Events -->
        <div class="row mb-4">
            <div class="col-lg-10">
                <h3 class="fw-bold mb-4">✨ Événements en vedette</h3>
            </div>
        </div>

        <div class="row g-4">
            @php
                $featuredEvents = \App\Models\EventBw::where('status', 'published')
                    ->orderBy('start_date', 'asc')
                    ->limit(3)
                    ->get();
            @endphp

            @forelse($featuredEvents as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden event-card">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $event->title }}"
                                 style="height: 180px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 180px;">
                                <span class="text-muted">📷</span>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ Str::limit($event->title, 25) }}</h5>
                            <p class="text-muted small">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}
                            </p>
                            <p class="card-text small text-muted flex-grow-1">
                                {{ Str::limit($event->description, 80) }}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('user.events.show', $event->id) }}" 
                               class="btn btn-primary btn-sm w-100">
                                Voir
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Aucun événement disponible pour le moment.
                    </div>
                </div>
            @endforelse
        </div>

    @else
        <!-- Guest User Home -->
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-8">
                <h1 class="display-3 fw-bold mb-4">
                    🎉 Bienvenue sur Event Planner
                </h1>
                <p class="lead mb-4 text-muted">
                    Découvrez les meilleurs événements près de chez vous. Inscrivez-vous et ne manquez aucun événement !
                </p>

                <div class="d-flex gap-3">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right"></i> Se connecter
                    </a>
                    <a href="{{ route('users.register') }}" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-person-plus"></i> S'inscrire
                    </a>
                </div>

                <hr class="my-5">

                <div class="row g-4">
                    <div class="col-md-4">
                        <div>
                            <h5 class="fw-bold mb-2">🔍 Découvrez</h5>
                            <p class="text-muted">Explorez une large variété d'événements dans votre région.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <h5 class="fw-bold mb-2">📋 Inscrivez-vous</h5>
                            <p class="text-muted">Participez aux événements qui vous intéressent.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <h5 class="fw-bold mb-2">🎊 Profitez</h5>
                            <p class="text-muted">Vivez des expériences inoubliables avec notre communauté.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="display-1 mb-3">📅</div>
                <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" 
                     alt="Events" 
                     class="img-fluid rounded"
                     style="max-height: 400px; object-fit: cover;">
            </div>
        </div>
    @endauth
</div>

<style>
    .min-vh-75 {
        min-height: 75vh;
        display: flex;
        align-items: center;
    }

    .event-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }
</style>
@endsection
