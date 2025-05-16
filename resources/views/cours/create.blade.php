<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un cours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Ajouter un cours</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cours.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="titre" class="form-label">Titre du cours</label>
            <input type="text" name="titre" id="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="filiere" class="form-label">Filière</label>
            <select name="filiere" id="filiere" class="form-select" required>
    <option value="">-- Choisir une classe --</option>
    @foreach($classes as $classe)
        <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
    @endforeach
</select>
        </div>

        <div class="mb-3">
            <label for="annee" class="form-label">Année</label>
            <select name="annee" id="annee" class="form-select" required>
                <option value="">-- Choisir --</option>
                <option value="1ere">1ère année</option>
                <option value="2eme">2ème année</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pdf" class="form-label">Fichier PDF</label>
            <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
</body>
</html>
