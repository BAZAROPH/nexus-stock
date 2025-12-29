<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //
    public function index(){
        $permissions = Permissions::all();

        return view("layouts.permissions.index", [
            "permissions" => $permissions
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "label" => "required|string|unique:permissions,label",
            "description" => "nullable|string"
        ]);

        Permissions::create([
            "slug" => Str::slug($request->label),
            "label" => $request->label,
            "description" => $request->description
        ]);

        return redirect()->route("permissions.index")->with("success", "Permission créée avec succès.");
    }

    public function update(Request $request, Permissions $permission){
        $request->validate([
            "label" => "required|string|unique:permissions,label,".$permission->id,
            "description" => "nullable|string"
        ]);

        $permission->update([
            "slug" => Str::slug($request->label),
            "label" => $request->label,
            "description" => $request->description
        ]);

        return redirect()->route("permissions.index")->with("success", "Permission mise à jour avec succès.");
    }

    public function destroy(Permissions $permission){
        $permission->delete();

        return redirect()->route("permissions.index")->with("success", "Permission supprimée avec succès.");
    }

    public function restore($id){
        $permission = Permissions::withTrashed()->findOrFail($id);
        $permission->restore();

        return redirect()->route("permissions.index")->with("success", "Permission restaurée avec succès.");
    }
}
