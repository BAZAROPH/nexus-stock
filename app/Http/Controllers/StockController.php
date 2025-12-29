<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    //
    public function index(){
        $stocks = Stock::all();

        return view("layouts.stocks.index", [
            "stocks" => $stocks,
        ]);
    }
}
