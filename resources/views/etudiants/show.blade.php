@extends('layouts.app')

@section('title', 'Détails de l\'étudiant - Plateforme Scolaire')
@section('page-title', 'Détails de l\'étudiant')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('etudiants.index') }}">Étudiants</a></li>
    <li class="breadcrumb-item active">{{ $etudiant->prenom }} {{ $etudiant->nom }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- Carte d'information -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Informations de l'étudiant</h3>
                </div>
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="https://ui-avatars.com/api/?name={{ urlencode($etudiant->prenom . '+' . $etudiant->nom) }}&background=random"
                            alt="Photo de l'étudiant">
                    </div>
                    <h3 class="profile-username text-center">{{ $etudiant->prenom }} {{ $etudiant->nom }}</h3>
                    <p class="text-muted text-center">Étudiant</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>ID</b> <a class="float-right">{{ $etudiant->id }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Date de naissance</b> <a class="float-right">{{ $etudiant->date_naissance->format('d/m/Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Moyenne générale</b> <a class="float-right">{{ $moyenne }}/20</a>
                        </li>
                    </ul>
                    <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning btn-block">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Tableau des notes -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notes de l'étudiant</h3>
                    <div class="card-tools">
                        <a href="{{ route('notes.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Ajouter une note
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Évaluation</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Note</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notes as $note)
                                <tr>
                                    <td>{{ $note->evaluation->titre }}</td>
                                    <td>
                                        @if($note->evaluation->type == 'examen')
                                            <span class="badge bg-danger">Examen</span>
                                        @else
                                            <span class="badge bg-info">Devoir</span>
                                        @endif
                                    </td>
                                    <td>{{ $note->evaluation->date->format('d/m/Y') }}</td>
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
                                    <td colspan="5" class="text-center">Aucune note enregistrée pour cet étudiant.</td>
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