<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Création d'un nouvel administrateur";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Récupération des données
        $first_name = $this->ask("Prénom");
        $last_name = $this->ask("Nom");
        $email = $this->ask("Email");
        $password = $this->secret("Mot de passe (masqué)");

        //Validation simple

        $validator = Validator::make([
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "password" => $password,
        ], [
            "first_name" => ["required", "string", "max:255"],
            "last_name" => ["required", "string", "max:255"],
            "email" => ["required", "email", "max:255", "unique:users"],
            "password" => ["required", "string", "min:8"],
        ]);

        if($validator->fails()){
            $this->error("Erreur lors de la création");

            foreach($validator->errors()->all() as $error){
                $this->line("- $error");
            }
        }

        //Création de l'utilisateur
        $user = User::create([
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "password" => Hash::make($password),
            "role_id" => 1,
            "first_login" => false,
        ]);

        $user->markEmailAsVerified();

        $this->info("L'administrateur {$user->name} a été créé avec succès !");
        return 0;
    }
}
