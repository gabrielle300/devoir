@extends('layouts.app')

@section('title', 'Liste des évaluations - Plateforme Scolaire')
@section('page-title', 'Liste des évaluations')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item active">Évaluations</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gestion des évaluations</h3>
                    <div class="card-tools">
                        <a href="{{ route('evaluations.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Ajouter une évaluation
                        </a>
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
                                <th>Titre</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($evaluations as $evaluation)
                                <tr>
                                   <td>{{ $evaluation->id }}</td>
                                    <td>{{ $evaluation->titre }}</td>
                                    <td>
                                        @if($evaluation->type == 'examen')
                                            <span class="badge bg-danger">Examen</span>
                                        @else
                                            <span class="badge bg-info">Devoir</span>
                                        @endif
                                    </td>
                                    <td>{{ $evaluation->date->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('evaluations.show', $evaluation->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                            <a href="{{ route('notes.saisie.multiple', $evaluation->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-star"></i> Saisir notes
                                            </a>
                                            <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $evaluation->id }}">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </div>

                                        <!-- Modal de confirmation de suppression -->
                                        <div class="modal fade" id="deleteModal{{ $evaluation->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $evaluation->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $evaluation->id }}">
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucune évaluation enregistrée.</td>
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