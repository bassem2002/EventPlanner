@extends('layouts.user')

@section('content')

<style>
/* =======================
   PAGE CONTAINER
======================= */
.user-container {
    max-width: 1200px;
    margin: auto;
}

/* =======================
   HEADER
======================= */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.page-title {
    font-size: 28px;
    font-weight: 700;
}

.page-subtitle {
    color: #777;
}

/* =======================
   TABLE
======================= */
.table-wrapper {
    overflow-x: auto;
}

.events-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.events-table th,
.events-table td {
    padding: 14px;
    border-bottom: 1px solid #eee;
    text-align: left;
}

.events-table th {
    background: #f4f4f4;
    font-weight: 600;
}

.events-table tr:hover {
    background: #fafafa;
}

/* =======================
   STATUS
======================= */
.status {
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
}

.status-approved {
    background: #e6f7ee;
    color: #1e7f4f;
}

.status-pending {
    background: #fff5e6;
    color: #b36b00;
}

.status-rejected {
    background: #fdecea;
    color: #b91c1c;
}

/* =======================
   BUTTONS
======================= */
.btn-blue {
    background: #4f46e5;
    color: white;
    padding: 10px 18px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
}

.btn-blue:hover {
    background: #4338ca;
}

.btn-red {
    background: #dc2626;
    color: white;
    padding: 10px 18px;
    border-radius: 6px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}

.btn-red:hover {
    background: #b91c1c;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 14px;
}

.actions-cell {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

/* =======================
   EMPTY STATE
======================= */
.empty-box {
    background: white;
    padding: 40px;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}
</style>

<div class="user-container">

    <!-- HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">📅 Mes Événements</h1>
            <p class="page-subtitle">Tous les événements auxquels vous êtes inscrit</p>
        </div>

        <a href="{{ route('user.events.index') }}" class="btn-blue">
            Parcourir les événements
        </a>
    </div>

    <!-- EVENTS TABLE -->
    @if($registrations->count() > 0)

        <div class="table-wrapper">
            <table class="events-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Organisateur</th>
                        <th>Tarif</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($registrations as $registration)
                        @php $event = $registration->event; @endphp

                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->category->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}</td>
                            <td>{{ $event->place }}</td>
                            <td>{{ $event->creator->name ?? 'Inconnu' }}</td>
                            <td>
                                {{ $event->is_free ? 'Gratuit 🎉' : number_format($event->price,2,',',' ') . ' €' }}
                            </td>

                            @php
                                $statusClass = match($event->status) {
                                    'approved' => 'status-approved',
                                    'pending' => 'status-pending',
                                    'rejected' => 'status-rejected',
                                    default => ''
                                };
                            @endphp

                            <td>
                                <span class="status {{ $statusClass }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>

                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('user.events.show', $event->id) }}" class="btn-blue btn-sm">
                                        Voir
                                    </a>
                                    <form action="{{ route('user.registrations.destroy', $registration->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir vous désinscrire de cet événement ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-red btn-sm">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $registrations->links() }}

    @else
        <div class="empty-box">
            <h2>😕 Aucun événement</h2>
            <p>Vous n'êtes inscrit à aucun événement.</p>
            <br>
            <a href="{{ route('user.events.index') }}" class="btn-blue">
                Découvrir les événements
            </a>
        </div>
    @endif

</div>
@endsection
