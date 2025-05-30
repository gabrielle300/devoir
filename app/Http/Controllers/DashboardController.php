<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Evaluation;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        $nombreEtudiants = Etudiant::count();
        
        
        $nombreEvaluations = Evaluation::count();
        
        
        $moyenneGenerale = Note::avg('note');
        $moyenneGenerale = $moyenneGenerale ? round($moyenneGenerale, 2) : 0;
        
        
        $meilleurEtudiant = null;
        $meilleureMoyenne = 0;
        
        
        $etudiants = Etudiant::all();
        foreach ($etudiants as $etudiant) {
            $notes = Note::where('etudiant_id', $etudiant->id)->get();
            if ($notes->count() > 0) {
                $moyenne = $notes->avg('note');
                if ($moyenne > $meilleureMoyenne) {
                    $meilleureMoyenne = $moyenne;
                    $meilleurEtudiant = $etudiant;
                }
            }
        }
        
      
        $activitesRecentes = Note::with(['etudiant', 'evaluation'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('dashboard', compact(
            'nombreEtudiants', 
            'nombreEvaluations', 
            'moyenneGenerale', 
            'meilleurEtudiant',
            'meilleureMoyenne',
            'activitesRecentes'
        ));
    }
}