@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 display-4 font-weight-bold">Nos Filières de Formation</h2>
    
    <div class="row g-4">
        @forelse($filieres as $filiere)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-lg h-100 hover-effect">
                    @if($filiere->image_path)
                        <div class="card-img-container overflow-hidden" style="height: 220px;">
                            <img src="{{ asset('storage/' . $filiere->image_path) }}" 
                                 class="card-img-top h-100 w-100 object-fit-cover" 
                                 alt="{{ $filiere->titre }}">
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title font-weight-bold text-primary mb-0">{{ $filiere->titre }}</h5>
                            <span class="badge bg-gradient-{{ $filiere->niveau == 'Licence' ? 'info' : ($filiere->niveau == 'Master' ? 'success' : 'warning') }} rounded-pill px-3 py-2">
                                {{ $filiere->niveau }}
                            </span>
                        </div>
                        
                        <p class="card-text text-muted mb-4">{{ Str::limit($filiere->description, 120) }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-outline-primary btn-sm">Voir détails</a>
                            <small class="text-muted">Durée: 3 ans</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-4">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>Aucune filière disponible pour le moment</h4>
                    <p class="mb-0">Nos programmes de formation seront bientôt disponibles</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-effect {
        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .hover-effect:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    .card-img-container {
        position: relative;
    }
    
    .card-img-container::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(0,0,0,0.2), transparent);
    }
    
    .bg-gradient-info {
        background: linear-gradient(45deg, #17a2b8, #5bc0de);
    }
    
    .bg-gradient-success {
        background: linear-gradient(45deg, #28a745, #5cb85c);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(45deg, #ffc107, #f0ad4e);
    }
    
    .object-fit-cover {
        object-fit: cover;
    }
    
    .btn-outline-primary {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: #fff;
    }
</style>
@endpush
