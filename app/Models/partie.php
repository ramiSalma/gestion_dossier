<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partie extends Model
{
    use HasFactory;

    protected $fillable = [ 'full_name', 'type'];

    public function dossiers()
    {
        return $this->belongsToMany(Dossier::class, 'dossier_partie');
    }
}
