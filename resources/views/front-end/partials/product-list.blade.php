
@foreach ($products as $product)
    <div class="product product-list" 
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
                @php
                    // Récupérer l'image principale (vignette) associée au produit
                    $thumbnail = $product->images()->where('is_thumbnail', true)->first();
                @endphp

                @if($thumbnail)
                    <img src="{{ asset('storage/' . $thumbnail->path) }}" alt="{{ $product->name }}" width="280" height="315">
                @else
                    <p>Pas d'image disponible</p>
                @endif
            </a>
           
            <div class="product-label-group">
                <label class="product-label label-new">Nouveauté</label>
                @if ($product->discount)
                    <label class="product-label label-sale">{{ number_format($product->discount, 0, '.', '') }} en réduction</label>
                @endif
            </div>
        </figure>
        <div class="product-details">
            <div class="product-cat">
                <a href="{{ route('products.details', ['slug' => $product->slug]) }}">{{ $product->category->name }}</a>
            </div>
            <h4 class="product-name">
                <a href="{{ route('products.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
            </h4>
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
            
            <p class="product-short-desc">
                {{ $product->description }}
            </p>
            <div class="product-action">
                <a href="#" class="btn-product-icon btn-cart" title="Ajouter au panier w-100"><i class="d-icon-bag"></i>Ajouter au panier</a>
                <a href="#" class="btn-product-icon btn-compare" title="Ajouter à la comparaison"><i class="d-icon-compare"></i></a>

                {{-- <a href="#" class="btn-product btn-cart" data-toggle="modal"
                    data-target="#addCartModal" title="Add to cart"><i
                        class="d-icon-bag"></i><span>Add to cart</span></a> --}}

                {{-- <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
                        class="d-icon-heart"></i></a>
                <a href="#" class="btn-product-icon btn-quickview" title="Quick View"><i
                        class="d-icon-search"></i></a> --}}
            </div>
        </div>

        
    </div>
@endforeach

