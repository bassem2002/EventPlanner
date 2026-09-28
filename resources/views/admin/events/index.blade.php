@extends('layouts.admin')

@section('title', 'Events List')

@section('content')
<div class="events-list-wrapper">
    <div class="events-list-container">
        <!-- Header with title and add button -->
        <div class="events-header">
            <h1 class="page-title">Events List</h1>
            <a href="{{ route('admin.events.create') }}" class="add-event-btn">
                <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14m-7-7h14" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Add New Event
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="success-message">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 4L12 14.01l-3-3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="error-message">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 8v4m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Events Table -->
<div class="table-container">
    <table class="events-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Place</th>
                <th>Price</th>
                <th>Capacity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                <tr>
                    <td class="event-id">#{{ $event->id }}</td>
                    <td class="event-title">
                        <div class="title-wrapper">
                            @if($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="event-thumbnail">
                            @endif
                            <span>{{ Str::limit($event->title, 30) }}</span>
                        </div>
                    </td>
                    <td class="event-category">
                        <span class="category-badge" style="background-color: {{ $event->category->color ?? '#e2e8f0' }}">
                            {{ $event->category->name ?? '—' }}
                        </span>
                    </td>
                    <td class="event-date">
                        <div class="date-wrapper">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}
                        </div>
                    </td>
                    <td class="event-end-date">
                        <div class="date-wrapper">
                            {{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y') }}
                        </div>
                    </td>
                    <td class="event-place">
                        {{ $event->place ?? '—' }}
                    </td>
                    <td class="event-price">
                        @if($event->is_free)
                            Free
                        @else
                            ${{ number_format($event->price, 2) }}
                        @endif
                    </td>
                    <td class="event-capacity">
                        {{ $event->capacity ?? '—' }}
                    </td>
                    
                    <td class="event-actions">
                        <div class="action-buttons">
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="action-btn edit-btn" title="Edit">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="action-btn delete-btn" onclick="confirmDelete(this)" title="Delete">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </form>


                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="no-events">
                        <div class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <h3>No events found</h3>
                            <p>Start by creating your first event</p>
                            <a href="{{ route('admin.events.create') }}" class="empty-state-btn">
                                Create First Event
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

        <!-- Pagination -->
        @if($events->hasPages())
            <div class="pagination-container">
                {{ $events->links('vendor.pagination.custom') }}
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Confirm Delete</h3>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this event? This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <button class="btn-secondary cancel-btn">Cancel</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Delete Event</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .events-list-wrapper {
        padding: 30px 20px;
        background-color: #f8fafc;
        min-height: calc(100vh - 100px);
    }

    .events-list-container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 30px;
    }

    /* Header */
    .events-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .add-event-btn {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.25);
    }

    .add-event-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.35);
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
    }

    .add-event-btn .btn-icon {
        width: 18px;
        height: 18px;
    }

    /* Messages */
    .success-message, .error-message {
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
    }

    .success-message {
        background-color: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .success-message svg {
        width: 20px;
        height: 20px;
        stroke: #16a34a;
    }

    .error-message {
        background-color: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .error-message svg {
        width: 20px;
        height: 20px;
        stroke: #dc2626;
    }

    /* Table */
    .table-container {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .events-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    .events-table thead {
        background-color: #f8fafc;
    }

    .events-table th {
        padding: 16px 20px;
        text-align: left;
        font-size: 14px;
        font-weight: 600;
        color: #475569;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }

    .events-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.2s ease;
    }

    .events-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .events-table td {
        padding: 16px 20px;
        font-size: 14px;
        color: #334155;
        vertical-align: middle;
    }

    /* Event ID */
    .event-id {
        font-weight: 600;
        color: #64748b;
        font-family: 'SF Mono', 'Monaco', monospace;
    }

    /* Event Title */
    .title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .event-thumbnail {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
    }

    /* Category Badge */
    .category-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        color: #334155;
        background-color: #e2e8f0;
    }

    /* Date */
    .date-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .date-icon {
        width: 16px;
        height: 16px;
        color: #64748b;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-active {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-completed {
        background-color: #e0e7ff;
        color: #3730a3;
    }

    .status-cancelled {
        background-color: #fee2e2;
        color: #991b1b;
    }

    /* Actions */
    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        background: transparent;
    }

    .action-btn svg {
        width: 18px;
        height: 18px;
    }

    .edit-btn {
        color: #4a90e2;
        border: 1px solid #e2e8f0;
    }

    .edit-btn:hover {
        background-color: #eff6ff;
        border-color: #4a90e2;
        transform: translateY(-2px);
    }

    .delete-btn {
        color: #ef4444;
        border: 1px solid #fee2e2;
    }

    .delete-btn:hover {
        background-color: #fef2f2;
        border-color: #ef4444;
        transform: translateY(-2px);
    }

    .view-btn {
        color: #8b5cf6;
        border: 1px solid #e2e8f0;
    }

    .view-btn:hover {
        background-color: #f5f3ff;
        border-color: #8b5cf6;
        transform: translateY(-2px);
    }

    .delete-form {
        display: inline;
        margin: 0;
    }

    /* Empty State */
    .no-events {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state {
        max-width: 400px;
        margin: 0 auto;
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 20px;
        color: #334155;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #64748b;
        margin-bottom: 25px;
    }

    .empty-state-btn {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.25);
    }

    .empty-state-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.35);
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
    }

    /* Pagination */
    .pagination-container {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h3 {
        margin: 0;
        color: #1e293b;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #64748b;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .modal-close:hover {
        background-color: #f1f5f9;
    }

    .modal-body {
        padding: 20px;
        color: #475569;
    }

    .modal-footer {
        padding: 20px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn-secondary, .btn-danger {
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-secondary {
        background-color: #f1f5f9;
        color: #475569;
    }

    .btn-secondary:hover {
        background-color: #e2e8f0;
    }

    .btn-danger {
        background-color: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background-color: #dc2626;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .events-list-container {
            padding: 20px;
        }

        .events-header {
            flex-direction: column;
            align-items: stretch;
        }

        .page-title {
            font-size: 24px;
            text-align: center;
        }

        .add-event-btn {
            justify-content: center;
        }

        .events-table th,
        .events-table td {
            padding: 12px 15px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-btn {
            width: 32px;
            height: 32px;
        }
    }

    @media (max-width: 480px) {
        .events-table {
            display: block;
        }

        .events-table thead {
            display: none;
        }

        .events-table tbody tr {
            display: block;
            margin-bottom: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
        }

        .events-table td {
            display: block;
            padding: 8px 0;
            border: none;
        }

        .events-table td:before {
            content: attr(data-label);
            font-weight: 600;
            color: #64748b;
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
        }

        .action-buttons {
            flex-direction: row;
            justify-content: flex-end;
            margin-top: 10px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function confirmDelete(button) {
        const modal = document.getElementById('deleteModal');
        const form = button.closest('form');
        const deleteForm = document.getElementById('deleteForm');
        
        // Set form action
        deleteForm.action = form.action;
        
        // Show modal
        modal.style.display = 'flex';
    }

    // Close modal
    document.querySelector('.modal-close').addEventListener('click', function() {
        document.getElementById('deleteModal').style.display = 'none';
    });

    document.querySelector('.cancel-btn').addEventListener('click', function() {
        document.getElementById('deleteModal').style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Responsive table labels
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.querySelector('.events-table');
        if (window.innerWidth <= 480) {
            const headers = Array.from(table.querySelectorAll('th')).map(th => th.textContent);
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach((cell, index) => {
                    if (headers[index]) {
                        cell.setAttribute('data-label', headers[index]);
                    }
                });
            });
        }
    });

    // Reset modal when closed
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
</script>
@endpush