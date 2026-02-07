<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    //
    public function index(Request $request){
        if($request->has("view") && $request->view == "trash"){
            $sites = Sites::onlyTrashed()->get();
        }else{
            $sites = Sites::all();
        }

        return view("layouts.sites.index", [
            "sites" => $sites,
            "isTrash" => $request->has("view") && $request->view == "trash"
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "name" => "required|string|unique:sites,name",
            "address" => "nullable|string"
        ]);

        Sites::create([
            "slug" => Str::slug($request->name),
            "name" => $request->name,
            "address" => $request->address
        ]);

        return redirect()->route("sites.index")->with("success", "Site créé avec succès.");
    }

    public function update(Request $request, Sites $site){
        $request->validate([
            "name" => "required|string|unique:sites,name,".$site->id,
            "address" => "nullable|string"
        ]);

        $site->update([
            "slug" => Str::slug($request->name),
            "name" => $request->name,
            "address" => $request->address
        ]);

        return redirect()->route("sites.index")->with("success", "Site mis à jour avec succès.");
    }

    public function destroy(Sites $site){
        $site->delete();

        return redirect()->route("sites.index")->with("delete", "Site supprimé avec succès.");
    }

    public function restore($id){
        $site = Sites::withTrashed()->findOrFail($id);
        $site->restore();

        return redirect()->route("sites.index")->with("success", "Site restauré avec succès.");
    }
}
