
@extends('layouts.dashboard') {{-- Utilise ton layout admin --}}

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* Dashboard Container */
    #dashboard-container {
        background-color: var(--light);
        padding: 2rem;
        min-height: calc(100vh - var(--topbar-height));
    }

    /* Dashboard Title */
    #dashboard-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 0.75rem;
    }

    #dashboard-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border-radius: 2px;
    }

    /* Stats Grid */
    #dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    /* Stat Cards */
    #stat-filieres,
    #stat-evenements,
    #stat-actualites,
    #stat-cours {
        background: var(--white);
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        border-left: 4px solid transparent;
    }

    #stat-filieres:hover,
    #stat-evenements:hover,
    #stat-actualites:hover,
    #stat-cours:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-hover-shadow);
    }

    #stat-filieres {
        border-left-color: var(--primary);
    }

    #stat-evenements {
        border-left-color: var(--success);
    }

    #stat-actualites {
        border-left-color: var(--danger);
    }

    #stat-cours {
        border-left-color: var(--warning);
    }

    /* Card Titles */
    #title-filieres,
    #title-evenements,
    #title-actualites,
    #title-cours {
        font-size: 1rem;
        font-weight: 600;
        color: var(--gray);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Count Values */
    #count-filieres,
    #count-evenements,
    #count-actualites,
    #count-cours {
        font-size: 2.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    #count-filieres {
        color: var(--primary);
    }

    #count-evenements {
        color: var(--success);
    }

    #count-actualites {
        color: var(--danger);
    }

    #count-cours {
        color: var(--warning);
    }

    /* Info Text */
    #new-filieres-week,
    #upcoming-evenements,
    #month-actualites,
    #new-cours-week {
        font-size: 0.875rem;
        color: var(--gray);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Sections */
    #recent-candidats-section,
    #recent-messages-section {
        margin-top: 2.5rem;
    }

    /* Section Titles */
    #recent-candidats-title,
    #recent-messages-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1.5rem;
        position: relative;
        padding-left: 1rem;
    }

    #recent-candidats-title::before,
    #recent-messages-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 1.25rem;
        background: var(--primary);
        border-radius: 2px;
    }

    /* Lists */
    #recent-candidats-list,
    #recent-messages-list {
        background: var(--white);
        border-radius: 10px;
        box-shadow: var(--card-shadow);
        padding: 1.5rem;
    }

    /* List Items */
    #recent-candidats-list li,
    #recent-messages-list li {
        padding: 1rem 0;
        border-bottom: 1px solid var(--gray-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: var(--transition);
    }

    #recent-candidats-list li:last-child,
    #recent-messages-list li:last-child {
        border-bottom: none;
    }

    #recent-candidats-list li:hover,
    #recent-messages-list li:hover {
        background-color: var(--primary-light);
    }

    /* Badge for Messages Count */
    #recent-messages-title span {
        background-color: var(--danger);
        color: white;
        font-size: 0.875rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        margin-left: 0.75rem;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #dashboard-stats > div {
        animation: fadeInUp 0.5s ease-out forwards;
    }

    #stat-filieres { animation-delay: 0.1s; }
    #stat-evenements { animation-delay: 0.2s; }
    #stat-actualites { animation-delay: 0.3s; }
    #stat-cours { animation-delay: 0.4s; }

    /* Responsive */
    @media (max-width: 768px) {
        #dashboard-stats {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 576px) {
        #dashboard-container {
            padding: 1.5rem;
        }
        
        #dashboard-stats {
            grid-template-columns: 1fr;
        }
        
        #dashboard-title {
            font-size: 1.5rem;
        }
    }
    .recent-message-list {
    background-color: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
}

.recent-message-list:hover {
    box-shadow: var(--card-hover-shadow);
}

.recent-message-item {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    padding-bottom: 0.75rem;
    padding-top: 0.75rem;
    transition: background 0.2s ease;
    font-size: 0.95rem;
    color: var(--dark-color);
}

.recent-message-item:hover {
    background-color: var(--primary-light);
    border-radius: 8px;
    padding-left: 0.5rem;
}

</style>
<div id="dashboard-container" class="p-6 bg-gray-100">
    <h1 id="dashboard-title" class="text-2xl font-bold mb-6">Tableau de bord</h1>

    <div id="dashboard-stats" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div id="stat-filieres" class="bg-white p-4 rounded shadow">
            <h2 id="title-filieres" class="text-lg font-semibold">Filières</h2>
            <p id="count-filieres" class="text-3xl font-bold text-blue-600">{{ $nbFilieres }}</p>
            <p id="new-filieres-week" class="text-sm text-gray-500">{{ $filieresSemaine }} nouvelles cette semaine</p>
        </div>

        <div id="stat-evenements" class="bg-white p-4 rounded shadow">
            <h2 id="title-evenements" class="text-lg font-semibold">Événements</h2>
            <p id="count-evenements" class="text-3xl font-bold text-green-600">{{ $nbEvenements }}</p>
            <p id="upcoming-evenements" class="text-sm text-gray-500">{{ $evenementsAVenir }} à venir</p>
        </div>

        <div id="stat-actualites" class="bg-white p-4 rounded shadow">
            <h2 id="title-actualites" class="text-lg font-semibold">Actualités</h2>
            <p id="count-actualites" class="text-3xl font-bold text-red-600">{{ $nbActualites }}</p>
            <p id="month-actualites" class="text-sm text-gray-500">{{ $actualitesMois }} publiées ce mois</p>
        </div>

        <div id="stat-cours" class="bg-white p-4 rounded shadow">
            <h2 id="title-cours" class="text-lg font-semibold">Cours</h2>
            <p id="count-cours" class="text-3xl font-bold text-purple-600">{{ $nbCours }}</p>
            <p id="new-cours-week" class="text-sm text-gray-500">{{ $nouveauxCours }} ajoutés cette semaine</p>
        </div>
    </div>

    <div id="recent-candidats-section" class="mt-10">
        <h2 id="recent-candidats-title" class="text-xl font-bold mb-4">Candidats récents</h2>
        <ul id="recent-candidats-list" class="bg-white p-4 rounded shadow space-y-2">
            @foreach($candidats as $index => $candidat)
                <li id="candidat-{{ $index }}" class="border-b pb-2">{{ $candidat->nom }} - {{ $candidat->email }}</li>
            @endforeach
        </ul>
    </div>

    <div id="recent-messages-section" class="mt-10">
    <h2 id="recent-messages-title" class="text-xl font-bold mb-4 text-gradient">
        <i class="fas fa-envelope-open-text mr-2"></i> Derniers messages ({{ $nbMessages }})
    </h2>
    <ul id="recent-messages-list" class="recent-message-list">
        @foreach($messages as $index => $message)
            <li id="message-{{ $index }}" class="recent-message-item">
                <strong>{{ $message->email }}</strong> : {{ Str::limit($message->message, 60) }}
            </li>
        @endforeach
    </ul>
</div>

</div>
@endsection

