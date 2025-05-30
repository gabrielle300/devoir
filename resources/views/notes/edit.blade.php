@extends('layouts.app')

@section('title', 'Modifier une note - Plateforme Scolaire')
@section('page-title', 'Modifier une note')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('notes.index') }}">Notes</a></li>
    <li class="breadcrumb-item active">Modifier</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Modifier une note</h3>
                </div>
                <form method="POST" action="{{ route('notes.update', $note->id) }}">
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
                            <label for="etudiant_id">Étudiant</label>
                            <select class="form-control @error('etudiant_id') is-invalid @enderror" id="etudiant_id" name="etudiant_id">
                                @foreach($etudiants as $etudiant)
                                    <option value="{{ $etudiant->id }}" {{ old('etudiant_id', $note->etudiant_id) == $etudiant->id ? 'selected' : '' }}>
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
                                @foreach($evaluations as $evaluation)
                                    <option value="{{ $evaluation->id }}" {{ old('evaluation_id', $note->evaluation_id) == $evaluation->id ? 'selected' : '' }}>
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
                            <input type="number" step="0.25" min="0" max="20" class="form-control @error('note') is-invalid @enderror" id="note" name="note" value="{{ old('note', $note->note) }}" placeholder="Exemple: 15.5">
                            @error('note')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Mettre à jour
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
                    <p><i class="fas fa-info-circle"></i> Modifiez les informations de la note.</p>
                    <p>Tous les champs sont obligatoires.</p>
                    <p>La note doit être comprise entre 0 et 20.</p>
                    <p>Note : Un étudiant ne peut avoir qu'une seule note par évaluation.</p>
                </div>
            </div>
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Zone de danger</h3>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteNoteModal">
                        <i class="fas fa-trash"></i> Supprimer cette note
                    </button>
                </div>
            </div>

            <!-- Modal de confirmation de suppression -->
            <div class="modal fade" id="deleteNoteModal" tabindex="-1" role="dialog" aria-labelledby="deleteNoteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="deleteNoteModalLabel">
                                Confirmation de suppression
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer cette note?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display: inline-block;">
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