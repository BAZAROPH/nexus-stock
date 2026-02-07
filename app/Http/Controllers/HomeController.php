<?php

namespace App\Http\Controllers;

use App\Models\Allocations;
use App\Models\Sites;
use App\Models\Stock;
use App\Models\Workers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Counts
        $totalStock = Stock::count();
        $totalAllocations = Allocations::count();
        $totalWorkers = Workers::count();
        $totalSites = Sites::count();

        // Chart Data: Stock by Category
        $stockByCategory = Stock::select('stock_types.label as label', DB::raw('count(*) as total'))
            ->join('stock_types', 'stocks.stock_type_id', '=', 'stock_types.id')
            ->groupBy('label')
            ->get();

        // Chart Data: Allocations per Month (Current Year)
        $allocationsPerMonth = Allocations::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        // Prepare data for charts
        $months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
        $allocationData = array_fill(0, 12, 0);
        foreach ($allocationsPerMonth as $data) {
            $allocationData[$data->month - 1] = $data->total;
        }

        return view('layouts.dashboard', compact(
            'totalStock', 
            'totalAllocations', 
            'totalWorkers', 
            'totalSites',
            'stockByCategory',
            'months',
            'allocationData'
        ));
    }
}
