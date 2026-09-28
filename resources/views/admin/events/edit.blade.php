@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
<div class="create-event-wrapper">
    <div class="create-event-container">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="event-form">
            @csrf
            @method('PUT')
            
            <!-- Titre centré -->
            <h1 class="page-title">Edit Event</h1>
            
            <!-- Event Title -->
            <div class="form-group">
                <label class="form-label">Event Title</label>
                <input type="text" name="title" class="form-input" placeholder="Enter event title" value="{{ old('title', $event->title) }}" required>
                @error('title')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Category -->
            <div class="form-group">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Start date et End date -->
            <div class="form-row">
                <div class="form-group half">
                    <label class="form-label">Start date & time</label>
                    <input type="datetime-local" name="start_date" class="form-input" 
                           value="{{ old('start_date', \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i')) }}" required>
                    @error('start_date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group half">
                    <label class="form-label">End date & time</label>
                    <input type="datetime-local" name="end_date" class="form-input" 
                           value="{{ old('end_date', \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i')) }}" required>
                    @error('end_date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <!-- Place et Capacity -->
            <div class="form-row">
                <div class="form-group half">
                    <label class="form-label">Place</label>
                    <input type="text" name="place" class="form-input" placeholder="Enter place" value="{{ old('place', $event->place) }}" required>
                    @error('place')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group half">
                    <label class="form-label">Capacity</label>
                    <input type="number" name="capacity" class="form-input" placeholder="Enter capacity" value="{{ old('capacity', $event->capacity) }}" min="1">
                    @error('capacity')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <!-- Pricing options -->
            <div class="form-group">
                <label class="form-label">Pricing Type</label>
                <div class="pricing-options">
                    <label class="radio-option">
                        <input type="radio" name="is_free" value="1" {{ old('is_free', $event->is_free) == 1 ? 'checked' : '' }}>
                        <span class="radio-custom"></span>
                        <span class="radio-text">Free Access</span>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="is_free" value="0" {{ old('is_free', $event->is_free) == 0 ? 'checked' : '' }}>
                        <span class="radio-custom"></span>
                        <span class="radio-text">Premium</span>
                    </label>
                </div>
            </div>
            
            <!-- Amount -->
            <div class="form-group">
                <label class="form-label">Amount ($)</label>
                <input type="number" name="price" class="form-input amount-input" placeholder="0.00" step="0.01" min="0" 
                       value="{{ old('price', $event->price) }}">
                @error('price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Event Image -->
            <div class="form-group">
                <label class="form-label">Event Image</label>
                <div class="image-upload">
                    <input type="file" name="image" id="image" class="file-input" accept="image/*">
                    <div class="image-placeholder">
                        @if($event->image)
                            <div style="text-align: center;">
                                <img src="{{ Storage::url($event->image) }}" alt="Current image" style="max-width: 100%; max-height: 180px; border-radius: 8px; margin-bottom: 15px; border: 1px solid #e2e8f0;">
                                <div style="color: #94a3b8; font-size: 13px;">Current image - Upload new to replace</div>
                            </div>
                        @else
                            <div class="upload-icon">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                            </div>
                            <div class="upload-text">Click to upload new event image</div>
                            <div class="upload-hint">PNG, JPG, GIF up to 5MB</div>
                        @endif
                    </div>
                    @error('image')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <!-- Event Description -->
            <div class="form-group">
                <label class="form-label">Event Description</label>
                <textarea name="description" class="form-textarea" placeholder="Type event description here...">{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Buttons -->
            <!-- Buttons -->
<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Update Event
    </button>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
        <i class="fas fa-times"></i> Cancel
    </a>
</div>

        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .create-event-wrapper {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: calc(100vh - 100px);
        padding: 30px 20px;
        background-color: #f8fafc;
    }
    
    .create-event-container {
        width: 100%;
        max-width: 800px;
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 40px;
        margin: 0 auto;
    }
    
    /* Titre centré */
    .page-title {
        font-size: 32px;
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
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #4a90e2, #357abd);
        border-radius: 2px;
    }
    
    /* Structure des sections */
    .form-group {
        margin-bottom: 30px;
        width: 100%;
    }
    
    .form-row {
        display: flex;
        gap: 25px;
        margin-bottom: 30px;
    }
    
    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 20px;
        }
        
        .form-group.half {
            width: 100% !important;
        }
    }
    
    .form-group.half {
        width: calc(50% - 12.5px);
        flex: 1;
    }
    
    .form-label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #334155;
    }
    
    /* Inputs standards */
    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 15px;
        color: #334155;
        background-color: #fff;
        transition: all 0.25s ease;
        font-family: inherit;
    }
    
    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #4a90e2;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.15);
    }
    
    .form-input::placeholder {
        color: #94a3b8;
    }
    
    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23334155' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 45px;
        cursor: pointer;
        background-color: #f8fafc;
    }
    
    /* Radio buttons */
    .pricing-options {
        display: flex;
        gap: 25px;
        margin-top: 5px;
    }
    
    .radio-option {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 15px;
        padding: 12px 20px;
        border-radius: 10px;
        border: 1.5px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.25s ease;
        flex: 1;
    }
    
    .radio-option:hover {
        border-color: #cbd5e1;
        background-color: #f1f5f9;
    }
    
    .radio-option input[type="radio"] {
        display: none;
    }
    
    .radio-option input[type="radio"]:checked + .radio-custom {
        border-color: #4a90e2;
        background-color: #4a90e2;
    }
    
    .radio-custom {
        width: 20px;
        height: 20px;
        border: 2px solid #cbd5e1;
        border-radius: 50%;
        margin-right: 12px;
        position: relative;
        transition: all 0.25s ease;
        flex-shrink: 0;
    }
    
    .radio-option input[type="radio"]:checked + .radio-custom::after {
        content: '';
        width: 8px;
        height: 8px;
        background-color: white;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    .radio-text {
        color: #334155;
        font-weight: 500;
    }
    
    .radio-option input[type="radio"]:checked ~ .radio-text {
        color: #4a90e2;
        font-weight: 600;
    }
    
    .radio-option input[type="radio"]:checked {
        border-color: #4a90e2;
        background-color: rgba(74, 144, 226, 0.05);
    }
    
    /* Amount input */
    .amount-input {
        text-align: right;
        font-weight: 500;
        background-color: #f8fafc;
    }
    
    /* Event Image Section */
    .image-upload {
        position: relative;
        margin-top: 5px;
    }
    
    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }
    
    .image-placeholder {
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 50px 20px;
        text-align: center;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }
    
    .image-upload:hover .image-placeholder {
        border-color: #4a90e2;
        background-color: rgba(74, 144, 226, 0.05);
    }
    
    .upload-icon {
        margin-bottom: 15px;
        color: #64748b;
    }
    
    .upload-icon svg {
        stroke: #64748b;
    }
    
    .upload-text {
        color: #334155;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .upload-hint {
        color: #94a3b8;
        font-size: 14px;
    }
    
    /* Event Description */
    .form-textarea {
        min-height: 180px;
        resize: vertical;
        line-height: 1.6;
        background-color: #f8fafc;
    }
    
    /* Form Actions Container */
.form-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    align-items: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #eaeaea;
}

/* Primary Button (Update/Submit) */
.form-actions .btn-primary {
    background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 16px 45px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    letter-spacing: 0.3px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(74, 144, 226, 0.25);
    min-width: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.form-actions .btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
}

.form-actions .btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(74, 144, 226, 0.4);
    background: linear-gradient(135deg, #357abd 0%, #2a5fa3 100%);
}

.form-actions .btn-primary:hover::before {
    left: 100%;
}

.form-actions .btn-primary:active {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
}

.form-actions .btn-primary:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.3);
}

/* Secondary Button (Cancel) */
.form-actions .btn-secondary {
    background: white;
    color: #64748b;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px 40px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    letter-spacing: 0.3px;
    text-decoration: none;
    min-width: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.form-actions .btn-secondary:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #475569;
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.form-actions .btn-secondary:active {
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.form-actions .btn-secondary:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(203, 213, 225, 0.5);
}

/* Icon in buttons */
.form-actions .btn-icon {
    width: 18px;
    height: 18px;
    display: inline-block;
}

.btn-primary .btn-icon {
    filter: brightness(0) invert(1);
}

/* Button with icon only variant */
.form-actions .btn-icon-only {
    width: 50px;
    height: 50px;
    padding: 0;
    min-width: auto;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Success button variant */
.form-actions .btn-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
}

.form-actions .btn-success:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
}

/* Danger button variant */
.form-actions .btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.25);
}

.form-actions .btn-danger:hover {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
}

/* Outline button variant */
.form-actions .btn-outline {
    background: transparent;
    color: #4a90e2;
    border: 2px solid #4a90e2;
}

.form-actions .btn-outline:hover {
    background: rgba(74, 144, 226, 0.05);
    color: #357abd;
    border-color: #357abd;
}

/* Disabled state */
.form-actions .btn-primary:disabled,
.form-actions .btn-secondary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
}

/* Loading state */
.form-actions .btn-loading {
    position: relative;
    color: transparent !important;
}

.form-actions .btn-loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .form-actions {
        flex-direction: column;
        gap: 15px;
    }
    
    .form-actions .btn-primary,
    .form-actions .btn-secondary {
        width: 100%;
        max-width: 300px;
        padding: 16px 30px;
    }
    
    .form-actions .btn-icon-only {
        width: 60px;
        height: 60px;
    }
}

@media (max-width: 480px) {
    .form-actions .btn-primary,
    .form-actions .btn-secondary {
        padding: 14px 25px;
        font-size: 15px;
    }
}
    
   
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion de l'affichage du champ prix
        const freeRadio = document.querySelector('input[name="is_free"][value="1"]');
        const premiumRadio = document.querySelector('input[name="is_free"][value="0"]');
        const priceInput = document.querySelector('.amount-input');
        
        function updatePriceInput() {
            if (premiumRadio.checked) {
                priceInput.style.display = 'block';
                priceInput.required = true;
            } else {
                priceInput.style.display = 'none';
                priceInput.required = false;
                priceInput.value = '0';
            }
        }
        
        freeRadio.addEventListener('change', updatePriceInput);
        premiumRadio.addEventListener('change', updatePriceInput);
        
        // Initialiser l'affichage
        updatePriceInput();
        
        // Prévisualisation de l'image
        const imageInput = document.getElementById('image');
        const imagePlaceholder = document.querySelector('.image-placeholder');
        
        imageInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                
                // Validation de la taille (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    this.value = '';
                    return;
                }
                
                // Validation du type
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    alert('Only JPG, PNG and GIF images are allowed');
                    this.value = '';
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePlaceholder.innerHTML = `
                        <div style="text-align: center;">
                            <img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 180px; border-radius: 8px; margin-bottom: 15px; border: 1px solid #e2e8f0;">
                            <div style="color: #334155; font-size: 14px; font-weight: 500;">${file.name}</div>
                            <div style="color: #94a3b8; font-size: 13px; margin-top: 5px;">${(file.size / 1024 / 1024).toFixed(2)} MB</div>
                            <div style="color: #64748b; font-size: 12px; margin-top: 5px; font-style: italic;">Will replace current image</div>
                        </div>
                    `;
                }
                
                reader.readAsDataURL(file);
            }
        });
        
        // Validation des dates
        const startDateInput = document.querySelector('input[name="start_date"]');
        const endDateInput = document.querySelector('input[name="end_date"]');
        
        function validateDates() {
            if (startDateInput.value && endDateInput.value) {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);
                
                if (endDate < startDate) {
                    alert('End date must be after start date');
                    endDateInput.value = '';
                    endDateInput.focus();
                }
            }
        }
        
        startDateInput.addEventListener('change', validateDates);
        endDateInput.addEventListener('change', validateDates);
        
        // Ajouter la classe 'has-error' aux champs avec erreur
        const errorElements = document.querySelectorAll('.error-message');
        errorElements.forEach(error => {
            if (error.textContent.trim() !== '') {
                const inputGroup = error.closest('.form-group');
                if (inputGroup) {
                    const input = inputGroup.querySelector('.form-input, .form-select, .form-textarea');
                    if (input) {
                        input.classList.add('has-error');
                    }
                }
            }
        });
    });
</script>
@endpush