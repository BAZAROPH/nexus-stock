<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ROLES = [
            [
                "slug" => "admin",
                "label" => "Administrator",
                "description" => "Administrator with full permissions."
            ],
            [
                "slug" => "rqse",
                "label" => "Responsible QSE",
                "description" => "Responsible for Quality, Safety, Environment and Sustainability."
            ],
            [
                "slug" => "qse",
                "label" => "QSE",
                "description" => "Quality, Safety, Environment and Sustainability."
            ],
            [
                "slug" => "qse_student",
                "label" => "QSE_student",
                "description" => "Work-study student in Quality, Safety, Environment and Sustainability."
            ],
            [
                "slug" => "rsupervisor",
                "label" => "Responsible supervisor",
                "description" => "Responsible for supervising teams and operations."
            ],
            [
                "slug" => "supervisor",
                "label" => "supervisor",
                "description" => "Supervising teams and operations."
            ],
        ];

        foreach( $ROLES as $role){
            Roles::firstOrCreate(
                [
                    "slug" => $role["slug"],
                    "label" => $role["label"],
                    "description" => $role["description"]
                ]
            );
        }
    }
}
