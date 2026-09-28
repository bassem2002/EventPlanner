@extends('layouts.user')

@section('title', $event->title . ' - Event Planner')

@section('content')
<div class="container py-5">
    <!-- Navigation & Header -->
    <div class="row mb-4">
        <div class="col-lg-10">
            <a href="{{ route('user.events.index') }}" class="btn btn-link text-decoration-none">
                ← Retour aux événements
            </a>
        </div>
    </div>

    <!-- Event Details -->
    <div class="row g-4">
        <!-- Main Content (Left) -->
        <div class="col-lg-8">
            <!-- Event Image -->
            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" 
                     alt="{{ $event->title }}"
                     class="img-fluid rounded mb-4"
                     style="height: 400px; object-fit: cover; width: 100%;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded mb-4" 
                     style="height: 400px;">
                    <span class="text-muted display-6">📷 Pas d'image</span>
                </div>
            @endif

            <!-- Title & Meta -->
            <div class="mb-4">
                <h1 class="display-5 fw-bold mb-3">{{ $event->title }}</h1>
                
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <a href="{{ route('user.categories.show', $event->category_id) }}" 
                       class="badge bg-primary text-decoration-none">
                        {{ $event->category->name }}
                    </a>
                    <span class="badge bg-{{ $event->status === 'published' ? 'success' : 'warning' }}">
                        {{ $event->status }}
                    </span>
                </div>

                <!-- Event Key Info -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-calendar-event text-primary me-3 fs-5"></i>
                            <div>
                                <small class="text-muted">Date</small>
                                <p class="mb-0 fw-semibold">
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-geo-alt text-primary me-3 fs-5"></i>
                            <div>
                                <small class="text-muted">Lieu</small>
                                <p class="mb-0 fw-semibold">{{ $event->place }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-tag text-primary me-3 fs-5"></i>
                            <div>
                                <small class="text-muted">Tarif</small>
                                <p class="mb-0 fw-semibold">
                                    @if($event->is_free)
                                        <span class="badge bg-success">Gratuit</span>
                                    @else
                                        {{ number_format($event->price, 2) }}€
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-people text-primary me-3 fs-5"></i>
                            <div>
                                <small class="text-muted">Participants</small>
                                <p class="mb-0 fw-semibold">
                                    {{ $event->registrations->count() }} / {{ $event->capacity }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <h3 class="fw-bold mb-3">À propos de l'événement</h3>
                <p class="lead">{{ $event->description }}</p>
            </div>

            <!-- Organizer Info -->
            <div class="card border-light mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">👤 Organisateur</h5>
                    <p class="mb-0">
                        <strong>{{ $event->creator->name }}</strong><br>
                        <small class="text-muted">{{ $event->creator->email }}</small>
                    </p>
                </div>
            </div>
        </div>

        <!-- Sidebar (Right) -->
        <div class="col-lg-4">
            <!-- Registration Card -->
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                <div class="card-body">
                    @if($event->registrations->count() >= $event->capacity)
                        <!-- Event Full -->
                        <div class="alert alert-warning mb-0">
                            <h5 class="alert-heading">⚠️ Événement complet</h5>
                            <p class="mb-0">Malheureusement, cet événement n'a plus de places disponibles.</p>
                        </div>
                    @elseif($isRegistered)
                        <!-- Already Registered -->
                        <div class="alert alert-success mb-0">
                            <h5 class="alert-heading">✅ Vous êtes inscrit</h5>
                            <p class="mb-0">Vous êtes enregistré pour cet événement.</p>
                        </div>
                    @else
                        <!-- Registration Form -->
                        <h5 class="card-title mb-4">Vous êtes intéressé ?</h5>
                        <form action="{{ route('user.events.register', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                S'inscrire à l'événement
                            </button>
                        </form>
                        <p class="text-muted small text-center">
                            Places disponibles: {{ $event->capacity - $event->registrations->count() }}
                        </p>
                    @endif

                    <hr>

                    <!-- Event Status -->
                    <div class="mb-3">
                        <small class="text-muted">Statut</small>
                        <p class="mb-0">
                            <span class="badge bg-{{ $event->status === 'published' ? 'success' : 'warning' }}">
                                {{ ucfirst($event->status) }}
                            </span>
                        </p>
                    </div>

                    <!-- Event Duration -->
                    <div class="mb-3">
                        <small class="text-muted">Durée</small>
                        <p class="mb-0">
                            {{ \Carbon\Carbon::parse($event->start_date)->diffInHours(\Carbon\Carbon::parse($event->end_date)) }} heures
                        </p>
                    </div>

                    <!-- Share Section -->
                    <div class="pt-3 border-top">
                        <small class="text-muted d-block mb-2">Partager</small>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('user.events.show', $event->id)) }}" 
                               target="_blank" class="btn btn-sm btn-outline-primary">
                                f
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('user.events.show', $event->id)) }}&text={{ urlencode($event->title) }}" 
                               target="_blank" class="btn btn-sm btn-outline-primary">
                                𝕏
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
