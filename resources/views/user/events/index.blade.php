@extends('layouts.user')

@section('title', 'Événements - Event Planner')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-10">
            <h1 class="display-4 fw-bold">📅 Tous les Événements</h1>
            <p class="lead text-muted">Découvrez les événements à venir</p>
        </div>
    </div>

    @if($events->isEmpty())
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Aucun événement disponible</h4>
            <p>Il n'y a pas d'événements publiés pour le moment. Veuillez réessayer plus tard.</p>
        </div>
    @else
        <!-- Events Grid -->
        <div class="row g-4">
            @foreach($events as $event)
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

                        <!-- Badge Status -->
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-primary">{{ $event->status }}</span>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <!-- Category -->
                            <div class="mb-2">
                                <a href="{{ route('user.categories.show', $event->category_id) }}" 
                                   class="badge bg-secondary text-decoration-none">
                                    {{ $event->category->name }}
                                </a>
                            </div>

                            <h5 class="card-title">{{ $event->title }}</h5>
                            
                            <!-- Date & Time -->
                            <p class="text-muted small mb-2">
                                <i class="bi bi-calendar-event"></i>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y à H:i') }}
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

                            <!-- Price & Capacity -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    @if($event->is_free)
                                        <span class="badge bg-success">Gratuit</span>
                                    @else
                                        <span class="badge bg-primary">{{ number_format($event->price, 2) }}€</span>
                                    @endif
                                </div>
                                <div class="col-6 text-end">
                                    <small class="text-muted">
                                        {{ $event->registrations->count() }} / {{ $event->capacity }}
                                    </small>
                                </div>
                            </div>

                            <!-- Organizer -->
                            <p class="text-muted small">
                                <i class="bi bi-person"></i>
                                Organisé par {{ $event->creator->name }}
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

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                {{ $events->links() }}
            </div>
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
