@extends('layouts.app')

@section('title', 'Saisie des notes par évaluation - Plateforme Scolaire')
@section('page-title', 'Saisie des notes par évaluation')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
    <li class="breadcrumb-item"><a href="{{ route('notes.index') }}">Notes</a></li>
    <li class="breadcrumb-item active">Saisie par évaluation</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Choisissez une évaluation</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($evaluations as $evaluation)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $evaluation->titre }}</h5>
                                        <p class="card-text">
                                            <span class="badge {{ $evaluation->type == 'examen' ? 'bg-danger' : 'bg-info' }}">
                                                {{ ucfirst($evaluation->type) }}
                                            </span>
                                            <br>Date : {{ $evaluation->date->format('d/m/Y') }}
                                        </p>
                                        <a href="{{ route('notes.saisie.multiple', $evaluation->id) }}" class="btn btn-primary btn-block">
                                            <i class="fas fa-pen-alt"></i> Saisir les notes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i> Information</h5>
                                    Aucune évaluation n'a été créée pour le moment.
                                    <a href="{{ route('evaluations.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus"></i> Créer une évaluation
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style> <link rel="stylesheet" href="{{ asset('css/style.css') }}"></style>