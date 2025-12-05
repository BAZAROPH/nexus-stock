<?php

namespace Database\Seeders;

use App\Models\Permissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PERMISSIONS = [
            //User management Permissions
            [
                "slug" => "create_users",
                "label" => "Create Users",
                "description" => "Permission to create users in the system."
            ],
            [
                "slug" => "read_users",
                "label" => "Read Users",
                "description" => "Permission to read users in the system."
            ],
            [
                "slug" => "update_users",
                "label" => "Update Users",
                "description" => "Permission to update users in the system."
            ],
            [
                "slug" => "delete_users",
                "label" => "Delete Users",
                "description" => "Permission to delete users in the system."
            ],

            //Stocks Permissions
            [
                "slug" => "create_stocks",
                "label" => "Create Stocks",
                "description" => "Permission to create stocks in the system."
            ],
            [
                "slug" => "read_stocks",
                "label" => "Read Stocks",
                "description" => "Permission to read stocks in the system."
            ],
            [
                "slug" => "update_stocks",
                "label" => "Update Stocks",
                "description" => "Permission to update stocks in the system."
            ],
            [
                "slug" => "delete_stocks",
                "label" => "Delete Stocks",
                "description" => "Permission to delete stocks in the system."
            ],


            //Workers Permissions
            [
                "slug" => "create_workers",
                "label" => "Create Workers",
                "description" => "Permission to create workers in the system."
            ],
            [
                "slug" => "read_workers",
                "label" => "Read Workers",
                "description" => "Permission to read workers in the system."
            ],
            [
                "slug" => "update_workers",
                "label" => "Update Workers",
                "description" => "Permission to update workers in the system."
            ],
            [
                "slug" => "delete_workers",
                "label" => "Delete Workers",
                "description" => "Permission to delete workers in the system."
            ],

            //Allocations Permissions
            [
                "slug" => "create_allocations",
                "label" => "Create Allocations",
                "description" => "Permission to create allocations in the system."
            ],
            [
                "slug" => "read_allocations",
                "label" => "Read Allocations",
                "description" => "Permission to read allocations in the system."
            ],
            [
                "slug" => "update_allocations",
                "label" => "Update Allocations",
                "description" => "Permission to update allocations in the system."
            ],
            [
                "slug" => "delete_allocations",
                "label" => "Delete Allocations",
                "description" => "Permission to delete allocations in the system."
            ],

            //Sites Permissions
            [
                "slug" => "create_sites",
                "label" => "Create Sites",
                "description" => "Permission to create sites in the system."
            ],
            [
                "slug" => "read_sites",
                "label" => "Read Sites",
                "description" => "Permission to read sites in the system."
            ],
            [
                "slug" => "update_sites",
                "label" => "Update Sites",
                "description" => "Permission to update sites in the system."
            ],
            [
                "slug" => "delete_sites",
                "label" => "Delete Sites",
                "description" => "Permission to delete sites in the system."
            ],
        ];
        //

        foreach ($PERMISSIONS as $permission){
            Permissions::firstOrCreate(
                [
                    "slug" => $permission["slug"],
                    "label" => $permission["label"],
                    "description" => $permission["description"]
                ]
            );
        }

    }
}
