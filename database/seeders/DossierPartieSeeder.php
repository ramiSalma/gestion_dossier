<?php

namespace Database\Seeders;

use App\Models\dossier;
use App\Models\partie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DossierPartieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dossiers = Dossier::all();
        $parties = Partie::all();

        
        foreach ($dossiers as $dossier) {
           
            $randomParties = $parties->random(rand(2, 3));  
            
            foreach ($randomParties as $partie) {
                $dossier->parties()->attach($partie->id);  
            }
        }
    }
}
