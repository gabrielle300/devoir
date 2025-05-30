@extends('layouts.app')

@section('title', 'Modifier une évaluation - Plateforme Scolaire')
@section('page-title', 'Modifier une évaluation')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Évaluations</a></li>
    <li class="breadcrumb-item active">Modifier</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modifier l'évaluation</h3>
                </div>
                <form method="POST" action="{{ route('evaluations.update', $evaluation->id) }}">
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
                            <label for="titre">Titre de l'évaluation</label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre', $evaluation->titre) }}" placeholder="Ex: Examen de Mathématiques">
                            @error('titre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $evaluation->date->format('Y-m-d')) }}">
                            @error('date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="type">Type d'évaluation</label>
                            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                                <option value="examen" {{ old('type', $evaluation->type) == 'examen' ? 'selected' : '' }}>Examen</option>
                                <option value="devoir" {{ old('type', $evaluation->type) == 'devoir' ? 'selected' : '' }}>Devoir</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Mettre à jour
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
                    <p><i class="fas fa-info-circle"></i> Modifiez les informations de l'évaluation.</p>
                    <p>Tous les champs sont obligatoires.</p>
                    <p><strong>Types d'évaluation :</strong></p>
                    <ul>
                        <li><strong>Examen</strong> : Évaluation formelle avec surveillance</li>
                        <li><strong>Devoir</strong> : Travail à rendre, contrôle continu</li>
                    </ul>
                </div>
            </div>
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Zone de danger</h3>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteEvaluationModal">
                        <i class="fas fa-trash"></i> Supprimer cette évaluation
                    </button>
                </div>
            </div>

            <!-- Modal de confirmation de suppression -->
            <div class="modal fade" id="deleteEvaluationModal" tabindex="-1" role="dialog" aria-labelledby="deleteEvaluationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="deleteEvaluationModalLabel">
                                Confirmation de suppression
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer l'évaluation <strong>{{ $evaluation->titre }}</strong>?
                            <br>Cette action est irréversible et supprimera également toutes les notes associées.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" style="display: inline-block;">
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