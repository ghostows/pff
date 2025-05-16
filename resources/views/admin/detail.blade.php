<h2>Détails de la classe {{ $classe->nom }}</h2>

<h3>Moyenne par Matière</h3>
<ul>
  @foreach($matieres as $matiere => $moyenne)
    <li>{{ $matiere }} : {{ number_format($moyenne, 2) }}</li>
  @endforeach
</ul>

<h3>Top 3 Étudiants</h3>
<ol>
  @foreach($topEtudiants as $etudiant)
    <li>{{ $etudiant['nom'] }} - Moyenne : {{ number_format($etudiant['moyenne'], 2) }}</li>
  @endforeach
</ol>

<h3>Top 3 Étudiants les plus absents</h3>
<ol>
  @foreach($absents as $etudiant)
    <li>{{ $etudiant['nom'] }} - {{ $etudiant['absences'] }} absences</li>
  @endforeach
</ol>
