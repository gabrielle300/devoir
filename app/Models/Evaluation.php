<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evaluation extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'titre',
        'date',
        'type',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    
    public function getMoyenneAttribute(): float
    {
        $notes = $this->notes;
        
        if ($notes->isEmpty()) {
            return 0;
        }
        
        return round($notes->avg('note'), 2);
    }

    
    public function getNoteMaxAttribute(): float
    {
        return $this->notes->isEmpty() ? 0 : round($this->notes->max('note'), 2);
    }

   
    public function getNoteMinAttribute(): float
    {
        return $this->notes->isEmpty() ? 0 : round($this->notes->min('note'), 2);
    }
}
