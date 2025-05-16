<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des cours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('css/style2.css') }}">

</head>
<body>
<div class="container mt-5">
    <h2>Liste des cours</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('cours.create') }}" class="btn btn-success mb-3">Ajouter un nouveau cours</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Filière</th>
                <th>Année</th>
                <th>Fichier PDF</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cours as $coursItem)
                <tr>
                    <td>{{ $coursItem->titre }}</td>
                    <td>{{ $coursItem->filiere }}</td>
                    <td>{{ $coursItem->annee }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $coursItem->pdf_path) }}" target="_blank">Voir le PDF</a>
                    </td>
                    <td>
                        <a href="{{ route('cours.edit', $coursItem->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('cours.destroy', $coursItem->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
