@extends('layouts.app')

@section('title', 'Modifier un étudiant - Plateforme Scolaire')
@section('page-title', 'Modifier un étudiant')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('etudiants.index') }}">Étudiants</a></li>
    <li class="breadcrumb-item active">Modifier</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modifier les informations de l'étudiant</h3>
                </div>
                <form method="POST" action="{{ route('etudiants.update', $etudiant->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <h5><i class="icon fas fa-ban"></i> Erreur!</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom', $etudiant->prenom) }}" placeholder="Prénom de l'étudiant">
                            @error('prenom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}" placeholder="Nom de l'étudiant">
                            @error('nom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_naissance">Date de naissance</label>
                            <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance->format('Y-m-d')) }}">
                            @error('date_naissance')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Mettre à jour
                        </button>
                        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Aide</h3>
                </div>
                <div class="card-body">
                    <p><i class="fas fa-info-circle"></i> Modifiez les informations de l'étudiant.</p>
                    <p>Tous les champs sont obligatoires.</p>
                </div>
            </div>
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Zone de danger</h3>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteEtudiantModal">
                        <i class="fas fa-trash"></i> Supprimer cet étudiant
                    </button>
                </div>
            </div>

            <!-- Modal de confirmation de suppression -->
            <div class="modal fade" id="deleteEtudiantModal" tabindex="-1" role="dialog" aria-labelledby="deleteEtudiantModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="deleteEtudiantModalLabel">
                                Confirmation de suppression
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer l'étudiant <strong>{{ $etudiant->prenom }} {{ $etudiant->nom }}</strong>?
                            <br>Cette action est irréversible et supprimera également toutes ses notes.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style> <link rel="stylesheet" href="{{ asset('css/style.css') }}"></style>