<?php

use App\Http\Controllers\Administration\AdminController;
use App\Http\Controllers\Administration\OrderController;
use App\Http\Controllers\Administration\ParametreController;
use App\Http\Controllers\Administration\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/', [WebsiteController::class, 'index']);
Route::get('/magasin', [WebsiteController::class, 'magasin'])->name('magasin');
Route::get('/magasin/{slug}', [WebsiteController::class, 'productDetails'])->name('products.details');
Route::get('/politique-de-confidentialite', [WebsiteController::class, 'politique'])->name('politique');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');


Route::get('/compare', [WebsiteController::class, 'compare'])->name('compare');
Route::get('/panier', [WebsiteController::class, 'panier'])->name('panier');
Route::get('/checkout', [WebsiteController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store')->middleware('auth');
Route::get('order/success', [OrderController::class, 'success'])->name('order.success');




Route::prefix('administration')->middleware(['auth', 'role:Administrateur'])->group(function () {
    Route::get('/', [AdminController::class, 'index']);

    // Paramètres
    Route::get('/settings', [ParametreController::class, 'index'])->name('parametres.index');
    Route::post('/settings/update', [ParametreController::class, 'update'])->name('parametres.update');
    
    // Ressource pour les produits
    Route::resource('products', ProductController::class);
    Route::delete('images/{image}', [ProductController::class, 'ImageDestroy'])->name('images.destroy');

    Route::put('/products/{id}/add-images', [ProductController::class, 'addImages'])->name('product.addImages');

    Route::put('/products/{id}/update-thumbnail', [ProductController::class, 'updateThumbnail'])->name('product.updateThumbnail');

    Route::get('stocks', [ProductController::class, 'stock'])->name('products.stock');
    Route::put('stocks', [ProductController::class, 'updateStock'])->name('products.updateStock');

    Route::post('products/stock', [ProductController::class, 'CodeBarres'])->name('codeBarres.add');


    Route::get('/commandes', [OrderController::class, 'index'])->name('commandes.index');
    // Route::get('/commandes/{order}', [OrderController::class, 'show'])->name('commandes.show');
    Route::get('/commandes/{order}/edit', [OrderController::class, 'edit'])->name('commandes.edit');
    Route::put('/commandes/{order}', [OrderController::class, 'update'])->name('commandes.update');
    // Route::delete('/commandes/{order}', [OrderController::class, 'destroy'])->name('commandes.destroy');
    Route::put('commandes/{order}/update-status', [OrderController::class, 'updateStatus'])->name('commandes.updateStatus');

    

    Route::get('/commandes/details', function () {
        return view('Administration.pages.commandes.details');
    });

    Route::get('/commandes/recu', function () {
        return view('Administration.pages.commandes.recu');
    });

    // Pages de gestion des ventes
    Route::get('/ventes', function () {
        return view('Administration.pages.commandes.index');
    });

    Route::get('/ventes/details', function () {
        return view('Administration.pages.commandes.details');
    });

    Route::get('/ventes/recu', function () {
        return view('Administration.pages.commandes.recu');
    });
});


Route::prefix('home')->middleware(['auth', 'role:User'])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::get('/orders/{order}', [UserController::class, 'orderShow'])->name('orders.show');
    Route::get('order/{orderId}/receipt/download', [UserController::class, 'downloadReceipt'])->name('order.downloadReceipt');

});

Auth::routes();

// Route::get('/administration', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
