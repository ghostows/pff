<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">CMFP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('filiere.page') }}">Filières</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('evenements.page') }}">Événements</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('actualites.page') }}">Actualités</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contact.create') }}">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('inscription.create') }}">je me candidate</a></li>
            <li><a href="{{route('auth.connexion')}}" class="btn btn-outline">Se connecter</a></li>
            <li><a href="{{route('etudiantlogin')}}" class="btn btn-outline">je suis un etudiant</a></li>
        </ul>
    </div>
</nav>
