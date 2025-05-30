@extends('layouts.app')

@section('title', 'Tableau de bord - Plateforme Scolaire')
@section('page-title', 'Tableau de bord')

@section('breadcrumb')
    <li class="breadcrumb-item active">Accueil</li>
@endsection

@section('content')
    <!-- Cartes de statistiques -->
    <div class="row">
        <!-- Nombre d'étudiants -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $nombreEtudiants }}</h3>
                    <p>Étudiants inscrits</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('etudiants.index') }}" class="small-box-footer">
                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Nombre d'évaluations -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $nombreEvaluations }}</h3>
                    <p>Évaluations créées</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <a href="{{ route('evaluations.index') }}" class="small-box-footer">
                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Moyenne générale -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $moyenneGenerale }}</h3>
                    <p>Moyenne générale</p>
                </div>
                <div class="icon">
                    <i class="fas fa-star"></i>
                </div>
                <a href="{{ route('notes.index') }}" class="small-box-footer">
                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Meilleur étudiant -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $meilleurEtudiant ? $meilleureMoyenne : '-' }}</h3>
                    <p>{{ $meilleurEtudiant ? $meilleurEtudiant->prenom . ' ' . $meilleurEtudiant->nom : 'Aucun étudiant' }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-trophy"></i>
                </div>
                @if($meilleurEtudiant)
                <a href="{{ route('etudiants.show', $meilleurEtudiant->id) }}" class="small-box-footer">
                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                </a>
                @else
                <a href="#" class="small-box-footer">
                    Pas de données <i class="fas fa-info-circle"></i>
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Section d'activités récentes -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clock mr-1"></i>
                        Activités récentes
                    </h3>
                </div>
                <div class="card-body">
                    @if(count($activitesRecentes) > 0)
                        <div class="timeline">
                            @foreach($activitesRecentes as $note)
                                <div>
                                    <i class="fas fa-star bg-warning"></i>
                                    <div class="timeline-item">
                                        <span class="time">
                                            <i class="fas fa-clock"></i> 
                                            {{ $note->created_at->format('d/m/Y H:i') }}
                                        </span>
                                        <h3 class="timeline-header">
                                            <a href="{{ route('etudiants.show', $note->etudiant->id) }}">
                                                {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}
                                            </a> 
                                            a obtenu <strong>{{ $note->note }}/20</strong>
                                        </h3>
                                        <div class="timeline-body">
                                            Évaluation : 
                                            <a href="{{ route('evaluations.show', $note->evaluation->id) }}">
                                                {{ $note->evaluation->titre }}
                                            </a>
                                            ({{ ucfirst($note->evaluation->type) }} du {{ $note->evaluation->date->format('d/m/Y') }})
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Bienvenue sur la plateforme de gestion scolaire ! 
                            Commencez par ajouter des étudiants et créer des évaluations.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<style> <link rel="stylesheet" href="{{ asset('css/style.css') }}"></style>