<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Parametre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();

        return view('front-end.account.index', compact('orders'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'new_password' => ['nullable', 'string', Password::defaults()],
        ]);

        // Mettre à jour les infos de l'utilisateur
        $user->name = $request->first_name;
        $user->email = $request->email;

        // Vérifier et changer le mot de passe si rempli
        if ($request->current_password && $request->new_password) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès !');
    }

    public function orderShow($id)
    {
        // Charger la commande avec les détails et les produits associés
        $order = Order::with('details.product')->findOrFail($id);
    // dd($id);
    if (!$order) {
        return redirect()->back()->withErrors(['Commande introuvable']);
    }
        // Charger le premier paramètre
        $parametre = Parametre::first();
    
        return view('front-end.account.recu', compact('order', 'parametre'));
    }
    
}
