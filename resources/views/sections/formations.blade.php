<section class="container my-5">
<div class="container py-5">
    <h2 class="text-center mb-4">Nos Filières</h2>

    @php
        $staticImages = [
            'images/filiere/info.jpg',
            'images/filiere/gestion.jpg',
            'images/filiere/reseau.jpg',
            
        ];

        shuffle($staticImages); // Mélange les images
        $randomImages = array_slice($staticImages, 0, 3); // Prend 3 au hasard
    @endphp

    <div class="row mb-4">
        @foreach($randomImages as $image)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset($image) }}" class="card-img-top" alt="Filière">
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mb-4">
        <p class="lead">
            Notre université offre une diversité de filières professionnelles : informatique, gestion,
            marketing, design, finance et bien plus encore. Chaque filière est pensée pour vous préparer 
            à un avenir professionnel prometteur.
        </p>
    </div>

    <div class="text-center">
        <a href="{{ route('filiere.page') }}" class="btn btn-primary">Voir toutes les Filières</a>
    </div>
</div>
</section>
