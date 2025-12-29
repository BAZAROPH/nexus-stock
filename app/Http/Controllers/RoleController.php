<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //
    public function index(){
        //
        $roles = Roles::all();

        return view("layouts.roles.index", [
            "roles" => $roles
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "label" => "required|string|unique:roles,label",
            "description" => "nullable|string",
            "permissions" => "required|nullable|array|exists:permissions,id|"
        ]);

        $role = Roles::create([
            "slug" => Str::slug($request->label),
            "label" => $request->label,
            "description" => $request->description
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect()->route("roles.index")->with("success", "Rôle créé avec succès.");
    }

    public function update(Request $request, Roles $role){
        $request->validate([
            "label" => "required|string|unique:roles,label,".$role->id,
            "description" => "nullable|string",
            "permissions" => "required|nullable|array|exists:permissions,id|"
        ]);

        $role->update([
            "slug" => Str::slug($request->label),
            "label" => $request->label,
            "description" => $request->description
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect()->route("roles.index")->with("success", "Rôle mis à jour avec succès.");
    }

    public function destroy(Roles $role){
        $role->delete();

        return redirect()->route("roles.index")->with("success", "Rôle supprimé avec succès.");
    }

    public function restore($id){
        $role = Roles::withTrashed()->findOrFail($id);
        $role->restore();

        return redirect()->route("roles.index")->with("success", "Rôle restauré avec succès.");
    }
}
