<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Étudiant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2>Ajouter un étudiant</h2>

    <form action="{{ route('etudiants.store') }}" method="POST">
        @csrf

        <input type="text" name="identifiant" class="form-control mb-2" placeholder="Identifiant">
        <input type="text" name="nom" class="form-control mb-2" placeholder="Nom">
        <input type="text" name="prenom" class="form-control mb-2" placeholder="Prénom">
        <input type="date" name="date_naissance" class="form-control mb-2">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email">
        <input type="text" name="telephone" class="form-control mb-2" placeholder="Téléphone">
        <input type="text" name="adresse" class="form-control mb-2" placeholder="Adresse">
        <div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" required>
</div>

        <select name="classe_id" class="form-control mb-2">
            @foreach($classes as $classe)
                <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
            @endforeach
        </select>

        <h4>Parent</h4>
        <input type="text" name="parent_nom" class="form-control mb-2" placeholder="Nom du parent">
        <input type="text" name="parent_telephone" class="form-control mb-2" placeholder="Téléphone du parent">
        <input type="email" name="parent_email" class="form-control mb-2" placeholder="Email du parent">

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
