@extends('layouts.app')

@section('title', 'Saisie multiple de notes - Plateforme Scolaire')
@section('page-title', 'Saisie multiple de notes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('notes.index') }}">Notes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('notes.saisie') }}">Saisie par évaluation</a></li>
    <li class="breadcrumb-item active">{{ $evaluation->titre }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Saisie des notes pour : {{ $evaluation->titre }}
                        ({{ ucfirst($evaluation->type) }} du {{ $evaluation->date->format('d/m/Y') }})
                    </h3>
                </div>
                <form method="POST" action="{{ route('notes.saisie.sauvegarder', $evaluation->id) }}">
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

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="45%">Étudiant</th>
                                    <th width="45%">Note (sur 20)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($etudiants as $etudiant)
                                    <tr>
                                        <td>{{ $etudiant->id }}</td>
                                        <td>{{ $etudiant->prenom }} {{ $etudiant->nom }}</td>
                                        <td>
                                            <input type="number" step="0.25" min="0" max="20" 
                                                class="form-control @error('notes.' . $etudiant->id) is-invalid @enderror" 
                                                name="notes[{{ $etudiant->id }}]" 
                                                value="{{ old('notes.' . $etudiant->id, $notes[$etudiant->id] ?? '') }}" 
                                                placeholder="Saisir la note">
                                            @error('notes.' . $etudiant->id)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Aucun étudiant n'a été enregistré.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer toutes les notes
                        </button>
                        <a href="{{ route('notes.saisie') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Aide</h3>
                </div>
                <div class="card-body">
                    <p><i class="fas fa-info-circle"></i> Instructions :</p>
                    <ul>
                        <li>Entrez les notes pour chaque étudiant (sur 20)</li>
                        <li>Laissez vide pour les étudiants non évalués</li>
                        <li>Cliquez sur "Enregistrer toutes les notes" pour valider</li>
                    </ul>
                    <p><strong>Note :</strong> Les notes précédemment enregistrées seront mises à jour.</p>
                </div>
            </div>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Informations</h3>
                </div>
                <div class="card-body">
                    <p><strong>Évaluation :</strong> {{ $evaluation->titre }}</p>
                    <p><strong>Type :</strong> {{ ucfirst($evaluation->type) }}</p>
                    <p><strong>Date :</strong> {{ $evaluation->date->format('d/m/Y') }}</p>
                    <p><strong>Nombre d'étudiants :</strong> {{ count($etudiants) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
<style> <link rel="stylesheet" href="{{ asset('css/style.css') }}"></style>