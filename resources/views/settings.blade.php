@extends('layouts.app')

@section('content')
    <!-- Render the Livewire component for settings management -->
    <livewire:settings-manager />
@endsection

@push('scripts')
    <!-- Include Alpine.js if not already included in the layout -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Include CodeMirror for JSON editing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js"></script>
    
    <!-- Custom styles for enhanced UI -->
    <style>
        /* Animations for transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
        
        /* Improved form styling */
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
            border-color: rgba(var(--primary-rgb), 0.5);
        }
        
        /* Tooltip styling */
        .tooltip-container {
            position: relative;
        }
        
        /* Accessibility improvements */
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        /* Card hover effects */
        .card.custom-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .card.custom-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }
        
        /* Form switch enhancements */
        .form-check-input:checked {
            background-color: rgba(var(--primary-rgb), 1);
            border-color: rgba(var(--primary-rgb), 1);
        }
        
        /* Responsive improvements */
        @media (max-width: 768px) {
            .col-xl-3, .col-xl-9 {
                width: 100%;
                margin-bottom: 1rem;
            }
        }
        
        /* Cursor pointer for interactive elements */
        .nav-link, .form-check-input, button {
            cursor: pointer;
        }
        
        /* Accessibility focus indicators */
        button:focus, input:focus, select:focus, textarea:focus {
            outline: 2px solid rgba(var(--primary-rgb), 0.5);
            outline-offset: 2px;
        }
        
        /* Micro-interactions */
        .btn {
            transition: all 0.2s;
        }
        
        .btn:active {
            transform: scale(0.97);
        }
        
        /* Loading indicator animations */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
@endpush
