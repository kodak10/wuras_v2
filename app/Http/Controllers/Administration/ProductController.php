<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\ArticleBarcode;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('Administration.pages.produits.index', compact('products'));
    }

    public function create()
    {
        // Récupérer toutes les catégories
        $categories = Category::all(); // Récupère toutes les catégories

        return view('Administration.pages.produits.create', compact('categories'));
    }

   
    
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'category_id' => 'required|exists:categories,id', // Validation pour la catégorie
            'name' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'weight' => 'nullable',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'colors' => 'nullable|array',
            'tags' => 'nullable|array',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Générer le slug à partir du nom du produit
        $slug = Str::slug($request->input('name'));
    
        // Récupérer et formater les couleurs sélectionnées
        $colors = $request->input('colors', []);
        $colorsString = implode(',', $colors);

        // Créer un produit avec les données et le slug
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name, // Assurez-vous que 'name' est bien transmis
            'marque' => $request->marque,
            'weight' => $request->weight,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'discount' => $request->discount,
            'slug' => $slug,
            'colors' => $colorsString, 

        ]);
    
        // Gestion de la vignette (image principale)
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('products', 'public');
            $thumbnail = Image::create(['path' => $path, 'is_thumbnail' => true]);
            $product->images()->attach($thumbnail->id);
        }
    
        // Gestion des images additionnelles
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $img = Image::create(['path' => $path, 'is_thumbnail' => false]);
                $product->images()->attach($img->id);
            }
        }
    
        // Retourner à la page de la liste des produits avec un message de succès
        return redirect()->route('products.index')->with('success', 'Produit créé avec succès!');
    }
    

   

    public function edit($id)
    {
        $categories = Category::all();

        $product = Product::findOrFail($id);
        $colors = is_string($product->colors) ? explode(',', $product->colors) : $product->colors ?? [];

        return view('Administration.pages.produits.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validation des champs
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'colors' => 'nullable|array',
            'colors.*' => 'string',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'tags' => 'nullable|array',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Vignette
            'images' => 'nullable|array', // Autres images
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation pour chaque image
        ]);
    
        // Récupérer le produit
        $product = Product::findOrFail($id);
    
        // Récupérer et formater les couleurs sélectionnées
        $colors = $request->input('colors', []);
        $colorsString = implode(',', $colors);
    
        // Mise à jour des informations de base
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->marque = $request->input('brand');
        $product->weight = $request->input('weight');
        $product->description = $request->input('description');
        $product->stock = $request->input('stock');
        $product->tags = json_encode($request->input('tags')); // Si vous stockez les tags sous forme de JSON
        $product->price = $request->input('price');
        $product->discount = $request->input('discount');
        $product->colors = $colorsString;
    
       
    
        
    
        // Sauvegarder les modifications du produit
        $product->save();
    
        // Retourner une réponse ou rediriger avec un message
        return redirect()->route('products.index', $product->id)->with('success', 'Produit mis à jour avec succès');
    }
    
    


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Supprimer les images associées
        foreach ($product->images as $image) {
            Storage::delete($image->path); // Supprime physiquement l'image du stockage
            $image->delete(); // Supprime l'entrée de la base de données
        }

        // Supprimer le produit
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }

    public function ImageDestroy(Image $image)
{
    // Vérifier si l'image existe
    if ($image) {
        // Vérifier si l'image appartient à un produit
        $product = $image->products()->first();  // Récupère le premier produit associé à l'image

        if ($product) {
            // Si l'image est la vignette et qu'elle est supprimée, on ne supprime pas le produit.
            if ($image->is_thumbnail) {
                // Si vous supprimez une image principale (vignette), vous pourriez vouloir affecter une autre image comme vignette
                // par exemple, vous pourriez affecter une autre image comme la nouvelle vignette.
            }

            // Supprimer l'image du stockage
            if (Storage::exists($image->path)) {
                Storage::delete($image->path); // Supprimer l'image physique
            }

            // Supprimer l'image de la table de jointure sans supprimer le produit
            $product->images()->detach($image->id);

            // Supprimer l'enregistrement de l'image dans la base de données
            $image->delete();

            return redirect()->back()->with('success', 'Image supprimée avec succès');
        }
    }

    // Si l'image n'existe pas, retour avec un message d'erreur
    return redirect()->back()->with('error', 'Image non trouvée');
}

// public function updateThumbnail(Request $request, $id)
// {
//     // Validation de l'image
//     $request->validate([
//         'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ]);

//     // Trouver le produit
//     $product = Product::findOrFail($id);

//     // Trouver et supprimer l'ancienne vignette
//     $oldThumbnail = $product->images()->where('is_thumbnail', true)->first();
//     if ($oldThumbnail) {
//         // Supprimer le fichier de stockage
//         Storage::disk('public')->delete($oldThumbnail->path);
//         // Supprimer l'entrée de la base de données
//         $product->images()->detach($oldThumbnail->id);
//         $oldThumbnail->delete();
//     }

//     // Ajouter la nouvelle vignette
//     $path = $request->file('thumbnail')->store('products', 'public');
//     $newThumbnail = Image::create(['path' => $path, 'is_thumbnail' => true]);

//     // Associer la nouvelle vignette au produit
//     $product->images()->attach($newThumbnail->id);

//     return redirect()->back()->with('success', 'Vignette mise à jour avec succès !');
// }

public function updateThumbnail(Request $request, $id)
{
    // Validation de l'image
    $request->validate([
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    Log::info('Début de la mise à jour de la vignette', ['product_id' => $id]);

    // Trouver le produit
    $product = Product::find($id);
    if (!$product) {
        Log::error('Produit non trouvé', ['product_id' => $id]);
        return redirect()->back()->with('error', 'Produit non trouvé');
    }
    Log::info('Produit trouvé', ['product' => $product]);

    // Trouver et supprimer l'ancienne vignette
    $oldThumbnail = $product->images()->where('is_thumbnail', true)->first();
    if ($oldThumbnail) {
        Log::info('Ancienne vignette trouvée', ['old_thumbnail' => $oldThumbnail]);

        // Vérifier si le fichier existe avant de supprimer
        if (Storage::disk('public')->exists($oldThumbnail->path)) {
            Storage::disk('public')->delete($oldThumbnail->path);
            Log::info('Ancienne vignette supprimée du stockage');
        } else {
            Log::warning('Fichier de l\'ancienne vignette introuvable', ['path' => $oldThumbnail->path]);
        }

        // Supprimer l'entrée de la base de données
        $product->images()->detach($oldThumbnail->id);
        $oldThumbnail->delete();
        Log::info('Ancienne vignette supprimée de la base de données');
    } else {
        Log::info('Aucune ancienne vignette trouvée');
    }

    // Ajouter la nouvelle vignette
    $file = $request->file('thumbnail');
    if (!$file) {
        Log::error('Fichier de vignette non reçu');
        return redirect()->back()->with('error', 'Fichier de vignette non reçu');
    }

    $path = $file->store('products', 'public');
    Log::info('Nouvelle vignette enregistrée', ['path' => $path]);

    // Créer une nouvelle entrée d'image
    $newThumbnail = Image::create(['path' => $path, 'is_thumbnail' => true]);
    Log::info('Nouvelle vignette créée', ['new_thumbnail' => $newThumbnail]);

    // Associer la nouvelle vignette au produit
    $product->images()->attach($newThumbnail->id);
    Log::info('Nouvelle vignette associée au produit');

    return redirect()->back()->with('success', 'Vignette mise à jour avec succès !');
}



public function addImages(Request $request, $id)
{
    // Validation des images
    $request->validate([
        'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Trouver le produit
    $product = Product::findOrFail($id);

    // Gestion des images additionnelles
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('products', 'public');
            $img = Image::create(['path' => $path, 'is_thumbnail' => false]);
            $product->images()->attach($img->id);
        }
    }

    return redirect()->back()->with('success', 'Images ajoutées avec succès !');
}




    public function stock()
    {
        // Récupérer les produits
        $totalProducts = Product::count(); // Total des produits
        $lowStockProducts = Product::where('stock', '<=', 10)->count(); // Bientôt épuisé (exemple de stock <= 10)
        $outOfStockProducts = Product::where('stock', 0)->count(); // Epuisé

        $categories = Category::get();
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        
        return view('Administration.pages.stocks.index', compact('categories', 'products', 'totalProducts', 'lowStockProducts', 'outOfStockProducts'));
    }

   // Exemple de méthode dans votre ProductController
   public function updateStock(Request $request)
   {
       $validated = $request->validate([
           'product_id' => 'required|exists:products,id',
           'stock' => 'required|integer|min:0',
       ]);
    //    dd($validated);
   
       $product = Product::findOrFail($validated['product_id']);
       $product->stock = $validated['stock'];
       $product->save();
   
       return redirect()->route('products.stock')->with('success', 'Stock mis à jour avec succès.');
   }
   



    // public function CodeBarres(Request $request)
    // {
    //     $quantity = $request->input('quantity');
    //     $productId = $request->input('product_id'); // ID de l'article
    
    //     // Récupérer l'article
    //     $product = Product::find($productId);
    
    //     if (!$product) {
    //         return redirect()->back()->withErrors(['Aucun article sélectionné']);
    //     }
    
    //     // Générer des codes-barres uniques
    //     $barcodes = [];
    //     for ($i = 0; $i < $quantity; $i++) {
    //         // Générer un code unique (exemple : ID de l'article + timestamp + index)
    //         $uniqueCode = $productId . '-' . now()->timestamp . '-' . $i;
    
    //         // Générer le code-barres
    //         $barcodeImage = $this->generateBarcode($uniqueCode);
    
    //         // Enregistrer le lien entre le code-barres et l'article
    //         $barcodeRecord = ArticleBarcode::create([
    //             'product_id' => $product->id,
    //             'barcode_path' => $barcodeImage, // Chemin ou URL du code-barres
    //             // 'barcode_path' => "1", // moi j'ai modifié pour tests
    //         ]);
    
    //         // Ajouter les informations au tableau pour le PDF
    //         $barcodes[] = [
    //             'barcode' => $barcodeImage,
    //             'name' => $product->name, // Nom de l'article actuel
    //             'price' => $product->price, // Prix de l'article actuel
    //             'new_price' => $product->discount > 0 ? $product->price - $product->discount : $product->price, // Appliquer la réduction si elle existe
    //             'article' => $product, // Ajouter l'objet article
    //         ];
            
    //     }
    
    //     // Générer un nom de fichier unique basé sur le nom de l'article et la date/heure
    //     $fileName = 'code-barres-' . Str::slug($product->name) . '-' . now()->format('Ymd-His') . '.pdf';
    
    //     // Charger la vue pour générer le PDF
    //     $pdf = Pdf::loadView('Administration.pages.stocks.pdf', compact('barcodes', 'quantity'));
    
    //     // Télécharger le PDF généré avec un nom unique
    //     return $pdf->download($fileName);
    // }

    public function CodeBarres(Request $request)
    {
        $quantity = $request->input('quantity');
        $productId = $request->input('product_id'); 

        // Vérifier si l'article existe
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->withErrors(['Aucun article sélectionné']);
        }

        // Vérifier quelles cases sont cochées
        $showName = $request->has('show_name');
        $showPrice = $request->has('show_price');
        $showPromo = $request->has('show_promo');

        // Générer les codes-barres
        $barcodes = [];
        for ($i = 0; $i < $quantity; $i++) {
            $uniqueCode = $productId . '-' . now()->timestamp . '-' . $i;
            $barcodeImage = $this->generateBarcode($uniqueCode);

            // Enregistrer dans la base
            $barcodeRecord = ArticleBarcode::create([
                'product_id' => $product->id,
                'barcode_path' => $barcodeImage,
            ]);

            // Ajouter au tableau en respectant les cases cochées
            $barcodeData = [
                'barcode' => $barcodeImage,
                'article' => $product,
            ];

            if ($showName) {
                $barcodeData['name'] = $product->name;
            }
            if ($showPrice) {
                $barcodeData['price'] = $product->price;
            }
            if ($showPromo) {
                $barcodeData['new_price'] = $product->discount > 0 ? $product->price - $product->discount : $product->price;
            }

            $barcodes[] = $barcodeData;
        }

        // Génération du PDF avec les options sélectionnées
        $fileName = 'code-barres-' . Str::slug($product->name) . '-' . now()->format('Ymd-His') . '.pdf';
        $pdf = Pdf::loadView('Administration.pages.stocks.pdf', compact('barcodes', 'quantity', 'showName', 'showPrice', 'showPromo'));

        return $pdf->download($fileName);
    }


    private function generateBarcode($code)
    {
        // Créez une instance de BarcodeGeneratorPNG
        $barcodeGenerator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        
        $barcodeImage = $barcodeGenerator->getBarcode($code, \Picqer\Barcode\BarcodeGeneratorPNG::TYPE_CODE_128);
        
        $barcodeDataUrl = 'data:image/png;base64,' . base64_encode($barcodeImage);
        
        return $barcodeDataUrl;
    } 



}
