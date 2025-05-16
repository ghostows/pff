<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une note</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2>Modifier la note de {{ $note->etudiant->nom }} {{ $note->etudiant->prenom }}</h2>

    <form action="{{ route('notes.update', $note->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="matiere_id" class="form-label">Matière</label>
            <select name="matiere_id" id="matiere_id" class="form-control">
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ $note->matiere_id == $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Note (/20)</label>
            <input type="number" name="note" id="note" class="form-control" value="{{ $note->note }}" step="0.1">
        </div>

        <div class="mb-3">
            <label for="coefficient" class="form-label">Coefficient</label>
            <input type="number" name="coefficient" id="coefficient" class="form-control" value="{{ $note->coefficient }}">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $note->date }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ $note->description }}">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('etudiants.show', $note->etudiant_id) }}" class="btn btn-secondary">Annuler</a>
    </form>
</body>
</html>
