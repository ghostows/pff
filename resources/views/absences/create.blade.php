<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Absence</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2>Ajouter une absence</h2>

    <form action="{{ route('absences.store') }}" method="POST">
        @csrf
        <input type="hidden" name="etudiant_id" value="{{ $etudiant->id }}">

        <select name="matiere_id" class="form-control mb-2">
            @foreach($matieres as $matiere)
                <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
            @endforeach
        </select>

        <input type="date" name="date" class="form-control mb-2">
        <input type="number" name="duree" class="form-control mb-2" placeholder="Durée (heures)">
        <select name="justifiee" class="form-control mb-2">
            <option value="0">Non justifiée</option>
            <option value="1">Justifiée</option>
        </select>
        <textarea name="motif" class="form-control mb-2" placeholder="Motif (facultatif)"></textarea>

        <button type="submit" class="btn btn-warning">Ajouter l'absence</button>
    </form>
</body>
</html>
