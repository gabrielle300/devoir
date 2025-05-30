@extends('layouts.app')

@section('title', 'Liste des notes - Plateforme Scolaire')
@section('page-title', 'Liste des notes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item active">Notes</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gestion des notes</h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <a href="{{ route('notes.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Ajouter une note
                            </a>
                            <a href="{{ route('notes.saisie') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-list"></i> Saisie par évaluation
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Succès!</h5>
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Étudiant</th>
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
                                    <td>{{ $note->id }}</td>
                                    <td>
                                        <a href="{{ route('etudiants.show', $note->etudiant->id) }}">
                                            {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('evaluations.show', $note->evaluation->id) }}">
                                            {{ $note->evaluation->titre }}
                                        </a>
                                    </td>
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
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $note->id }}">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </div>

                                        <!-- Modal de confirmation de suppression -->
                                        <div class="modal fade" id="deleteModal{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $note->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $note->id }}">
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
                                    <td colspan="7" class="text-center">Aucune note enregistrée.</td>
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