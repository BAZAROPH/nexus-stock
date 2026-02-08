<?php

namespace App\Http\Controllers;

use App\Models\Allocations;
use Illuminate\Http\Request;

class AllocationController extends Controller
{
    //
    public function index(Request $request){
        if($request->has("view") && $request->view == "trash"){
            $allocations = Allocations::onlyTrashed()->get();
        }else{
            $allocations = Allocations::with(['stock', 'user', 'worker'])->get();
        }

        $stocks = \App\Models\Stock::all();
        $users = \App\Models\User::all();
        $workers = \App\Models\Workers::all();

        return view("layouts.allocations.index", [
            "allocations" => $allocations,
            "stocks" => $stocks,
            "users" => $users,
            "workers" => $workers,
            "isTrash" => $request->has("view") && $request->view == "trash"
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "stock_id" => "required|exists:stocks,id",
            "user_id" => "required|exists:users,id",
            "worker_id" => "required|exists:workers,id",
            "quantity" => "required|integer|min:1",
            "size" => "nullable|string",
            "color" => "nullable|string",
            "dimension" => "nullable|string",
            "observation" => "nullable|string",
        ]);

        $details = [
            "size" => $request->size,
            "color" => $request->color,
            "dimension" => $request->dimension,
            "observation" => $request->observation
        ];

        $stock = \App\Models\Stock::findOrFail($request->stock_id);

        if($stock->quantity < $request->quantity){
            return back()->withErrors(['quantity' => 'La quantité demandée est supérieure au stock disponible (' . $stock->quantity . ').']);
        }

        $stock->decrement('quantity', $request->quantity);

        Allocations::create([
            "stock_id" => $request->stock_id,
            "user_id" => $request->user_id,
            "worker_id" => $request->worker_id,
            "quantity" => $request->quantity,
            "details" => json_encode(array_filter($details)) // Only save non-null values
        ]);

        return redirect()->route("allocations.index")->with("success", "Allocation créée avec succès.");
    }

    public function update(Request $request, Allocations $allocation){
        $request->validate([
            "stock_id" => "required|exists:stocks,id",
            "user_id" => "required|exists:users,id",
            "worker_id" => "required|exists:workers,id",
            "quantity" => "required|integer|min:1",
            "size" => "nullable|string",
            "color" => "nullable|string",
            "dimension" => "nullable|string",
            "observation" => "nullable|string",
        ]);

        $details = [
            "size" => $request->size,
            "color" => $request->color,
            "dimension" => $request->dimension,
            "observation" => $request->observation
        ];

        $allocation->update([
            "stock_id" => $request->stock_id,
            "user_id" => $request->user_id,
            "worker_id" => $request->worker_id,
            "quantity" => $request->quantity,
            "details" => json_encode(array_filter($details))
        ]);

        return redirect()->route("allocations.index")->with("success", "Allocation mise à jour avec succès.");
    }

    public function destroy(Allocations $allocation){
        $allocation->stock->increment('quantity', $allocation->quantity);
        $allocation->delete();

        return redirect()->route("allocations.index")->with("success", "Allocation supprimée et stock restauré avec succès.");
    }

    public function restore($id){
        $allocation = Allocations::withTrashed()->findOrFail($id);
        $allocation->restore();

        return redirect()->route("allocations.index")->with("success", "Allocation restaurée avec succès.");
    }
}
