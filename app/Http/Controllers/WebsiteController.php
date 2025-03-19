<?php

namespace App\Http\Controllers;

use \Log;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{

    public function index()
    {

        $categories = Category::all();

        $computers = Product::whereHas('category', function ($query) {
            $query->where('name', 'Ordinateur');
        })->take(8)->orderBy('created_at', 'desc')->get();
        

        $computerCount = Product::whereHas('category', function ($query) {
            $query->where('name', 'Ordinateur');
        })->count();
        


        $EcransImprimantes = Product::whereHas('category', function ($query) {
            $query->whereIn('name', ['Écrans', 'Imprimantes']);
        })->take(8)->orderBy('created_at', 'desc')->get();
        

        $accessoires = Product::whereHas('category', function ($query) {
            $query->whereIn('name', ['Accessoires']);
        })->take(8)->orderBy('created_at', 'desc')->get();
        

       

        $accessoiresCount = Product::whereHas('category', function ($query) {
            $query->where('name', 'Accessoires');
        })->count();

        $productsWithDiscount = Product::whereNotNull('discount')->orderBy('created_at', 'desc')->get();

        // Le premier produit avec un discount sera affiché dans product-single-wrap
        $firstProduct = $productsWithDiscount->shift(); // Déplace le premier produit de la collection
        $otherProducts = $productsWithDiscount->take(6); // Les 6 autres produits


        $recentProducts = session()->get('recent_products', []);

        // Récupérer les produits récemment consultés en fonction des IDs
        $recentlyViewedProducts = Product::whereIn('id', $recentProducts)
        ->orderBy('created_at', 'desc')  // Tri par date de création, du plus récent au plus ancien
        ->take(8)                        // Limiter à 8 produits
        ->orderBy('created_at', 'desc')
        ->get();
    
        return view('front-end.index', compact('categories', 'computers', 'computerCount', 'EcransImprimantes', 'accessoires', 'accessoiresCount', 'firstProduct', 'otherProducts', 'recentlyViewedProducts'));

    }

    
    // public function magasin(Request $request)
    // {
    //     // Récupérer toutes les catégories
    //     $categories = Category::all();
        
    //     // Récupère la requête de recherche, les catégories sélectionnées et le paramètre de promotion
    //     $query = $request->input('search');
    //     $categoryNames = $request->input('category_name');
    //     $promotion = $request->input('promotion');  // Paramètre pour filtrer les promotions
    
    //     // Filtrage des produits
    //     $products = Product::with('category')
    //         ->when($query, function ($queryBuilder) use ($query) {
    //             $queryBuilder->where('name', 'LIKE', "%{$query}%")
    //                          ->orWhere('description', 'LIKE', "%{$query}%");
    //         })
    //         ->when($categoryNames, function ($queryBuilder) use ($categoryNames) {
    //             // Filtre par catégories
    //             $queryBuilder->whereHas('category', function ($query) use ($categoryNames) {
    //                 $query->whereIn('name', $categoryNames);
    //             });
    //         })
    //         ->when($promotion, function ($queryBuilder) {
    //             // Filtre les produits qui ont une remise différente de null ou de 0
    //             $queryBuilder->where(function ($query) {
    //                 $query->whereNotNull('discount')
    //                       ->where('discount', '>', 0);
    //             });
    //         })
    //         ->get();
        
    //     return view('front-end.shop', compact('products', 'query', 'categories', 'categoryNames', 'promotion'));
    // }
    public function magasin(Request $request)
    {
        // Récupérer toutes les catégories
        $categories = Category::all();
        
        // Récupère la requête de recherche, les catégories sélectionnées et le paramètre de promotion
        $query = $request->input('search');
        $categoryNames = $request->input('category_name');
        $promotion = $request->input('promotion');  // Paramètre pour filtrer les promotions

        // Filtrage des produits avec pagination (12 produits par page)
        $products = Product::with('category')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'LIKE', "%{$query}%")
                            ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->when($categoryNames, function ($queryBuilder) use ($categoryNames) {
                // Filtre par catégories
                $queryBuilder->whereHas('category', function ($query) use ($categoryNames) {
                    $query->whereIn('name', $categoryNames);
                });
            })
            ->when($promotion, function ($queryBuilder) {
                // Filtre les produits qui ont une remise différente de null ou de 0
                $queryBuilder->where(function ($query) {
                    $query->whereNotNull('discount')
                        ->where('discount', '>', 0);
                });
            })
            ->paginate(12);  // Pagination de 12 produits par page
            
        return view('front-end.shop', compact('products', 'query', 'categories', 'categoryNames', 'promotion'));
    }

    // public function magasin(Request $request)
    // {
    //     // Récupérer toutes les catégories
    //     $categories = Category::all();
    
    //     // Récupérer les paramètres de tri et de nombre d'éléments
    //     $orderBy = $request->input('orderby', 'date');
    //     $count = $request->input('count', 12);
    
    //     // Récupérer les produits avec les filtres appliqués
    //     $products = Product::with('category')
    //         ->when($orderBy, function ($queryBuilder) use ($orderBy) {
    //             if ($orderBy === 'price-low') {
    //                 $queryBuilder->orderBy('price', 'asc');
    //             } elseif ($orderBy === 'price-high') {
    //                 $queryBuilder->orderBy('price', 'desc');
    //             } else {
    //                 $queryBuilder->orderBy('created_at', 'desc');
    //             }
    //         })
    //         ->paginate($count);  // Limiter le nombre de produits selon "count"
    
    //     // Si c'est une requête AJAX, renvoyer les produits et la pagination en JSON
    //     if ($request->ajax()) {
    //         $html = view('front-end.shop-list' , compact('products'))->render();
    //         $pagination = $products->links('pagination::bootstrap-4')->render();
            
    //         return response()->json([
    //             'products' => $html,
    //             'pagination' => $pagination
    //         ]);
    //     }
    
    //     // Retourner la vue avec les variables
    //     return view('front-end.shop', compact('products', 'categories'));
    // }
    



    
    public function productDetails($slug)
    {
        // Récupérer le produit par son slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Récupérer la liste des produits récemment consultés depuis la session
        $recentProducts = session()->get('recent_products', []);

        // Si le produit n'est pas déjà dans la liste des produits récemment consultés, on l'ajoute
        if (!in_array($product->id, $recentProducts)) {
            // Ajouter à la session
            $recentProducts[] = $product->id;

            // Limiter à 5 produits récents pour ne pas surcharger la session
            if (count($recentProducts) > 5) {
                array_shift($recentProducts); // Retirer le produit le plus ancien
            }

            session()->put('recent_products', $recentProducts);
        }

        return view('front-end.shop-details', compact('product'));
    }

   

    public function panier(Request $request)
{
    // Récupérer les produits du panier depuis le cookie (ou session)
    //$cartItems = json_decode($request->cookie('cartItems'), true) ?? [];

    $cartItems = session('cartItems', []);

    // Si tu stockes en session, utilise plutôt :
    // $cartItems = session('cartItems', []);

    // Récupérer les produits réels depuis la base de données en fonction des IDs
    $products = Product::whereIn('id', array_column($cartItems, 'id'))->get();

    // Ajouter la quantité à chaque produit
    foreach ($products as $product) {
        foreach ($cartItems as $item) {
            if ($item['id'] == $product->id) {
                $product->quantity = $item['quantity'];
                break;
            }
        }
    }

    return view('front-end.panier', compact('products'));
}


    public function checkout()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour passer une commande.');
        }
        return view('front-end.checkout');
    }

    // Dans votre OrderController.php



       // Dans le contrôleur
       public function compare(Request $request)
       {
           // Récupération de la liste de comparaison à partir du cookie
           $compareList = json_decode($request->cookie('compareList'), true) ?? [];
       
           Log::info('Compare List:', $compareList); // Log pour vérifier le contenu de compareList
       
           // Vérifiez si la liste de comparaison est vide
           if (empty($compareList)) {
               Log::warning('La liste de comparaison est vide');
           }
       
           // Récupérer les produits de la base de données en utilisant les ids présents dans compareList
           $compareProducts = Product::whereIn('id', array_column($compareList, 'id'))->get();
       
           Log::info('Compare Products:', $compareProducts->toArray()); // Log pour vérifier les produits récupérés
       
           // Passer les produits récupérés à la vue
           return view('front-end.compare', compact('compareProducts'));
       }

       public function politique()
       {
            return view('front-end.politique');
       }

       public function contact()
       {
        return view('front-end.contact');
       }
       
       

}
