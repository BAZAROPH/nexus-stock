<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    //

    function index(){
        $users = User::all();
        $roles = Roles::where("slug", "!=", "admin")->get();

        return view("layouts.users.index", [
            "users" => $users,
            "roles" => $roles
        ]);
    }

    public function store(Request $request){

        $validated = $request->validate([
            "email" => "required|email|unique:users,email",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "role_id" => "required|exists:roles,id",
        ]);
        $validated["password"] = Str::random(10);
        $params = ["password" => $validated["password"]];

        $user = User::create($validated);
        $user->sendEmailVerificationNotification($params);
        return redirect()->route("users.index")->with("success", "Utilisateur créé avec succès.");

    }

    public function update(Request $request, User $user){
        $validated = $request->validate([
            "email" => "required|email|unique:users,email," . $user->id,
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "role_id" => "required|exists:roles,id",
        ]);

        $user->update($validated);
        return redirect()->route("users.index")->with("success", "Utilisateur mis à jour avec succès.");

    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route("users.index")->with("success", "Utilisateur supprimé avec succès.");
    }

    public function restore(User $user){
        $user->restore();
        return redirect()->route("users.index")->with("success", "Utilisateur restauré avec succès.");
    }
}
