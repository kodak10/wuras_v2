@extends('front-end.layouts.master')

@section('content')
<div class="page-content mb-10 pb-3">
    <div class="container">
        <div class="row main-content-wrap gutter-lg">
            <aside class="col-lg-3 sidebar sidebar-fixed sidebar-toggle-remain shop-sidebar sticky-sidebar-wrapper">
                <div class="sidebar-overlay"></div>
                <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
                <div class="sidebar-content">
                    <div class="sticky-sidebar" data-sticky-options="{'top': 10}">
                        <div class="filter-actions mb-4">
                            <a href="#" class="sidebar-toggle-btn toggle-remain btn btn-outline btn-primary btn-icon-right btn-rounded">Filter<i class="d-icon-arrow-left"></i></a>
                            {{-- <a href="{{ route('magasin') }}" class="text-dark">Tout éffacer</a> --}}
                        </div>
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">Toutes les Catégories</h3>
                            <ul class="widget-body filter-items search-ul">
                                @foreach ($categories as $categorie)
                                    <li><a href="{{ route('magasin', ['category_name' => $categorie->name]) }}">{{ $categorie->name }}</a></li>

                                @endforeach
                                
                               
                            </ul>
                        </div>
                        {{-- <div class="widget widget-collapsible">
                            <h3 class="widget-title">Trirer Par Prix</h3>
                            <div class="widget-body mt-3">
                                <form action="#">
                                    <div class="filter-price-slider"></div>

                                    <div class="filter-actions">
                                        <div class="filter-price-text mb-4">Prix:
                                           
                                            <span class="filter-price-range"></span>
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-filter btn-rounded">Filtrer</button>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
                       
                       
                        
                    </div>
                </div>
            </aside>
            <div class="col-lg-9 main-content">
                {{-- <nav class="toolbox sticky-toolbox sticky-content fix-top">
                    <div class="toolbox-left">
                        <a href="#" class="toolbox-item left-sidebar-toggle btn btn-sm btn-outline btn-primary btn-rounded btn-icon-right d-lg-none">Filtrer<i class="d-icon-arrow-right"></i></a>
                        <div class="toolbox-item toolbox-sort select-box text-dark">
                            <label>Trier Par :</label>
                            <select name="orderby" class="form-control">
                                <option value="">Defaut</option>
                                <option value="date" selected="selected">Récent</option>
                                <option value="price-low">Plus bas prix</option>
                                <option value="price-high">Plus haut prix</option>
                            </select>
                        </div>
                    </div>
                    <div class="toolbox-right">
                        <div class="toolbox-item toolbox-show select-box text-dark">
                            <label>Afficher :</label>
                            <select name="count" class="form-control">
                                <option value="12">12</option>
                                <option value="24">24</option>
                                <option value="36">36</option>
                            </select>
                        </div>
                        <div class="toolbox-item toolbox-layout">
                            <a href="shop-list-mode-1.html" class="d-icon-mode-list btn-layout"></a>
                            <a href="shop-1.html" class="d-icon-mode-grid btn-layout active"></a>
                        </div>
                    </div>
                </nav> --}}
                <div class="row cols-2 cols-sm-4 product-wrapper mt-5">
                    @foreach ($products as $product)
                        @php
                            // Récupérer l'image principale (vignette) associée au produit
                            $thumbnail = $product->images()->where('is_thumbnail', true)->first();
                            $imageUrl = $thumbnail ? asset('storage/' . $thumbnail->path) : asset('images/default.png'); // Image par défaut si pas d'image
                        @endphp
                
                        <div class="product-wrap">
                            <div class="product" 
                                data-id="{{ $product->id }}" 
                                data-category="{{ $product->category ? $product->category->name : 'N/A' }}" 
                                data-price="{{ $product->price }}" 
                                data-marque="{{ $product->marque }}" 
                                data-stock="{{ $product->stock }}"
                                data-description="{{ $product->description }}"
                                data-slug="{{ $product->slug }}"
                                >
                
                                <figure class="product-media">
                                    <a href="{{ route('products.details', ['slug' => $product->slug]) }}">
                                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" width="280" height="315">
                                    </a>
                                    <div class="product-label-group">
                                        <label class="product-label label-new">Nouveauté</label>
                                        @if ($product->discount)
                                            <label class="product-label label-sale">{{ number_format($product->discount, 0, '.', '') }} en réduction</label>
                                        @endif
                                    </div>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart" title="Ajouter au panier"><i class="d-icon-bag"></i></a>
                                        <a href="#" class="btn-product-icon btn-compare" title="Ajouter à la comparaison"><i class="d-icon-compare"></i></a>
                                    </div>
                                    <div class="product-action">
                                        <a href="{{ route('products.details', ['slug' => $product->slug]) }}" class="btn-product" title="Aperçu">Aperçu</a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="product-cat">
                                        <a href="{{ route('products.details', ['slug' => $product->slug]) }}">{{ $product->category->name }}</a>
                                    </div>
                                    <h3 class="product-name">
                                        <a href="{{ route('products.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                    </h3>
                                    <div class="product-price">
                                        @if($product->discount && $product->discount > 0)
                                            <!-- Calcul du nouveau prix après la réduction -->
                                            <ins class="new-price">
                                                {{ number_format((float)$product->price - (float)$product->discount, 0, '.', '') }} FCFA
                                            </ins>
                                            <del class="old-price">
                                                {{ number_format((float)$product->price, 0, '.', '') }} FCFA
                                            </del>
                                        

                                        @else
                                            <!-- Afficher uniquement le prix normal si la réduction n'est pas valide -->
                                            <ins class="new-price">{{ number_format($product->price, 0, '.', '') }}
                                                FCFA</ins>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('pagination::bootstrap-4') }}  <!-- Utilisation du style de pagination Bootstrap 4 -->
                </div>
                
                
                
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Écouter les changements dans les sélecteurs
        $('select[name="orderby"], select[name="count"]').on('change', function() {
            // Récupérer les valeurs sélectionnées
            var orderBy = $('select[name="orderby"]').val();
            var count = $('select[name="count"]').val();
            
            // Créer la requête AJAX
            $.ajax({
                url: '{{ route('magasin') }}',
                type: 'GET',
                data: {
                    orderby: orderBy,
                    count: count
                },
                success: function(response) {
                    // Mettre à jour les produits avec la nouvelle réponse
                    $('.product-wrapper').html(response.products);
                    // Mettre à jour la pagination
                    $('.pagination').html(response.pagination);
                },
                error: function() {
                    alert('Une erreur s\'est produite.');
                }
            });

        });
    });
    
    
    </script>
@endpush