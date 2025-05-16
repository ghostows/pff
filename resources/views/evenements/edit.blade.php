<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un événement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier l'événement</h2>

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evenements.update', $evenement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ $evenement->titre }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $evenement->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="infos" class="form-label">Infos</label>
            <textarea name="infos" id="infos" class="form-control" required>{{ $evenement->infos }}</textarea>
        </div>

        <div class="mb-3">
            <label for="date_event" class="form-label">Date de l'événement</label>
            <input type="date" name="date_event" id="date_event" class="form-control" value="{{ $evenement->date_event }}" required>
        </div>

        <div class="mb-3">
            <label for="heure_debut" class="form-label">Heure de début</label>
            <input type="time" name="heure_debut" id="heure_debut" class="form-control" value="{{ $evenement->heure_debut }}" required>
        </div>

        <div class="mb-3">
            <label for="heure_fin" class="form-label">Heure de fin</label>
            <input type="time" name="heure_fin" id="heure_fin" class="form-control" value="{{ $evenement->heure_fin }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (laisser vide pour ne pas changer)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
</body>
</html>
