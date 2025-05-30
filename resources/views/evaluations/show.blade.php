@extends('layouts.app')

@section('title', 'Détails de l\'évaluation - Plateforme Scolaire')
@section('page-title', 'Détails de l\'évaluation')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Évaluations</a></li>
    <li class="breadcrumb-item active">{{ $evaluation->titre }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- Carte d'information -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Informations de l'évaluation</h3>
                </div>
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">{{ $evaluation->titre }}</h3>
                    <p class="text-muted text-center">
                        @if($evaluation->type == 'examen')
                            <span class="badge bg-danger">Examen</span>
                        @else
                            <span class="badge bg-info">Devoir</span>
                        @endif
                    </p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>ID</b> <a class="float-right">{{ $evaluation->id }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Date</b> <a class="float-right">{{ $evaluation->date->format('d/m/Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Nombre de notes</b> <a class="float-right">{{ $notes->count() }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Moyenne</b> <a class="float-right">{{ $moyenne }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Note maximale</b> <a class="float-right">{{ $noteMax }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Note minimale</b> <a class="float-right">{{ $noteMin }}</a>
                        </li>
                    </ul>
                    <div class="btn-group w-100">
                        <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('notes.saisie.multiple', $evaluation->id) }}" class="btn btn-success">
                            <i class="fas fa-star"></i> Saisir notes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Tableau des notes -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notes enregistrées</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Étudiant</th>
                                <th>Note</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notes as $note)
                                <tr>
                                    <td>{{ $note->id }}</td>
                                    <td>{{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}</td>
                                    <td>{{ $note->note }}/20</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteNoteModal{{ $note->id }}">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </div>

                                        <!-- Modal de confirmation de suppression de note -->
                                        <div class="modal fade" id="deleteNoteModal{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteNoteModalLabel{{ $note->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title" id="deleteNoteModalLabel{{ $note->id }}">
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucune note enregistrée pour cette évaluation.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<style> <link rel="stylesheet" href="{{ asset('css/style.css') }}"></style>