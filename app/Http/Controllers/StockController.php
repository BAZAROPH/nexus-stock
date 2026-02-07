<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    //
    public function index(Request $request){
        if($request->has("view") && $request->view == "trash"){
            $stocks = Stock::onlyTrashed()->with(['type', 'site'])->get();
        }else{
            $stocks = Stock::with(['type', 'site'])->get();
        }

        $stockTypes = \App\Models\StockType::all();
        $sites = \App\Models\Sites::all();

        return view("layouts.stocks.index", [
            "stocks" => $stocks,
            "stockTypes" => $stockTypes,
            "sites" => $sites,
            "isTrash" => $request->has("view") && $request->view == "trash"
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "name" => "required|string|unique:stocks,name",
            "stock_type_id" => "required|exists:stock_types,id",
            "site_id" => "required|exists:sites,id",
            "quantity" => "required|integer|min:0",
            "description" => "nullable|string",
            "size" => "nullable|string",
            "color" => "nullable|string",
            "dimension" => "nullable|string",
            "observation" => "nullable|string",
        ]);

        $characteristics = [
            "size" => $request->size,
            "color" => $request->color,
            "dimension" => $request->dimension,
            "observation" => $request->observation
        ];

        Stock::create([
            "slug" => \Illuminate\Support\Str::slug($request->name),
            "name" => $request->name,
            "stock_type_id" => $request->stock_type_id,
            "site_id" => $request->site_id,
            "quantity" => $request->quantity,
            "description" => $request->description,
            "characteristics" => json_encode(array_filter($characteristics)),
            "creator_id" => auth()->id()
        ]);

        return redirect()->route("stocks.index")->with("success", "Matériel créé avec succès.");
    }

    public function update(Request $request, Stock $stock){
        $request->validate([
            "name" => "required|string|unique:stocks,name,".$stock->id,
            "stock_type_id" => "required|exists:stock_types,id",
            "site_id" => "required|exists:sites,id",
            "quantity" => "required|integer|min:0",
            "description" => "nullable|string",
             "size" => "nullable|string",
            "color" => "nullable|string",
            "dimension" => "nullable|string",
            "observation" => "nullable|string",
        ]);

        $characteristics = [
            "size" => $request->size,
            "color" => $request->color,
            "dimension" => $request->dimension,
            "observation" => $request->observation
        ];

        $stock->update([
            "slug" => \Illuminate\Support\Str::slug($request->name),
            "name" => $request->name,
            "stock_type_id" => $request->stock_type_id,
            "site_id" => $request->site_id,
            "quantity" => $request->quantity,
            "description" => $request->description,
            "characteristics" => json_encode(array_filter($characteristics))
        ]);

        return redirect()->route("stocks.index")->with("success", "Matériel mis à jour avec succès.");
    }

    public function destroy(Stock $stock){
        $stock->delete();

        return redirect()->route("stocks.index")->with("delete", "Matériel supprimé avec succès.");
    }

    public function restore($id){
        $stock = Stock::withTrashed()->findOrFail($id);
        $stock->restore();

        return redirect()->route("stocks.index")->with("success", "Matériel restauré avec succès.");
    }
}
