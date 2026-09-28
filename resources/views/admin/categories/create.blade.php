@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<div class="category-create-wrapper">
    <div class="category-create-container">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="category-form">
            @csrf
            
            <!-- Titre centré -->
            <h1 class="page-title">Add New Category</h1>
            
            <!-- Category Name -->
            <div class="form-group">
                <label class="form-label">Category Name</label>
                <input type="text" id="name" name="name" class="form-input" 
                       placeholder="Ex: Conferences, Sports, Music..." 
                       value="{{ old('name') }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Buttons -->
            <div class="form-actions">
                <button type="submit" class="submit-button">
                    <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Save Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="cancel-button">
                    <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .category-create-wrapper {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: calc(100vh - 100px);
        padding: 30px 20px;
        background-color: #f8fafc;
    }
    
    .category-create-container {
        width: 100%;
        max-width: 600px;
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 40px;
        margin: 0 auto;
    }
    
    /* Titre centré */
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        position: relative;
    }
    
    .page-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #8b5cf6, #7c3aed);
        border-radius: 2px;
    }
    
    /* Form structure */
    .form-group {
        margin-bottom: 30px;
    }
    
    .form-label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #334155;
    }
    
    /* Inputs */
    .form-input {
        width: 100%;
        padding: 14px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 15px;
        color: #334155;
        background-color: #fff;
        transition: all 0.25s ease;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
    }
    
    .form-input::placeholder {
        color: #94a3b8;
    }
    
    /* Buttons */
    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid #f1f5f9;
    }
    
    .submit-button {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 16px 40px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 0.3px;
        min-width: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.25);
    }
    
    .submit-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.35);
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
    }
    
    .submit-button:active {
        transform: translateY(-1px);
    }
    
    .submit-button .btn-icon {
        width: 20px;
        height: 20px;
        stroke: white;
    }
    
    .cancel-button {
        background: #f1f5f9;
        color: #64748b;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 40px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        min-width: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
    .cancel-button:hover {
        background: #e2e8f0;
        color: #475569;
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .cancel-button .btn-icon {
        width: 20px;
        height: 20px;
        stroke: #64748b;
    }
    
    /* Error styles */
    .error-message {
        color: #ef4444;
        font-size: 13px;
        margin-top: 6px;
        padding-left: 5px;
        display: block;
        font-weight: 500;
    }
    
    .form-input.has-error {
        border-color: #ef4444;
        background-color: #fef2f2;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .category-create-container {
            padding: 30px 20px;
        }
        
        .page-title {
            font-size: 24px;
            margin-bottom: 30px;
        }
        
        .form-actions {
            flex-direction: column;
            gap: 15px;
        }
        
        .submit-button,
        .cancel-button {
            width: 100%;
            min-width: 0;
            padding: 16px 30px;
        }
    }
    
    @media (max-width: 480px) {
        .category-create-wrapper {
            padding: 20px 15px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add error class to inputs with errors
        const errorElements = document.querySelectorAll('.error-message');
        errorElements.forEach(error => {
            if (error.textContent.trim() !== '') {
                const inputGroup = error.closest('.form-group');
                if (inputGroup) {
                    const input = inputGroup.querySelector('.form-input');
                    if (input) {
                        input.classList.add('has-error');
                    }
                }
            }
        });
        
        // Auto-focus on name input
        const nameInput = document.getElementById('name');
        if (nameInput) {
            nameInput.focus();
        }
    });
</script>
@endpush