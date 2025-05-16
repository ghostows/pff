<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une filière</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier la filière</h2>

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('filieres.update', $filiere->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ $filiere->titre }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $filiere->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="info" class="form-label">Info</label>
            <textarea name="info" id="info" class="form-control" required>{{ $filiere->info }}</textarea>
        </div>

        <div class="mb-3">
            <label for="niveau" class="form-label">Niveau</label>
            <select name="niveau" id="niveau" class="form-control" required>
                @foreach($niveaux as $niveau)
                    <option value="{{ $niveau }}" {{ $filiere->niveau === $niveau ? 'selected' : '' }}>{{ $niveau }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image_path" class="form-label">Image (laisser vide pour ne pas changer)</label>
            <input type="file" name="image_path" id="image_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
</body>
</html>
