<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails Étudiant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2>Détails de l'étudiant</h2>
    <p><strong>Nom :</strong> {{ $etudiant->nom }} {{ $etudiant->prenom }}</p>
    <p><strong>Identifiant :</strong> {{ $etudiant->identifiant }}</p>
    <p><strong>Date de naissance :</strong> {{ $etudiant->date_naissance }}</p>
    <p><strong>Email :</strong> {{ $etudiant->email }}</p>
    <p><strong>Téléphone :</strong> {{ $etudiant->telephone }}</p>
    <p><strong>Adresse :</strong> {{ $etudiant->adresse }}</p>
    <p><strong>Mot de passe :</strong> {{ $etudiant->password_plain }}</p>
    <p><strong>Classe :</strong> {{ $etudiant->classe->nom }}</p>

    <h4>Informations du parent</h4>
    <p><strong>Nom :</strong> {{ $etudiant->parentEtudiant->nom ?? 'N/A' }}</p>
    <p><strong>Téléphone :</strong> {{ $etudiant->parentEtudiant->telephone ?? 'N/A' }}</p>
    <p><strong>Email :</strong> {{ $etudiant->parentEtudiant->email ?? 'N/A' }}</p>
    <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-secondary mt-3">Modifier les informations de l'étudiant</a>
    <a href="{{ route('absences.create', $etudiant->id) }}" class="btn btn-warning mt-3">Ajouter une absence</a>
    <a href="{{ route('notes.create', $etudiant->id) }}" class="btn btn-success mt-3">Ajouter une note</a>

    <hr>
    <h4 class="mt-4">Notes</h4>
    @if($etudiant->notes->isEmpty())
        <p>Aucune note enregistrée.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Matière</th>
                    <th>Note (/20)</th>
                    <th>Coefficient</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($etudiant->notes as $note)
                    <tr>
                        <td>{{ $note->matiere->nom ?? 'N/A' }}</td>
                        <td>{{ $note->note }}</td>
                        <td>{{ $note->coefficient }}</td>
                        <td>{{ $note->date }}</td>
                        <td>{{ $note->description }}</td>
                        <td>
                            <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Supprimer cette note ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h4 class="mt-4">Absences</h4>
    @if($etudiant->absences->isEmpty())
        <p>Aucune absence enregistrée.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Matière</th>
                    <th>Date</th>
                    <th>Durée (heures)</th>
                    <th>Justifiée</th>
                    <th>Motif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($etudiant->absences as $absence)
                    <tr>
                        <td>{{ $absence->matiere->nom ?? 'N/A' }}</td>
                        <td>{{ $absence->date }}</td>
                        <td>{{ $absence->duree }}</td>
                        <td>{{ $absence->justifiee ? 'Oui' : 'Non' }}</td>
                        <td>{{ $absence->motif }}</td>
                        <td>
                            <a href="{{ route('absences.edit', $absence->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                            <form action="{{ route('absences.destroy', $absence->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Supprimer cette absence ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
