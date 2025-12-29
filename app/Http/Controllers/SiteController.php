<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    //
    public function index(){
        $sites = Sites::all();

        return view("site.index", [
            "sites" => $sites
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

        return redirect()->route("sites.index")->with("success", "Site supprimé avec succès.");
    }

    public function restore($id){
        $site = Sites::withTrashed()->findOrFail($id);
        $site->restore();

        return redirect()->route("sites.index")->with("success", "Site restauré avec succès.");
    }
}
