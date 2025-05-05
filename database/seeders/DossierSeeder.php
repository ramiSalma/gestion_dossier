<?php

namespace Database\Seeders;

use App\Models\dossier;
use App\Models\Liste;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DossierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listes = Liste::all();

        foreach ($listes as $liste) {
            dossier::factory()
                ->count(20)
                ->create([
                    'liste_id' => $liste->id,
                ]);
        }
    }
}
