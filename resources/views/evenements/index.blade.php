<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Événements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('css/style2.css') }}">

</head>
<body>
<div class="container mt-5">
    <h2>Liste des Événements</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('evenements.create') }}" class="btn btn-primary mb-3">Ajouter un événement</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date de l'événement</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evenements as $evenement)
                <tr>
                    <td>{{ $evenement->titre }}</td>
                    <td>{{ \Str::limit($evenement->description, 50) }}</td>
                    <td>{{ $evenement->date_event }}</td>
                    <td>{{ $evenement->heure_debut }}</td>
                    <td>{{ $evenement->heure_fin }}</td>
                    <td>
                        <a href="{{ route('evenements.edit', $evenement->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <form action="{{ route('evenements.destroy', $evenement->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
