<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentesController extends Controller
{
    public function index()
    {
        $ventes = Vente::with('produit')->get();

        $lowStockProducts = Product::whereRaw('stock <= 2')->get();
        return view('Administration.pages.ventes.index', compact('ventes', 'lowStockProducts'));
    }

    public function create()
    {
        $products = Product::get();
        return view('Administration.pages.ventes.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cart' => 'required|array',
            'total' => 'required|numeric',
        ]);
    
        try {
            DB::beginTransaction(); // Démarrer la transaction
    
            foreach ($data['cart'] as $item) {
                $product = Product::find($item['id']);
    
                if (!$product) {
                    return response()->json(['error' => 'Produit introuvable'], 404);
                }
    
                // Vérifier si la quantité demandée est disponible
                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'error' => "Stock insuffisant pour l'article {$product->name}. Stock disponible: {$product->stock}"
                    ], 400);
                }
    
                // Enregistrer la vente
                Vente::create([
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'], // Utilisation correcte
                    'price' => $item['price'],
                    'discount' => $item['discount'],
                    'total' => $item['total'],
                    'user_id' => Auth::id(),
                ]);
    
                // Mettre à jour le stock
                $product->stock -= $item['quantity']; // Correction
                $product->save();
            }
    
            DB::commit(); // Valider la transaction
            return response()->json(['message' => 'Vente enregistrée avec succès!'], 200);
    
        } catch (\Exception $e) {
            DB::rollBack(); // Annuler la transaction en cas d'erreur
            return response()->json(['error' => 'Une erreur est survenue: ' . $e->getMessage()], 500);
        }
    }
}
