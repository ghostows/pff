<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <title>Document</title>
</head>
<body>
<h1>Liste des filières</h1>
<ul>
    @foreach($filieres as $filiere)
        <li>{{ $filiere->titre }} - {{ $filiere->niveau }}
        <a href="{{ route('filieres.edit', $filiere->id) }}" class="btn btn-warning btn-sm">Modifier</a>

<form action="{{ route('filieres.destroy', $filiere->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette filière ?')">Supprimer</button>
</form>

        </li>
    @endforeach
</ul>

</body>
</html>