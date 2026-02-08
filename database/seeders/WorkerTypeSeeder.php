<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $TYPES = [
            "CDI" => "Contrat à durée indéterminée",
            "CDD" => "Contrat à durée déterminée",
            "Intérim" => "Travail temporaire",
            "Stage" => "Stage étudiant",
            "Alternance" => "Contrat d'apprentissage ou de professionnalisation"
        ];

        foreach ($TYPES as $name => $description) {
            \App\Models\WorkerTypes::firstOrCreate(
                ['name' => $name],
                ['description' => $description]
            );
        }
    }
}
