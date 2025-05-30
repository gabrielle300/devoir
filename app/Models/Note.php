<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'etudiant_id',
        'evaluation_id',
        'note',
    ];

    
    protected $casts = [
        'note' => 'float',
    ];

    
    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }

   
    public function evaluation(): BelongsTo
    {
        return $this->belongsTo(Evaluation::class);
    }
}
