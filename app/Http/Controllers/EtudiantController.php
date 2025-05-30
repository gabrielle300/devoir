<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Note;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    
    public function index()
    {
        $etudiants = Etudiant::orderBy('nom')->orderBy('prenom')->get();
        return view('etudiants.index', compact('etudiants'));
    }

    
    public function create()
    {
        return view('etudiants.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:100',
            'nom' => 'required|string|max:100',
            'date_naissance' => 'required|date',
        ]);

        Etudiant::create($request->all());

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant ajouté avec succès.');
    }

    
    public function show(Etudiant $etudiant)
    {
        $notes = Note::with('evaluation')
            ->where('etudiant_id', $etudiant->id)
            ->get();
            
       
        $moyenne = $notes->count() > 0 ? round($notes->avg('note'), 2) : 0;
        
        return view('etudiants.show', compact('etudiant', 'notes', 'moyenne'));
    }

    
    public function edit(Etudiant $etudiant)
    {
        return view('etudiants.edit', compact('etudiant'));
    }

    
    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'prenom' => 'required|string|max:100',
            'nom' => 'required|string|max:100',
            'date_naissance' => 'required|date',
        ]);

        $etudiant->update($request->all());

        return redirect()->route('etudiants.index')
            ->with('success', 'Informations de l\'étudiant mises à jour avec succès.');
    }

    
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant supprimé avec succès.');
    }
}