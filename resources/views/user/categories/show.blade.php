@extends('layouts.user')

@section('title', $category->name . ' - Event Planner')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('user.categories.index') }}" class="btn btn-link text-decoration-none">
                    ← Retour aux catégories
                </a>
            </div>
            <h1 class="display-4 fw-bold">🏷️ {{ $category->name }}</h1>
            <p class="lead text-muted">Tous les événements de cette catégorie</p>
        </div>
    </div>

    @if($category->events->isEmpty())
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Aucun événement</h4>
            <p>Il n'y a pas d'événements dans cette catégorie pour le moment.</p>
        </div>
    @else
        <!-- Events Grid -->
        <div class="row g-4">
            @foreach($category->events as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden event-card">
                        <!-- Event Image -->
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $event->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <span class="text-muted">📷 Pas d'image</span>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            
                            <!-- Date & Time -->
                            <p class="text-muted small mb-2">
                                <i class="bi bi-calendar-event"></i>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}
                            </p>

                            <!-- Location -->
                            <p class="text-muted small mb-2">
                                <i class="bi bi-geo-alt"></i>
                                {{ $event->place }}
                            </p>

                            <!-- Description -->
                            <p class="card-text small flex-grow-1">
                                {{ Str::limit($event->description, 100) }}
                            </p>

                            <!-- Price Info -->
                            <div class="mb-3">
                                @if($event->is_free)
                                    <span class="badge bg-success">Gratuit</span>
                                @else
                                    <span class="badge bg-primary">{{ number_format($event->price, 2) }}€</span>
                                @endif
                            </div>

                            <!-- Capacity -->
                            <p class="text-muted small">
                                <i class="bi bi-people"></i>
                                {{ $event->registrations->count() }} / {{ $event->capacity }} inscrits
                            </p>
                        </div>

                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('user.events.show', $event->id) }}" 
                               class="btn btn-primary btn-sm w-100">
                                Voir les détails
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .event-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }
</style>
@endsection
