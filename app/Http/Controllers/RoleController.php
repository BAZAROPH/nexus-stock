<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //
    public function index(Request $request){
        if($request->has("view") && $request->view == "trash"){
            $roles = Roles::onlyTrashed()->get();
        }else{
            $roles = Roles::all();
        }
        
        $permissions = \App\Models\Permissions::all();

        return view("layouts.roles.index", [
            "roles" => $roles,
            "permissions" => $permissions,
            "isTrash" => $request->has("view") && $request->view == "trash"
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "label" => "required|string|unique:roles,label",
            "description" => "nullable|string",
            "permissions" => "nullable|array|exists:permissions,id"
        ]);

        $role = Roles::create([
            "slug" => Str::slug($request->label),
            "label" => $request->label,
            "description" => $request->description
        ]);

        if($request->has("permissions")){
             $role->permissions()->sync($request->permissions);
        }

        return redirect()->route("roles.index")->with("success", "Rôle créé avec succès.");
    }

    public function update(Request $request, Roles $role){
        $request->validate([
            "label" => "required|string|unique:roles,label,".$role->id,
            "description" => "nullable|string",
            "permissions" => "nullable|array|exists:permissions,id"
        ]);

        $role->update([
            "slug" => Str::slug($request->label),
            "label" => $request->label,
            "description" => $request->description
        ]);

        if($request->has("permissions")){
             $role->permissions()->sync($request->permissions);
        }

        return redirect()->route("roles.index")->with("success", "Rôle mis à jour avec succès.");
    }

    public function destroy(Roles $role){
        $role->delete();

        return redirect()->route("roles.index")->with("delete", "Rôle supprimé avec succès.");
    }

    public function restore($id){
        $role = Roles::withTrashed()->findOrFail($id);
        $role->restore();

        return redirect()->route("roles.index")->with("success", "Rôle restauré avec succès.");
    }
}
