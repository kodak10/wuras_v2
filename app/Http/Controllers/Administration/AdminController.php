<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class AdminController extends Controller
{
    public function index()
    {
        // Période actuelle
        $today = Carbon::today();
        $lastWeek = Carbon::today()->subWeek();

        // Commandes et Revenus pour les 30 derniers jours
        $totalOrders = Order::where('created_at', '>=', $lastWeek)->count();
        $paidOrders = Order::where('status', 'paid')->where('created_at', '>=', $lastWeek)->count();

        // Commandes et Revenus pour la semaine précédente
        $lastWeekOrders = Order::where('created_at', '>=', $lastWeek->subWeek())->count();
        $lastWeekPaidOrders = Order::where('status', 'paid')->where('created_at', '>=', $lastWeek->subWeek())->count();

        // Calcul des pourcentages de variation
        $orderGrowthWeek = $lastWeekOrders > 0 ? (($totalOrders - $lastWeekOrders) / $lastWeekOrders) * 100 : 0;
        $paidOrderGrowthWeek = $lastWeekPaidOrders > 0 ? (($paidOrders - $lastWeekPaidOrders) / $lastWeekPaidOrders) * 100 : 0;

        $orders = Order::with('details')->latest()->limit(10)->get();// Charger la relation 'details' avec les commandes

        return view('Administration.pages.index', compact(
            'totalOrders',
            'paidOrders',
            'orderGrowthWeek',
            'paidOrderGrowthWeek',
            'orders'
        ));
    }
}
