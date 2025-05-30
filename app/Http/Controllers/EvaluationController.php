<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Note;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    
    public function index()
    {
        $evaluations = Evaluation::orderBy('date', 'desc')->get();
        return view('evaluations.index', compact('evaluations'));
    }

    
    public function create()
    {
        return view('evaluations.create');
    }

 
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:200',
            'date' => 'required|date',
            'type' => 'required|in:examen,devoir',
        ]);

        Evaluation::create($request->all());

        return redirect()->route('evaluations.index')
            ->with('success', 'Évaluation créée avec succès.');
    }

    
    public function show(Evaluation $evaluation)
    {
        $notes = Note::with('etudiant')
            ->where('evaluation_id', $evaluation->id)
            ->get();
            
        // Calculer les statistiques
        $moyenne = $notes->count() > 0 ? round($notes->avg('note'), 2) : 0;
        $noteMax = $notes->count() > 0 ? $notes->max('note') : 0;
        $noteMin = $notes->count() > 0 ? $notes->min('note') : 0;
        
        return view('evaluations.show', compact('evaluation', 'notes', 'moyenne', 'noteMax', 'noteMin'));
    }

    
    public function edit(Evaluation $evaluation)
    {
        return view('evaluations.edit', compact('evaluation'));
    }

    
    public function update(Request $request, Evaluation $evaluation)
    {
        $request->validate([
            'titre' => 'required|string|max:200',
            'date' => 'required|date',
            'type' => 'required|in:examen,devoir',
        ]);

        $evaluation->update($request->all());

        return redirect()->route('evaluations.index')
            ->with('success', 'Évaluation mise à jour avec succès.');
    }

    
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();

        return redirect()->route('evaluations.index')
            ->with('success', 'Évaluation supprimée avec succès.');
    }
}