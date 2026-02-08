<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitProduction extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-production';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the application for production (seeders & admin creation)';

    public function handle()
    {
        $this->info('Starting production initialization...');

        $this->info('Seeding Permissions...');
        $this->call('db:seed', ['--class' => 'PermissionSeeder']);

        $this->info('Seeding Roles...');
        $this->call('db:seed', ['--class' => 'RoleSeeder']);

        $this->info('Seeding Sites...');
        $this->call('db:seed', ['--class' => 'SiteSeeder']);

        $this->info('Seeding Worker Types...');
        $this->call('db:seed', ['--class' => 'WorkerTypeSeeder']);

        $this->info('Creating Admin User...');
        $email = $this->ask('Enter Admin Email');
        $password = $this->secret('Enter Admin Password');

        $user = \App\Models\User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'email' => $email,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $adminRole = \App\Models\Roles::where('slug', 'admin')->first();
        if($adminRole){
             $user->roles()->attach($adminRole->id);
             $this->info('Admin role assigned.');
        } else {
            $this->error('Admin role not found! Please check RoleSeeder.');
        }

        // Assign all permissions to admin role
        if($adminRole){
            $permissions = \App\Models\Permissions::all();
            $adminRole->permissions()->sync($permissions->pluck('id'));
            $this->info('All permissions assigned to Admin role.');
        }

        $this->info('Production initialization completed successfully!');
    }
}
