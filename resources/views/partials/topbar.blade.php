<nav class="topbar">
    <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Rechercher...">
    </div>

    <div class="user-profile">
        <img src="https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg?semt=ais_hybrid&w=740" alt="Admin">
        <div class="user-info">
            <span class="user-name">{{ Auth::user()->nom ?? 'Admin' }}</span>
            <span class="user-role">Administrateur</span>
            <a href="{{ route('etudiantlogout') }}" class="btn btn-logout">
                        <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                    </a>
        </div>
    </div>
</nav>
