<?php

namespace App\Http\Controllers;

use App\Models\StockType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StockTypeController extends Controller
{
    //
    public function index(Request $request){
        if($request->has("view") && $request->view == "trash"){
            $stockTypes = StockType::onlyTrashed()->get();
        }else{
            $stockTypes = StockType::all();
        }

        return view("layouts.stocks.types.index", [
            "stockTypes" => $stockTypes,
            "isTrash" => $request->has("view") && $request->view == "trash"
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "name" => "required|string|unique:stock_types,label",
            "description" => "nullable|string"
        ]);

        StockType::create([
            "slug" => Str::slug($request->name),
            "label" => $request->name,
            "description" => $request->description
        ]);

        return redirect()->route("stock_types.index")->with("success", "Catégorie créée avec succès.");
    }

    public function update(Request $request, StockType $stockType){
        $request->validate([
            "name" => "required|string|unique:stock_types,label,".$stockType->id,
            "description" => "nullable|string"
        ]);

        $stockType->update([
            "slug" => Str::slug($request->name),
            "label" => $request->name,
            "description" => $request->description
        ]);

        return redirect()->route("stock_types.index")->with("success", "Catégorie mise à jour avec succès.");
    }

    public function destroy(StockType $stockType){
        $stockType->delete();

        return redirect()->route("stock_types.index")->with("delete", "Catégorie supprimée avec succès.");
    }

    public function restore($id){
        $stockType = StockType::withTrashed()->findOrFail($id);
        $stockType->restore();

        return redirect()->route("stock_types.index")->with("success", "Catégorie restaurée avec succès.");
    }
}
