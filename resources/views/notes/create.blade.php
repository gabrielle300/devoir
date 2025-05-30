@extends('layouts.app')

@section('title', 'Ajouter une note - Plateforme Scolaire')
@section('page-title', 'Ajouter une note')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('notes.index') }}">Notes</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ajouter une note</h3>
                </div>
                <form method="POST" action="{{ route('notes.store') }}">
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
                            <label for="etudiant_id">Étudiant</label>
                            <select class="form-control @error('etudiant_id') is-invalid @enderror" id="etudiant_id" name="etudiant_id">
                                <option value="">-- Sélectionnez un étudiant --</option>
                                @foreach($etudiants as $etudiant)
                                    <option value="{{ $etudiant->id }}" {{ old('etudiant_id') == $etudiant->id ? 'selected' : '' }}>
                                        {{ $etudiant->prenom }} {{ $etudiant->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('etudiant_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="evaluation_id">Évaluation</label>
                            <select class="form-control @error('evaluation_id') is-invalid @enderror" id="evaluation_id" name="evaluation_id">
                                <option value="">-- Sélectionnez une évaluation --</option>
                                @foreach($evaluations as $evaluation)
                                    <option value="{{ $evaluation->id }}" {{ old('evaluation_id') == $evaluation->id ? 'selected' : '' }}>
                                        {{ $evaluation->titre }} ({{ ucfirst($evaluation->type) }} du {{ $evaluation->date->format('d/m/Y') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('evaluation_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="note">Note (sur 20)</label>
                            <input type="number" step="0.25" min="0" max="20" class="form-control @error('note') is-invalid @enderror" id="note" name="note" value="{{ old('note') }}" placeholder="Exemple: 15.5">
                            @error('note')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                        <a href="{{ route('notes.index') }}" class="btn btn-secondary">
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
                    <p><i class="fas fa-info-circle"></i> Remplissez le formulaire pour ajouter une note.</p>
                    <p>Tous les champs sont obligatoires.</p>
                    <p>La note doit être comprise entre 0 et 20.</p>
                    <p>Note : Un étudiant ne peut avoir qu'une seule note par évaluation.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
<style> <link rel="stylesheet" href="{{ asset('css/style.css') }}"></style>