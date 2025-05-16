<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un cours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier un cours</h2>

    <form action="{{ route('cours.update', $cours->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre du cours</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ $cours->titre }}" required>
        </div>

        <div class="mb-3">
            <label for="filiere" class="form-label">Filière</label>
            <select name="filiere" id="filiere" class="form-select" required>
                <option value="Informatique" {{ $cours->filiere == 'Informatique' ? 'selected' : '' }}>Informatique</option>
                <option value="Économie" {{ $cours->filiere == 'Économie' ? 'selected' : '' }}>Économie</option>
                <option value="Mécanique" {{ $cours->filiere == 'Mécanique' ? 'selected' : '' }}>Mécanique</option>
                <option value="Autre" {{ $cours->filiere == 'Autre' ? 'selected' : '' }}>Autre</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="annee" class="form-label">Année</label>
            <select name="annee" id="annee" class="form-select" required>
                <option value="1ere" {{ $cours->annee == '1ere' ? 'selected' : '' }}>1ère année</option>
                <option value="2eme" {{ $cours->annee == '2eme' ? 'selected' : '' }}>2ème année</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pdf" class="form-label">Fichier PDF (laisser vide pour garder l'actuel)</label>
            <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf">
            @if($cours->pdf_path)
                <p class="mt-2">Fichier actuel : <a href="{{ asset('storage/' . $cours->pdf_path) }}" target="_blank">Voir le PDF</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('cours.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>
