<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une absence</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2>Modifier l'absence de {{ $absence->etudiant->nom }} {{ $absence->etudiant->prenom }}</h2>

    <form action="{{ route('absences.update', $absence->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="matiere_id" class="form-label">Matière</label>
            <select name="matiere_id" id="matiere_id" class="form-control">
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ $absence->matiere_id == $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $absence->date }}">
        </div>

        <div class="mb-3">
            <label for="duree" class="form-label">Durée (heures)</label>
            <input type="number" name="duree" id="duree" class="form-control" value="{{ $absence->duree }}">
        </div>

        <div class="mb-3">
            <label for="justifiee" class="form-label">Absence justifiée ?</label>
            <select name="justifiee" id="justifiee" class="form-control">
                <option value="1" {{ $absence->justifiee ? 'selected' : '' }}>Oui</option>
                <option value="0" {{ !$absence->justifiee ? 'selected' : '' }}>Non</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="motif" class="form-label">Motif</label>
            <input type="text" name="motif" id="motif" class="form-control" value="{{ $absence->motif }}">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('etudiants.show', $absence->etudiant_id) }}" class="btn btn-secondary">Annuler</a>
    </form>
</body>
</html>
