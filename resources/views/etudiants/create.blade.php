@extends('layouts.app')

@section('title', 'Ajouter un étudiant - Plateforme Scolaire')
@section('page-title', 'Ajouter un étudiant')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('etudiants.index') }}">Étudiants</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Informations de l'étudiant</h3>
                </div>
                <form method="POST" action="{{ route('etudiants.store') }}">
                    @csrf
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
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" placeholder="Prénom de l'étudiant">
                            @error('prenom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Nom de l'étudiant">
                            @error('nom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_naissance">Date de naissance</label>
                            <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}">
                            @error('date_naissance')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
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
                    <p><i class="fas fa-info-circle"></i> Remplissez le formulaire pour ajouter un nouvel étudiant.</p>
                    <p>Tous les champs sont obligatoires.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
<style> <link rel="stylesheet" href="{{ asset('css/style.css') }}"></style>