@extends('layouts.app')

@section('title', 'Liste des étudiants - Plateforme Scolaire')
@section('page-title', 'Liste des étudiants')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item active">Étudiants</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gestion des étudiants</h3>
                    <div class="card-tools">
                        <a href="{{ route('etudiants.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Ajouter un étudiant
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
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Date de naissance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($etudiants as $etudiant)
                                <tr>
                                    <td>{{ $etudiant->id }}</td>
                                    <td>{{ $etudiant->prenom }}</td>
                                    <td>{{ $etudiant->nom }}</td>
                                    <td>{{ $etudiant->date_naissance->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('etudiants.show', $etudiant->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $etudiant->id }}">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </div>

                                        <!-- Modal de confirmation de suppression -->
                                        <div class="modal fade" id="deleteModal{{ $etudiant->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $etudiant->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $etudiant->id }}">
                                                            Confirmation de suppression
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir supprimer l'étudiant <strong>{{ $etudiant->prenom }} {{ $etudiant->nom }}</strong>?
                                                        <br>Cette action est irréversible et supprimera également toutes ses notes.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                        <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" style="display: inline-block;">
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
                                    <td colspan="5" class="text-center">Aucun étudiant enregistré.</td>
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