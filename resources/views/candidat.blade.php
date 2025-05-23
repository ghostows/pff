@extends('layouts.dashboard')
@section('content')
<style>
    /* Conteneur principal */
    #candidatsSection {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 16px;
        margin-bottom: 30px;
    }
    
    /* Titre de section */
    #sectionTitle {
        color: #2c3e50;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 10px;
    }
    
    #sectionTitle::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background-color: #3498db;
        border-radius: 2px;
    }
    
    /* Grille des candidats */
    #candidatsGrid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    
    /* Carte de candidat */
    #candidatCard {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }
    
    #candidatCard:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }
    
    /* En-tête de carte */
    #candidatHeader {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }
    
    /* Nom du candidat */
    #candidatName {
        color: #2c3e50;
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }
    
    /* Corps de la carte */
    #candidatBody {
        padding: 20px;
    }
    
    /* Détails du candidat */
    #candidatDetails {
        color: #7f8c8d;
        font-size: 14px;
        line-height: 1.6;
    }
    
    #candidatDetails strong {
        color: #34495e;
    }
    
    /* Lien CV */
    #cvLink {
        color: #3498db;
        text-decoration: none;
        transition: color 0.2s;
    }
    
    #cvLink:hover {
        color: #2980b9;
        text-decoration: underline;
    }
    
    /* Pied de carte */
    #candidatFooter {
        padding: 15px 20px;
        background-color: #f8f9fa;
        display: flex;
        justify-content: space-between;
    }
    
    /* Boutons d'action */
    #approveBtn, #declineBtn {
        padding: 8px 15px;
        font-size: 13px;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    #approveBtn {
        background-color: #2ecc71;
        border-color: #2ecc71;
        color: white;
    }
    
    #approveBtn:hover {
        background-color: #27ae60;
        transform: translateY(-2px);
    }
    
    #declineBtn {
        background-color: #e74c3c;
        border-color: #e74c3c;
        color: white;
    }
    
    #declineBtn:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
    }
    
    /* Icônes */
    #actionIcon {
        font-size: 12px;
    }
    
    /* Message quand pas de candidats */
    #noCandidates {
        text-align: center;
        color: #7f8c8d;
        padding: 40px;
        font-size: 16px;
    }
     #approveBtn[disabled], #declineBtn[disabled] {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none !important;
    }
</style>

<div id="candidatsSection">
    <h2 id="sectionTitle">Derniers candidats inscrits</h2>
    
    @if($candidats->count() > 0)
        <div id="candidatsGrid">
            @foreach ($candidats as $candidat)
                <div id="candidatCard">
                    <div id="candidatHeader">
                        <h3 id="candidatName">{{ $candidat->nom }} {{ $candidat->prenom }}</h3>
                    </div>
                    
                    <div id="candidatBody">
                        <div id="candidatDetails">
                            <strong>Email:</strong> {{ $candidat->email }}<br>
                            <strong>CV:</strong> 
                            @if($candidat->document)
                                <a id="cvLink" href="{{ asset('storage/'.$candidat->document) }}" target="_blank">Voir le CV</a>
                            @else
                                Non fourni
                            @endif
                        </div>
                    </div>
                    
                    <div id="candidatFooter">
                        <form action="{{ route('candidats.approuver', $candidat->id) }}" method="POST">
                            @csrf
                            <button type="submit" id="approveBtn">
                                <i id="actionIcon" class="fas fa-check"></i> Approuver
                            </button>
                        </form>
                        
                        <form action="{{ route('candidats.decliner', $candidat->id) }}" method="POST">
                            @csrf
                            <button type="submit" id="declineBtn">
                                <i id="actionIcon" class="fas fa-times"></i> Décliner
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div id="noCandidates">
            <p>Aucun nouveau candidat à afficher pour le moment.</p>
        </div>
    @endif
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const handleAction = (form, actionType) => {
        const confirmMessage = actionType === 'approve'
            ? "Êtes-vous sûr de vouloir approuver ce candidat ?"
            : "Êtes-vous sûr de vouloir décliner ce candidat ?";

        if (!confirm(confirmMessage)) {
            return;
        }

        const card = form.closest('#candidatCard');
        const approveBtn = card.querySelector('#approveBtn');
        const declineBtn = card.querySelector('#declineBtn');

        // Désactiver les deux boutons
        approveBtn.disabled = true;
        declineBtn.disabled = true;

        // Changer le texte et l’icône du bouton cliqué
        if (actionType === 'approve') {
            approveBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Approbation...`;
        } else {
            declineBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Rejet...`;
        }

        // Soumettre le formulaire après un petit délai (UX)
        setTimeout(() => form.submit(), 300);
    };

    document.querySelectorAll('form[action*="approuver"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            handleAction(this, 'approve');
        });
    });

    document.querySelectorAll('form[action*="decliner"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            handleAction(this, 'decline');
        });
    });
});
</script>

@endsection