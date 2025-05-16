<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants | ESIC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #ebf0ff;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #f72585;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --gray: #6c757d;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark);
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem;
            margin-bottom: 2rem;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
        }
        
        .page-header h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .search-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead {
            background-color: var(--primary);
            color: white;
        }
        
        .table th {
            font-weight: 500;
            padding: 1rem;
        }
        
        .table td {
            padding: 1rem;
            vertical-align: middle;
        }
        
        .table-hover tbody tr:hover {
            background-color: var(--primary-light);
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }
        
        .btn-outline-secondary {
            color: var(--gray);
            border-color: var(--gray-light);
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--gray-light);
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .alert {
            border-radius: 8px;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--gray);
        }
        
        .empty-state i {
            font-size: 3rem;
            color: #e2e8f0;
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }
            
            .action-buttons .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body class="p-4">
    <div class="container-fluid">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="bi bi-people-fill me-2"></i> Gestion des Étudiants</h1>
                    <p class="mb-0">Liste complète des étudiants enregistrés</p>
                </div>
                <a href="{{ route('etudiants.create') }}" class="btn btn-light">
                    <i class="bi bi-plus-circle me-1"></i> Ajouter un étudiant
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light">
    <i class="bi bi-house-door-fill me-1"></i> Dashboard
</a>
            </div>
        </div>

        <!-- Formulaire de recherche -->
        <div class="search-card">
            <form action="{{ route('etudiants.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-5">
                        <input type="text" name="identifiant" class="form-control" placeholder="Rechercher par identifiant..." value="{{ request('identifiant') }}">
                    </div>
                    <div class="col-md-5">
                        <select name="classe_id" class="form-select">
                            <option value="">Toutes les classes</option>
                            @foreach($classes as $classe)
                                <option value="{{ $classe->id }}" {{ request('classe_id') == $classe->id ? 'selected' : '' }}>
                                    {{ $classe->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel me-1"></i> Filtrer
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-container">
            @if($etudiants->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom Complet</th>
                            <th>Classe</th>
                            <th style="width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($etudiants as $etudiant)
                        <tr>
                            <td><strong>{{ $etudiant->identifiant }}</strong></td>
                            <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $etudiant->classe->nom }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('etudiants.show', $etudiant->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i> Détails
                                    </a>
                                    <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(this);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($etudiants->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Affichage de {{ $etudiants->firstItem() }} à {{ $etudiants->lastItem() }} sur {{ $etudiants->total() }} étudiants
                </div>
                <nav>
                    {{ $etudiants->withQueryString()->links() }}
                </nav>
            </div>
            @endif
            
            @else
            <div class="empty-state">
                <i class="bi bi-people"></i>
                <h5>Aucun étudiant trouvé</h5>
                <p>Aucun étudiant ne correspond à vos critères de recherche.</p>
            </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(form) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cet étudiant ? Cette action est irréversible.")) {
                form.submit();
            } else {
                return false;
            }
        }
        
        // Animation pour les lignes du tableau
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, index * 50);
            });
        });
    </script>
</body>
</html>