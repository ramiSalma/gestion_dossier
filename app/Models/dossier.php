<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dossier extends Model
{
    /** @use HasFactory<\Database\Factories\DossierFactory> */
    use HasFactory;
  


    protected $fillable = ['num', 'code', 'annee'];
    protected $casts = [
        'date_archivage' => 'date', // This ensures date_archivage is a Carbon instance
    ];


    public function liste()
    {
        return $this->belongsTo(Liste::class, 'liste_id');

    }

    public function parties()
    {
        return $this->belongsToMany(Partie::class, 'dossier_partie');
    }
}
