<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'Actualité</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier l'Actualité</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('actualites.update', $actualite->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $actualite->titre) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $actualite->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu</label>
            <textarea class="form-control" id="contenu" name="contenu" rows="5" required>{{ old('contenu', $actualite->contenu) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="date_publication" class="form-label">Date de Publication</label>
            <input type="date" class="form-control" id="date_publication" name="date_publication" value="{{ old('date_publication', $actualite->date_publication) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($actualite->image)
                <p>Image actuelle : <a href="{{ asset('storage/' . $actualite->image) }}" target="_blank">Voir l'image</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>
</body>
</html>
