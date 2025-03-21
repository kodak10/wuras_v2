<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        // Calcul des totaux
        $totalOrders = Order::count();
        $cancelledOrders = Order::where('status', 'annulée')->count();
        $pendingOrders = Order::where('status', 'en attente')->count();
        $completedOrders = Order::where('status', 'livrée')->count();

        // Liste des commandes
        
        $orders = Order::with('details')->latest()->paginate(10);// Charger la relation 'details' avec les commandes

        // Passer ces données à la vue
        return view('Administration.pages.commandes.index', compact('totalOrders', 'cancelledOrders', 'pendingOrders', 'completedOrders', 'orders'));
    }
    public function edit($id)
{
    // Charger la commande avec les détails et les produits associés
    $order = Order::with('details.product')->find($id);

    if (!$order) {
        return redirect()->back()->withErrors(['Commande introuvable']);
    }

    // Calcul du sous-total (somme des quantités * prix de chaque produit)
    $subTotal = $order->details->sum(function($detail) {
        return $detail->quantity * $detail->price;
    });

   
    $deliveryCost = $order->shipping_price ; 

    $discount = $order->discount; // Vous pouvez remplacer cette ligne par votre logique de réduction

    $total = $subTotal + $deliveryCost - $discount;

    // Retourner la vue avec les informations de la commande
    return view('Administration.pages.commandes.details', compact('order', 'subTotal', 'deliveryCost', 'discount', 'total'));
}

public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Valider les données envoyées
    $request->validate([
        'shipping_price' => 'required|numeric',
        'discount' => 'required|numeric',
    ]);

    // Mettre à jour les informations de la commande
    $order->update([
        'shipping_price' => $request->shipping_price,
        'discount' => $request->discount,
    ]);

    // Rediriger avec un message de succès
    return redirect()->route('commandes.edit', $id)->with('success', 'Commande mise à jour avec succès.');

}

public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Validation des champs
    $request->validate([
        'status' => 'required|in:en attente,confirmée,expédiée,livrée,annulée',
        'payment_status' => 'required|in:non payé,payé,remboursé',
    ]);

    // Mise à jour du statut et du statut de paiement
    $order->update([
        'status' => $request->status,
        'payment_status' => $request->payment_status,
    ]);

    // Rediriger vers la page d'édition de la commande avec un message de succès
    return redirect()->route('commandes.edit', $id)->with('success', 'Statut et statut de paiement mis à jour avec succès.');
}




    public function store(Request $request)
    {
        // Valider les données envoyées
        $request->validate([
            'shipping_method' => 'required|string',
            'shipping_address' => 'string',

            'cart_data' => 'required|json',
        ]);

        $cart = json_decode($request->cart_data, true);


        if (!$cart || count($cart) === 0) {
            return redirect()->back()->withErrors(['cart' => 'Votre panier est vide.']);
        }

        // dd($request->shipping_address);
        // Créer la commande
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'status' => 'en attente',
            'payment_status' => 'non payé',
            'shipping_method' => $request->shipping_method,
            'shipping_address' => $request->shipping_address ?? '',
            'total_price' => $request->total_price,
        ]);

        // Ajouter les détails de la commande
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
        // Rediriger avec un message de succès
        return redirect()->route('website')->with('successOrder', 'Commande enregistrée avec succès.');

    }

    public function success()
    {
        return view('front-end.sucess'); // Assurez-vous d'avoir une vue "order.success"
    }

    
}
