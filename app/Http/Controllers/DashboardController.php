<?php

namespace App\Http\Controllers;

use App\Models\FinishedProduct;
use App\Models\RawMaterial;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $lowStockRawMaterials = RawMaterial::with('unit')->lowStock()->count();
        $lowStockProducts = FinishedProduct::with('category')->lowStock()->count();
        $todaySales = Sale::whereDate('sale_date', today())->sum('total_amount');
        $todaySalesCount = Sale::whereDate('sale_date', today())->count();
        $totalCustomers = Customer::count();
        $totalSuppliers = Supplier::count();
        $totalProducts = FinishedProduct::count();
        $totalRawMaterials = RawMaterial::count();
        
        $recentSales = Sale::with(['customer', 'cashier'])
            ->latest('sale_date')
            ->take(5)
            ->get();

        return Inertia::render('dashboard', [
            'stats' => [
                'todaySales' => $todaySales,
                'todaySalesCount' => $todaySalesCount,
                'lowStockRawMaterials' => $lowStockRawMaterials,
                'lowStockProducts' => $lowStockProducts,
                'totalCustomers' => $totalCustomers,
                'totalSuppliers' => $totalSuppliers,
                'totalProducts' => $totalProducts,
                'totalRawMaterials' => $totalRawMaterials,
            ],
            'recentSales' => $recentSales,
        ]);
    }
}