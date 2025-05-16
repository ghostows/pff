<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un événement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Ajouter un événement</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evenements.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="infos" class="form-label">Infos</label>
            <textarea name="infos" id="infos" class="form-control" rows="3" required>{{ old('infos') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="date_event" class="form-label">Date de l'événement</label>
            <input type="date" name="date_event" id="date_event" class="form-control" value="{{ old('date_event') }}" required>
        </div>

        <div class="mb-3">
            <label for="heure_debut" class="form-label">Heure de début</label>
            <input type="time" name="heure_debut" id="heure_debut" class="form-control" value="{{ old('heure_debut') }}" required>
        </div>

        <div class="mb-3">
            <label for="heure_fin" class="form-label">Heure de fin</label>
            <input type="time" name="heure_fin" id="heure_fin" class="form-control" value="{{ old('heure_fin') }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optionnelle)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
