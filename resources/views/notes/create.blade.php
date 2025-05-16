<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Note</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2>Ajouter une note</h2>

    <form action="{{ route('notes.store') }}" method="POST">
        @csrf
        <input type="hidden" name="etudiant_id" value="{{ $etudiant->id }}">

        <select name="matiere_id" class="form-control mb-2">
            @foreach($matieres as $matiere)
                <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
            @endforeach
        </select>

        <input type="number" step="0.01" name="note" class="form-control mb-2" placeholder="Note sur 20">
        <input type="number" step="0.1" name="coefficient" class="form-control mb-2" placeholder="Coefficient">
        <input type="date" name="date" class="form-control mb-2">
        <textarea name="description" class="form-control mb-2" placeholder="Ex: Contrôle chapitre 3"></textarea>

        <button type="submit" class="btn btn-success">Ajouter la note</button>
    </form>
</body>
</html>
