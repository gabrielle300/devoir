@extends('layouts.app')

@section('title', 'Ajouter une évaluation - Plateforme Scolaire')
@section('page-title', 'Ajouter une évaluation')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Évaluations</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Informations de l'évaluation</h3>
                </div>
                <form method="POST" action="{{ route('evaluations.store') }}">
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
                            <label for="titre">Titre de l'évaluation</label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre') }}" placeholder="Ex: Examen de Mathématiques">
                            @error('titre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}">
                            @error('date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="type">Type d'évaluation</label>
                            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                                <option value="">-- Sélectionnez un type --</option>
                                <option value="examen" {{ old('type') == 'examen' ? 'selected' : '' }}>Examen</option>
                                <option value="devoir" {{ old('type') == 'devoir' ? 'selected' : '' }}>Devoir</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                        <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">
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
                    <p><i class="fas fa-info-circle"></i> Remplissez le formulaire pour ajouter une nouvelle évaluation.</p>
                    <p>Tous les champs sont obligatoires.</p>
                    <p><strong>Types d'évaluation :</strong></p>
                    <ul>
                        <li><strong>Examen</strong> : Évaluation formelle avec surveillance</li>
                        <li><strong>Devoir</strong> : Travail à rendre, contrôle continu</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
<style> <link rel="stylesheet" href="{{ asset('css/style.css') }}"></style>