@extends('layouts.admin')

@push('styles')
<style>
    /* ==========================
       Variables de couleurs
       ========================== */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --info-color: #3b82f6;
        --text-color: #374151;
        --text-light: #6b7280;
        --bg-gray: #f3f4f6;
    }

    /* ==========================
       Layout principal
       ========================== */
    body {
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        background: var(--bg-gray);
        color: var(--text-color);
    }

    .min-h-screen-container {
        background: var(--secondary-gradient);
        min-height: 100vh;
        padding: 3rem 1rem;
        position: relative;
        overflow-x: hidden;
    }

    .max-w-7xl {
        max-width: 1280px;
        margin: 0 auto;
        position: relative;
        z-index: 10;
    }

    /* ==========================
       Header
       ========================== */
    .page-header {
        margin-bottom: 3rem;
        position: relative;
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
        position: relative;
    }

    .page-header h1::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    /* ==========================
       Grid
       ========================== */
    .grid {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .grid-cols-1 {
        flex-direction: column;
    }

    .grid-cols-3 {
        flex-direction: row;
    }

    .flex-1 {
        flex: 1;
    }

    .flex {
        display: flex;
        align-items: center;
    }

    .items-end {
        align-items: flex-end;
    }

    .gap-3 {
        gap: 1rem;
    }

    .mb-10 {
        margin-bottom: 2.5rem;
    }

    /* ==========================
       Cartes statistiques
       ========================== */
    .stat-card-compact {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05), 0 10px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .stat-card-compact::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        border-radius: 16px 16px 0 0;
    }

    .stat-card-compact:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px rgba(0,0,0,0.1);
        border-color: rgba(102,126,234,0.3);
    }

    .icon-container {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .stat-card-compact svg {
        width: 24px;
        height: 24px;
    }

    .text-xs {
        font-size: 0.75rem;
        color: var(--text-light);
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .text-lg {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #374151 0%, #111827 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* ==========================
       Flash messages
       ========================== */
    .flash-message {
        border-radius: 16px;
        padding: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.5rem;
        animation: slideDown 0.4s ease;
        border-left: 6px solid;
        backdrop-filter: blur(10px);
    }

    .flash-message svg {
        flex-shrink: 0;
        width: 24px;
        height: 24px;
    }

    .flash-message p {
        margin: 0;
        line-height: 1.4;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .bg-red-50 { background-color: #fef2f2; border-color: #ef4444; color: #b91c1c; }
    .bg-green-50 { background-color: #ecfdf5; border-color: #10b981; color: #065f46; }

    /* ==========================
       Filtres
       ========================== */
    .filter-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2.5rem;
        border: 1px solid rgba(255,255,255,0.2);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    .input-field {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .input-field:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.1);
        background-color: white;
    }

    /* ==========================
       Boutons
       ========================== */
    .btn-gradient {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        font-size: 0.95rem;
        border-radius: 12px;
        background: var(--primary-gradient);
        color: white;
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102,126,234,0.4);
    }

    .btn-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1.5rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        background: transparent;
        color: #4b5563;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .btn-outline:hover {
        background: #f9fafb;
        border-color: #667eea;
        color: #667eea;
        transform: translateY(-2px);
    }

    /* ==========================
       Table
       ========================== */
    .table-container {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        overflow-x: auto;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,255,255,0.2);
        margin-bottom: 2rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 1.25rem 1.5rem;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }

    th {
        font-weight: 700;
        font-size: 0.75rem;
        color: #475569;
        text-transform: uppercase;
    }

    .category-badge {
        display: inline-block;
        padding: 0.375rem 0.875rem;
        border-radius: 9999px;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
        font-weight: 600;
        font-size: 0.75rem;
        border: 2px solid rgba(59,130,246,0.2);
    }

    /* ==========================
       Pagination
       ========================== */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin: 1.5rem 0;
    }

    .pagination li {
        display: inline-block;
        margin: 0 0.25rem;
    }

    .pagination li a, .pagination li span {
        display: inline-block;
        padding: 0.5rem 0.75rem;
        background: #f0f4ff;
        color: #667eea;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }

    .pagination li.active span {
        background: var(--primary-gradient);
        color: white;
    }

    /* ==========================
       Empty State
       ========================== */
    .empty-state {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 4rem 2rem;
        text-align: center;
        border: 2px dashed rgba(102,126,234,0.3);
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        color: #9ca3af;
        opacity: 0.6;
    }

</style>
@endpush

@section('content')

<div class="min-h-screen-container">
    <div class="max-w-7xl">

        <!-- Header -->
        <div class="page-header">
            <h1>List of registrations</h1>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-3 mb-10">
            <div class="stat-card-compact">
                <div class="icon-container">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs">Total Inscriptions</p>
                    <p class="text-lg">{{ $totalRegistrations }}</p>
                </div>
            </div>

            <div class="stat-card-compact">
                <div class="icon-container">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs">Utilisateurs Actifs</p>
                    <p class="text-lg">{{ $totalUsers }}</p>
                </div>
            </div>

            <div class="stat-card-compact">
                <div class="icon-container">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs">Affichage Page</p>
                    <p class="text-lg">{{ $registrations->count() }}/{{ $registrations->total() }}</p>
                </div>
            </div>
        </div>

        <!-- Tableau -->
        @if($registrations->count() > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Event title</th>
                        <th>Start date</th>
                        <th>User's email</th>
                        <th>User's name</th>
                        <th>Category</th>
                        <th>Date Inscription</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $registration)
                    <tr>
                        <td>{{ $registration->event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($registration->event->start_date)->format('d/m/Y, H:i') }}</td>
                        <td>{{ $registration->user->email }}</td>
                        <td>{{ $registration->user->name }}</td>
                        <td>
                            @if($registration->event->category)
                                <span class="category-badge">{{ $registration->event->category->name }}</span>
                            @else
                                <span style="color:#6b7280;font-style:italic;">Aucune catégorie</span>
                            @endif
                        </td>
                        <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-container">
                {{ $registrations->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3>Aucune inscription trouvée</h3>
            <p>Aucune inscription ne correspond à votre recherche. Essayez de modifier vos filtres ou consultez d'autres événements.</p>
            <div style="margin-top:1.5rem;">
                <a href="{{ route('admin.users.registrations.index') }}" class="btn-gradient">Voir toutes les inscriptions</a>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
