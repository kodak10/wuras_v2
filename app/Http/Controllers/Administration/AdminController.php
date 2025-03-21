<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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

    public function userIndex()
    {
        $roles = Role::all();

        $users = User::role(['Administrateur', 'Manager'])->get();

        return view('Administration.pages.users.index', compact('users', 'roles'));
    }

    public function userCreate()
    {
        return view('Administration.pages.users.create');
    }

    public function userStore(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:Administrateur,Manager',
    ]);

    // Création de l'utilisateur
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Attribution du rôle via Spatie
    $user->assignRole($request->role);

    return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès');
    }

    public function userUpdate(Request $request, $id)
    {
        // Valider les données envoyées par le formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id', // S'assurer que les rôles existent dans la table des rôles
        ]);

        // Trouver l'utilisateur par ID
        $user = User::findOrFail($id);

        // Mettre à jour les informations de l'utilisateur
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Synchroniser les rôles de l'utilisateur
        // Si l'utilisateur a des rôles existants, les supprimer et ajouter les nouveaux
        $user->syncRoles($request->roles);

        // Retourner à la vue avec un message de succès
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }
}
