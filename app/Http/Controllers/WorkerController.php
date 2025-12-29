<?php

namespace App\Http\Controllers;

use App\Models\Workers;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    //
    public function index(){
        $workers = Workers::all();

        return view("layouts.workers.index", [
            "workers" => $workers
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "first_name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|email|unique:workers,email",
            "phone" => "nullable|string|unique:workers,phone",
            "site_id" => "required|exists:sites,id",
            "worker_type_id" => "required|exists:worker_types,id"
        ]);

        Workers::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "phone" => $request->phone,
            "site_id" => $request->site_id,
            "worker_type_id" => $request->worker_type_id
        ]);

        return redirect()->route("workers.index")->with("success", "Travailleur créé avec succès.");
    }

    public function update(Request $request, Workers $worker){
        $request->validate([
            "first_name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|email|unique:workers,email,".$worker->id,
            "phone" => "nullable|string|unique:workers,phone,".$worker->id,
            "site_id" => "required|exists:sites,id",
            "worker_type_id" => "required|exists:worker_types,id"
        ]);

        $worker->update([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "phone" => $request->phone,
            "site_id" => $request->site_id,
            "worker_type_id" => $request->worker_type_id
        ]);

        return redirect()->route("workers.index")->with("success", "Travailleur mis à jour avec succès.");
    }

    public function destroy(Workers $worker){
        $worker->delete();

        return redirect()->route("workers.index")->with("success", "Travailleur supprimé avec succès.");
    }

    public function restore($id){
        $worker = Workers::withTrashed()->findOrFail($id);
        $worker->restore();

        return redirect()->route("workers.index")->with("success", "Travailleur restauré avec succès.");
    }
}
