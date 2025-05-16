<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Actualités</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Liste des Actualités</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('actualites.create') }}" class="btn btn-primary mb-3">Ajouter une nouvelle actualité</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date de publication</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actualites as $actualite)
                <tr>
                    <td>{{ $actualite->titre }}</td>
                    <td>{{ $actualite->description }}</td>
                    <td>{{ $actualite->date_publication }}</td>
                    <td>
                        <a href="{{ route('actualites.edit', $actualite->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('actualites.destroy', $actualite->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet actualité ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
