<?php

namespace App\Http\Controllers;

use App\Models\Allocations;
use Illuminate\Http\Request;

class AllocationController extends Controller
{
    //
    public function index(){
        //
        $allocations = Allocations::all();

        return view("layouts.allocations.index", [
            "allocations" => $allocations
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "stock_id" => "required|exists:stock,id",
            "user_id" => "required|exists:users,id",
            "worker_id" => "required|exists:workers,id",
            "quantity" => "required|integer|min:1",
            "details" => "required|json"
        ]);

        Allocations::create([
            "stock_id" => $request->stock_id,
            "user_id" => $request->user_id,
            "worker_id" => $request->worker_id,
            "quantity" => $request->quantity,
            "details" => $request->details
        ]);

        return redirect()->route("allocations.index")->with("success", "Allocation créée avec succès.");
    }

    public function update(Request $request, Allocations $allocation){
        $request->validate([
            "stock_id" => "required|exists:stock,id",
            "user_id" => "required|exists:users,id",
            "worker_id" => "required|exists:workers,id",
            "quantity" => "required|integer|min:1",
            "details" => "required|json"
        ]);

        $allocation->update([
            "stock_id" => $request->stock_id,
            "user_id" => $request->user_id,
            "worker_id" => $request->worker_id,
            "quantity" => $request->quantity,
            "details" => $request->details
        ]);

        return redirect()->route("allocations.index")->with("success", "Allocation mise à jour avec succès.");
    }

    public function destroy(Allocations $allocation){
        $allocation->delete();

        return redirect()->route("allocations.index")->with("success", "Allocation supprimée avec succès.");
    }

    public function restore($id){
        $allocation = Allocations::withTrashed()->findOrFail($id);
        $allocation->restore();

        return redirect()->route("allocations.index")->with("success", "Allocation restaurée avec succès.");
    }
}
