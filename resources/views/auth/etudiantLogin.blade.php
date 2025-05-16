<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Étudiant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
    <div class="container col-md-6">
        <h2 class="mb-4">Connexion Étudiant</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('etudiantlogin.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="identifiant" class="form-label">Identifiant</label>
                <input type="text" name="identifiant" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_plain" class="form-label">Mot de passe</label>
                <input type="password" name="password_plain" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</body>
</html>
