<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Filière</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin-bottom: 30px;
            text-align: center;
            color: #343a40;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Ajouter une nouvelle filière</h1>
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        
        <form method="POST" action="{{ route('filieres.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="titre" class="form-label">Titre de la filière</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="informations_detaillees" class="form-label">Informations détaillées</label>
                <textarea class="form-control" id="info" name="info" rows="5" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="niveau_requis" class="form-label">Niveau requis</label>
                <select class="form-select" id="niveau" name="niveau" required>
                    <option value="">Sélectionnez un niveau</option>
                    <option value="Bac">Bac</option>
                    <option value="Bac+2">Bac+2</option>
                    <option value="Bac+3">Bac+3</option>
                    <option value="Bac+5">Bac+5</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image de la filière</label>
                <input type="file" class="form-control" id="image_path" name="image_path">
            </div>
            
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>