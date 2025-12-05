<?php

namespace Database\Seeders;

use App\Models\Sites;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $SITES = [
            [
                "slug" => "vnd",
                "name" => "Val de notre dame",
                "address" => "1 rue de érable, 95000 Argenteuil"
            ],
            [
                "slug" => "VRD",
                "name" => "Versailles Rive Droite",
                "address" => "Impasse de clagny, 78000 Versailles"
            ],
        ];

        foreach( $SITES as $site){
            Sites::firstOrCreate(
                [
                    "slug" => $site["slug"],
                    "name" => $site["name"],
                    "address" => $site["address"]
                ]
            );
        }
    }
}
