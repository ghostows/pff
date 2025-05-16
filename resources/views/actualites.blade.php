@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Toutes les Actualités</h2>
    <div class="row">
        @forelse($actualites as $actu)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($actu->image)
                        <img src="{{ asset('storage/' . $actu->image) }}" class="card-img-top" alt="{{ $actu->titre }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $actu->titre }}</h5>
                        <p class="card-text">{{ Str::limit($actu->contenu, 100) }}</p>
                        <small class="text-muted">Publié le {{ \Carbon\Carbon::parse($actu->created_at)->format('d/m/Y') }}</small>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucune actualité disponible pour le moment.</p>
        @endforelse
    </div>
</div>
@endsection
