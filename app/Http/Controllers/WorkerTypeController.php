<?php

namespace App\Http\Controllers;

use App\Models\WorkerTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkerTypeController extends Controller
{
    //
    public function index(){
        $workerTypes = WorkerTypes::all();

        return view("layouts.worker_types.index", [
            "workerTypes" => $workerTypes
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "label" => "required|string|unique:worker_types,label",
            "description" => "nullable|string"
        ]);

        WorkerTypes::create([
            "slug" => Str::slug($request->label),
            "label" => $request->label,
            "description" => $request->description
        ]);

        return redirect()->route("worker_types.index")->with("success", "Type de travailleur créé avec succès.");
    }

    public function update(Request $request, WorkerTypes $workerType){
        $request->validate([
            "label" => "required|string|unique:worker_types,label,".$workerType->id,
            "description" => "nullable|string"
        ]);

        $workerType->update([
            "slug" => Str::slug($request->label),
            "label" => $request->label,
            "description" => $request->description
        ]);

        return redirect()->route("worker_types.index")->with("success", "Type de travailleur mis à jour avec succès.");
    }

    public function destroy(WorkerTypes $workerType){
        $workerType->delete();

        return redirect()->route("worker_types.index")->with("success", "Type de travailleur supprimé avec succès.");
    }

    public function restore($id){
        $workerType = WorkerTypes::withTrashed()->findOrFail($id);
        $workerType->restore();

        return redirect()->route("worker_types.index")->with("success", "Type de travailleur restauré avec succès.");
    }
}
