<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Etudiant extends Model
{
    use HasFactory;

    
    protected $table = 'etudiants';

    
    protected $fillable = [
        'prenom',
        'nom',
        'date_naissance',
    ];

    
    protected $casts = [
        'date_naissance' => 'date',
    ];

   
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    
    public function getNomCompletAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

   
    public function getMoyenneAttribute(): float
    {
        if ($this->notes->isEmpty()) {
            return 0;
        }

        $sommeNotes = 0;
        $sommeCoefficients = 0;

        foreach ($this->notes as $note) {
            $evaluation = $note->evaluation;
            $coefficient = 1; // Coefficient par défaut
            
           
            $sommeNotes += $note->note * $coefficient;
            $sommeCoefficients += $coefficient;
        }

        return $sommeCoefficients > 0 ? round($sommeNotes / $sommeCoefficients, 2) : 0;
    }
}
