<?php

namespace Database\Seeders;

use App\Models\dossier;
use App\Models\partie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dossier::factory(10)->create()->each(function ($dossier) {
            $motaham = Partie::factory()->create(['type' => 'متهم']);
            $dahiya = Partie::factory()->create(['type' => 'ضحية']);

            $dossier->parties()->attach([$motaham->id, $dahiya->id]);
        });

    }
}
