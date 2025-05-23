@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tous les Événements</h2>
    <div class="row">
        @forelse($evenements as $evenement)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($evenement->image)
                        <img src="{{ asset('storage/' . $evenement->image) }}" class="card-img-top" alt="{{ $evenement->titre }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $evenement->titre }}</h5>
                        <p class="card-text">{{ $evenement->description }}</p>
                        <small class="text-muted">Date : {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}</small>
                                                <p class="card-text">{{ $evenement->infos }}</p>

                    </div>
                </div>
            </div>
        @empty
            <p>Aucun événement disponible pour le moment.</p>
        @endforelse
    </div>
</div>
@endsection
