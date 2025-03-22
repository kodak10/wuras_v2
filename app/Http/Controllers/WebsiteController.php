<?php

namespace App\Http\Controllers;

use \Log;
use App\Models\Category;
use App\Models\Newsletter;
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


        $topProducts = Product::whereHas('orderDetails.order', function ($query) {
            $query->where('status', '!=', 'En attente');
        })->get();


        $recentProducts = session()->get('recent_products', []);

        // Récupérer les produits récemment consultés en fonction des IDs
        $recentlyViewedProducts = Product::whereIn('id', $recentProducts)
        ->orderBy('created_at', 'desc')  // Tri par date de création, du plus récent au plus ancien
        ->take(8)                        // Limiter à 8 produits
        ->orderBy('created_at', 'desc')
        ->get();

    
        return view('front-end.index', compact('categories', 'computers', 'computerCount', 'EcransImprimantes', 'accessoires', 'accessoiresCount', 'firstProduct', 'otherProducts', 'recentlyViewedProducts', 'topProducts'));

    }

    
    


public function magasin(Request $request)
{
    $categories = Category::all();
    $categoryName = $request->input('category_name');
    $category = Category::where('name', $categoryName)->first();

    $productsQuery = Product::with('category')
        ->when($category, function ($query) use ($category) {
            return $query->where('category_id', $category->id);
        })
        ->when($request->input('search'), function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->input('search') . '%');
        })
        ->when($request->input('orderby', 'date'), function ($query) use ($request) {
            switch ($request->orderby) {
                case 'price-low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-high':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        });

    $products = $productsQuery->paginate($request->input('count', 8))->appends($request->all());

    $viewMode = $request->input('view_mode', 'grid'); // Valeur par défaut "grid"

    if ($request->ajax()) {
        $html = view("front-end.partials.product-$viewMode", compact('products'))->render();
        $pagination = $products->links('pagination::bootstrap-4')->render();

        return response()->json([
            'products' => $html,
            'pagination' => $pagination
        ]);
    }

    return view('front-end.shop', compact('products', 'categories', 'category', 'viewMode'));
}


    
    public function productDetails($slug)
    {
        // Récupérer le produit par son slug
        $product = Product::where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
                            ->where('id', '!=', $product->id)
                            
                            ->get();

        $colors = explode(',', $product->colors);

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

        return view('front-end.shop-details', compact('product', 'colors', 'relatedProducts'));
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
       
       
       public function subscribe(Request $request)
       {
           // Validation de l'email
           $request->validate([
               'email' => 'required|email|unique:newsletters,email'
           ]);
   
           // Enregistrement de l'email dans la base de données
           Newsletter::create([
               'email' => $request->email
           ]);
   
           // Message de confirmation
           return redirect()->back()->with('success', 'Vous êtes bien abonné à notre newsletter !');
       }

}
