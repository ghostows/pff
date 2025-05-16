@extends('layouts.app')

@section('content')
<div class="candidate-application py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="row no-gutters">
                        <!-- Left Column - Information -->
                        <div class="col-md-5 bg-light p-4">
                            <div class="h-100 d-flex flex-column">
                                <h2 class="mb-4">Postuler à notre formation</h2>
                                <p class="text-muted mb-4">Remplissez ce formulaire pour soumettre votre candidature.</p>
                                
                                <div class="bg-white p-3 mb-4 rounded">
                                    <h5 class="mb-3"><i class="fas fa-file-alt text-primary mr-2"></i>Documents requis :</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary mr-2"></i> Photo d'identité récente</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary mr-2"></i> Copie de la CIN</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary mr-2"></i> Dernier certificat scolaire</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary mr-2"></i> CV à jour</li>
                                    </ul>
                                </div>
                                
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary text-white rounded-circle p-2 mr-3">
                                            <i class="fas fa-phone-alt fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Support candidature</h6>
                                            <p class="mb-0 text-muted">+212 6 12 34 56 78</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle p-2 mr-3">
                                            <i class="fas fa-envelope fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Email</h6>
                                            <p class="mb-0 text-muted">admissions@ecole.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column - Form -->
                        <div class="col-md-7 p-4">
                            <h3 class="mb-4 text-center">Formulaire de candidature</h3>
                            
                            @if ($errors->any())
                            <div class="alert alert-danger rounded mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle mr-3"></i>
                                    <div>
                                        <h6 class="mb-1">Erreurs dans le formulaire</h6>
                                        <ul class="mb-0 pl-3">
                                            @foreach ($errors->all() as $error)
                                                <li class="small">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <form action="{{ route('inscription.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nom">Nom</label>
                                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                                        @error('nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="prenom">Prénom</label>
                                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                                        @error('prenom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="age">Âge</label>
                                        <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}" min="16" max="60" required>
                                        @error('age')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="cin">Numéro CIN</label>
                                    <input type="text" class="form-control @error('cin') is-invalid @enderror" id="cin" name="cin" value="{{ old('cin') }}" required>
                                    @error('cin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="adresse">Adresse complète</label>
                                    <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
                                    @error('adresse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>Photo d'identité</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*" required>
                                        <label class="custom-file-label" for="photo">Choisir un fichier...</label>
                                        <small class="form-text text-muted">Format JPG/PNG, taille max 2MB</small>
                                        @error('photo')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="niveau_scolaire">Dernier certificat scolaire</label>
                                    <select class="custom-select @error('niveau_scolaire') is-invalid @enderror" id="niveau_scolaire" name="niveau_scolaire" required>
                                        <option value="">-- Choisir --</option>
                                        <option value="bac" @if(old('niveau_scolaire') == 'bac') selected @endif>Bac</option>
                                        <option value="niveau_bac" @if(old('niveau_scolaire') == 'niveau_bac') selected @endif>Niveau Bac</option>
                                        <option value="troisieme" @if(old('niveau_scolaire') == 'troisieme') selected @endif>3ème année collège</option>
                                        <option value="primaire" @if(old('niveau_scolaire') == 'primaire') selected @endif>Certificat primaire</option>
                                    </select>
                                    @error('niveau_scolaire')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>CV (PDF uniquement)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('document') is-invalid @enderror" id="document" name="document" accept=".pdf,.doc,.docx" required>
                                        <label class="custom-file-label" for="document">Choisir un fichier...</label>
                                        <small class="form-text text-muted">Format PDF/DOC, taille max 5MB</small>
                                        @error('document')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input @error('confirmation') is-invalid @enderror" id="confirmation" name="confirmation" required>
                                    <label class="form-check-label" for="confirmation">
                                        Je certifie que les informations fournies sont exactes et complètes
                                    </label>
                                    @error('confirmation')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-paper-plane mr-2"></i> Soumettre ma candidature
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .candidate-application {
        background-color: #f8f9fa;
        min-height: calc(100vh - 120px);
    }
    
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .requirements-list {
        background: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .requirements-list li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f1f1f1;
    }
    
    .custom-file-label::after {
        content: "Parcourir";
    }
    
    .btn-primary {
        background: linear-gradient(to right, #4e54c8, #8f94fb);
        border: none;
        border-radius: 50px;
        padding: 10px 30px;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 84, 200, 0.3);
    }
    
    @media (max-width: 768px) {
        .no-gutters > .col-md-5, 
        .no-gutters > .col-md-7 {
            padding: 1.5rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Update file input labels
    $(document).ready(function() {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
        
        // Form submission handling
        $('form').on('submit', function() {
            $(this).find('button[type="submit"]').prop('disabled', true)
                .html('<span class="spinner-border spinner-border-sm mr-2" role="status"></span> Envoi en cours...');
        });
    });
</script>
@endpush
@endsection