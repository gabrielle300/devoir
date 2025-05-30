<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Afficher la liste des notes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $notes = Note::with(['etudiant', 'evaluation'])->get();
        return view('notes.index', compact('notes'));
    }

    /**
     * Afficher le formulaire pour ajouter une note.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $etudiants = Etudiant::orderBy('nom')->orderBy('prenom')->get();
        $evaluations = Evaluation::orderBy('date', 'desc')->get();
        
        return view('notes.create', compact('etudiants', 'evaluations'));
    }

    /**
     * Stocker une nouvelle note dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'evaluation_id' => 'required|exists:evaluations,id',
            'note' => 'required|numeric|min:0|max:20',
        ]);

        // Vérifier si la note existe déjà pour cet étudiant et cette évaluation
        $noteExistante = Note::where('etudiant_id', $request->etudiant_id)
            ->where('evaluation_id', $request->evaluation_id)
            ->first();
            
        if ($noteExistante) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Une note existe déjà pour cet étudiant et cette évaluation.']);
        }

        Note::create($request->all());

        return redirect()->route('notes.index')
            ->with('success', 'Note ajoutée avec succès.');
    }

    /**
     * Afficher les détails d'une note spécifique.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\View\View
     */
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Afficher le formulaire pour modifier une note.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\View\View
     */
    public function edit(Note $note)
    {
        $etudiants = Etudiant::orderBy('nom')->orderBy('prenom')->get();
        $evaluations = Evaluation::orderBy('date', 'desc')->get();
        
        return view('notes.edit', compact('note', 'etudiants', 'evaluations'));
    }

    
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'evaluation_id' => 'required|exists:evaluations,id',
            'note' => 'required|numeric|min:0|max:20',
        ]);

        // Vérifier si la note existe déjà pour un autre enregistrement
        if ($request->etudiant_id != $note->etudiant_id || $request->evaluation_id != $note->evaluation_id) {
            $noteExistante = Note::where('etudiant_id', $request->etudiant_id)
                ->where('evaluation_id', $request->evaluation_id)
                ->where('id', '!=', $note->id)
                ->first();
                
            if ($noteExistante) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['message' => 'Une note existe déjà pour cet étudiant et cette évaluation.']);
            }
        }

        $note->update($request->all());

        return redirect()->route('notes.index')
            ->with('success', 'Note mise à jour avec succès.');
    }

    
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index')
            ->with('success', 'Note supprimée avec succès.');
    }

   
    public function saisieParEvaluation()
    {
        $evaluations = Evaluation::orderBy('date', 'desc')->get();
        return view('notes.saisie_par_evaluation', compact('evaluations'));
    }

    
    public function saisieMultiple($evaluation_id)
    {
        $evaluation = Evaluation::findOrFail($evaluation_id);
        $etudiants = Etudiant::orderBy('nom')->orderBy('prenom')->get();
        
        // Récupérer les notes existantes
        $notes = Note::where('evaluation_id', $evaluation_id)->pluck('note', 'etudiant_id');
        
        return view('notes.saisie_multiple', compact('evaluation', 'etudiants', 'notes'));
    }

   
    public function sauvegarderMultiple(Request $request, $evaluation_id)
    {
        $evaluation = Evaluation::findOrFail($evaluation_id);
        
        
        $request->validate([
            'notes' => 'required|array',
            'notes.*' => 'nullable|numeric|min:0|max:20',
        ]);
        
        foreach ($request->notes as $etudiant_id => $valeur_note) {
            if ($valeur_note !== null) {
                
                Note::updateOrCreate(
                    ['etudiant_id' => $etudiant_id, 'evaluation_id' => $evaluation_id],
                    ['note' => $valeur_note]
                );
            }
        }
        
        return redirect()->route('notes.index')
            ->with('success', 'Notes enregistrées avec succès pour l\'évaluation: ' . $evaluation->titre);
    }
}