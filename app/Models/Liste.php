<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{
    
    use HasFactory;
    protected $fillable = ['date_creation', 'date_envoi'];
   
    protected $casts = [
        'date_creation' => 'date',
        'date_envoi' => 'date', // THIS is the fix!
    ];
    public function dossier()
    {
        return $this->hasMany(Dossier::class, 'liste_id');
    }
    
}
