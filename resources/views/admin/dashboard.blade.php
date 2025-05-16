<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | ESIC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">


</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                <i class="fas fa-university"></i>
                <span>ESIC Admin</span>
            </a>
        </div>

        <div class="sidebar-menu">
            <div class="menu-title">Menu Principal</div>
            <a href="#" class="menu-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-title">Gestion</div>
            <a href="{{ route('filieres.index') }}" class="menu-item">
                <i class="fas fa-graduation-cap"></i>
                <span>Filières</span>
            </a>
            <a href="{{ route('evenements.index') }}" class="menu-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Événements</span>
            </a>
            <a href="{{ route('actualites.index') }}" class="menu-item">
                <i class="fas fa-newspaper"></i>
                <span>Actualités</span>
            </a>
            <a href="{{ route('cours.index') }}" class="menu-item">
                <i class="fas fa-book"></i>
                <span>Cours</span>
            </a>

            <div class="menu-title">Administration</div>
            <a href="#" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Utilisateurs</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Paramètres</span>
            </a>
            <a href="{{ route('contact.index') }}" class="menu-item">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
            </a>
            <a href="{{ route('etudiants.index') }}" class="menu-item">
                <i class="fas fa-user-graduate"></i>
                <span>Étudiants</span>
            </a>
             <a href="{{ route('dashboard.statistiques') }}" class="menu-item">
                <i class="fas fa-user-graduate"></i>
                <span>statistics</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Topbar -->
        <nav class="topbar">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Rechercher...">
            </div>

            <div class="user-profile">
                <img src="https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg?semt=ais_hybrid&w=740" alt="Admin">
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->nom }}</span>
                    <span class="user-role">Administrateur</span>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h1>Tableau de Bord</h1>
                    <p>Bienvenue sur votre espace d'administration</p>
                </div>
                <button class="btn btn-primary">
                    <i class="fas fa-download"></i>
                    Exporter Rapport
                </button>
            </div>

            <!-- Stats Cards -->
            <div class="cards-grid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Filières</h3>
                        <div class="card-icon primary">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-value">{{ $nbFilieres }}</div>
                        <div class="card-description">+{{ $filieresSemaine }} cette semaine</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('filieres.index') }}" class="card-link">
                            Voir toutes les filières
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Événements</h3>
                        <div class="card-icon success">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-value">{{ $nbEvenements }}</div>
                        <div class="card-description">{{ $evenementsAVenir }} événements à venir</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('evenements.index') }}" class="card-link">
                            Voir tous les événements
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Actualités</h3>
                        <div class="card-icon warning">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-value">{{ $nbActualites }}</div>
                        <div class="card-description">+{{ $actualitesMois }} ce mois-ci</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('actualites.index') }}" class="card-link">
                            Voir toutes les actualités
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cours</h3>
                        <div class="card-icon danger">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-value">{{ $nbCours }}</div>
                        <div class="card-description">{{ $nouveauxCours }} nouveaux cours</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('cours.index') }}" class="card-link">
                            Voir tous les cours
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modules Section -->
            <div class="modules-section">
                <h2 class="section-title">Gestion des Modules</h2>

                <div class="modules-grid">
                    <div class="module-card">
                        <div class="module-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="module-title">Filières</h3>
                        <p class="module-description">
                            Gérer les différentes filières de l'établissement, leurs programmes et leurs responsables.
                        </p>
                        <div class="module-actions">
                            <a href="{{ route('filieres.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Ajouter
                            </a>
                            <a href="{{ route('filieres.index') }}" class="btn btn-outline btn-sm">
                                <i class="fas fa-list"></i> Liste
                            </a>
                        </div>
                    </div>

                    <div class="module-card">
                        <div class="module-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="module-title">Événements</h3>
                        <p class="module-description">
                            Planifier et organiser les événements académiques, culturels et professionnels.
                        </p>
                        <div class="module-actions">
                            <a href="{{ route('evenements.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Ajouter
                            </a>
                            <a href="{{ route('evenements.index') }}" class="btn btn-outline btn-sm">
                                <i class="fas fa-list"></i> Liste
                            </a>
                        </div>
                    </div>

                    <div class="module-card">
                        <div class="module-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h3 class="module-title">Actualités</h3>
                        <p class="module-description">
                            Publier et gérer les actualités de l'établissement pour informer les étudiants et le personnel.
                        </p>
                        <div class="module-actions">
                            <a href="{{ route('actualites.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Ajouter
                            </a>
                            <a href="{{ route('actualites.index') }}" class="btn btn-outline btn-sm">
                                <i class="fas fa-list"></i> Liste
                            </a>
                        </div>
                    </div>

                    <div class="module-card">
                        <div class="module-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3 class="module-title">Cours</h3>
                        <p class="module-description">
                            Gérer le contenu pédagogique, les ressources et les supports de cours pour les étudiants.
                        </p>
                        <div class="module-actions">
                            <a href="{{ route('cours.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Ajouter
                            </a>
                            <a href="{{ route('cours.index') }}" class="btn btn-outline btn-sm">
                                <i class="fas fa-list"></i> Liste
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Candidates Section -->
            <div class="candidates-section">
                <h2 class="section-title">Derniers candidats inscrits</h2>
                <div class="candidates-grid">
                    @foreach ($candidats as $candidat)
                    <div class="candidate-card">
                        <div class="candidate-header">
                            <h3 class="candidate-name">{{ $candidat->nom }} {{ $candidat->prenom }}</h3>
                        </div>
                        <div class="candidate-details">
                            <div class="detail-item">
                                <span class="detail-label">Email:</span>
                                <span class="detail-value">{{ $candidat->email }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">CV:</span>
                                <span class="detail-value">
                                    @if($candidat->document)
                                    <a href="{{ asset('storage/'.$candidat->document) }}" target="_blank" class="cv-link">
                                        <i class="fas fa-file-pdf"></i> Télécharger le CV
                                    </a>
                                    @else
                                    <span class="text-muted">Non fourni</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="candidate-actions">
                            <form action="{{ route('candidats.approuver', $candidat->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-action">
                                    <i class="fas fa-check"></i> Approuver
                                </button>
                            </form>

                            <form action="{{ route('candidats.decliner', $candidat->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-action">
                                    <i class="fas fa-times"></i> Décliner
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Messages Section -->
            <div class="messages-section">
                <h2 class="section-title">Derniers messages de contact ({{ $nbMessages }})</h2>
                <div class="messages-grid">
                    @forelse ($messages as $message)
                    <div class="message-card">
                        <div class="message-header">
                            <h3 class="message-name">{{ $message->name }}</h3>
                            <span class="message-date">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="message-details">
                            <p><strong>Email :</strong> {{ $message->email }}</p>
                            <p><strong>Sujet :</strong> {{ $message->subject }}</p>
                            <p><strong>Message :</strong> {{ Str::limit($message->message, 100) }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">Aucun message reçu pour le moment.</p>
                    @endforelse
                </div>
                <div class="text-end mt-3">
                    <a href="{{ route('contact.index') }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-envelope-open-text"></i> Voir tous les messages
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Animation pour les cartes
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card, .module-card, .candidate-card, .message-card');
            
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>