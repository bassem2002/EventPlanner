@extends('layouts.user')

@section('title', 'Catégories - Event Planner')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold">📚 Catégories d'Événements</h1>
            <p class="lead text-muted">Explorez les différentes catégories d'événements disponibles</p>
        </div>
    </div>

    @if($categories->isEmpty())
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Aucune catégorie disponible</h4>
            <p>Il n'y a pas de catégories d'événements pour le moment. Veuillez réessayer plus tard.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 hover-shadow transition-all" style="cursor: pointer;">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="fs-3">🏷️</div>
                                <h5 class="card-title mb-0 ms-2">{{ $category->name }}</h5>
                            </div>
                            
                            <p class="text-muted mb-3">
                                <small>
                                    <i class="bi bi-calendar-event"></i>
                                    {{ $category->events->count() }} événement(s)
                                </small>
                            </p>

                            @if($category->events->count() > 0)
                                <div class="mb-3">
                                    <small class="text-muted">Événements à venir:</small>
                                    <ul class="list-unstyled small">
                                        @foreach($category->events->take(3) as $event)
                                            <li class="text-truncate">
                                                • {{ $event->title }}
                                            </li>
                                        @endforeach
                                        @if($category->events->count() > 3)
                                            <li class="text-muted">...et {{ $category->events->count() - 3 }} autre(s)</li>
                                        @endif
                                    </ul>
                                </div>
                            @else
                                <p class="text-muted small">Aucun événement dans cette catégorie</p>
                            @endif
                        </div>
                        
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('user.categories.show', $category->id) }}" 
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
                {{ $categories->links() }}
            </div>
        </div>
    @endif
</div>

<style>
    .hover-shadow {
        transition: box-shadow 0.3s ease;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }
    
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection
