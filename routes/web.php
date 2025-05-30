<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\NoteController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::resource('etudiants', EtudiantController::class);


Route::resource('evaluations', EvaluationController::class);


Route::resource('notes', NoteController::class);


Route::get('/saisie-notes', [NoteController::class, 'saisieParEvaluation'])->name('notes.saisie');
Route::get('/saisie-notes/{evaluation}', [NoteController::class, 'saisieMultiple'])->name('notes.saisie.multiple');
Route::post('/saisie-notes/{evaluation}', [NoteController::class, 'sauvegarderMultiple'])->name('notes.saisie.sauvegarder');