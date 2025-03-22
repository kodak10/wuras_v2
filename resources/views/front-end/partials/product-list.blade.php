
@foreach ($products as $product)
    <div class="product product-list">
        @php
            $thumbnail = $product->images()->where('is_thumbnail', true)->first();
            $imageUrl = $thumbnail ? asset('storage/' . $thumbnail->path) : asset('images/default.png'); // Image par défaut si pas d'image
        @endphp
        <figure class="product-media">
            <a href="{{ route('products.details', ['slug' => $product->slug]) }}">
                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="img-thumbnail" style="width:260px; height:293px">
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
            
            <p class="product-short-desc">
                {{ $product->description }}
            </p>
            <div class="product-action">
                <a href="#" class="btn-product-icon btn-cart mr-3 w-100" title="Ajouter au panier"><i class="d-icon-bag"></i>Ajouter au panier</a>
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



{{-- <div class="product-lists product-wrapper">
    <div class="product product-list">
        <figure class="product-media">
            <a href="product.html">
                <img src="images/shop/13.jpg" alt="product" width="260" height="293">
            </a>
            <div class="product-label-group">
                <label class="product-label label-new">new</label>
            </div>
        </figure>
        <div class="product-details">
            <div class="product-cat">
                <a href="shop-list-mode.html">Clothing</a>
            </div>
            <h3 class="product-name">
                <a href="product.html">Women Red Fur Overcoat</a>
            </h3>
            <div class="product-price">
                <span class="price">$184.00</span>
            </div>
            <div class="ratings-container">
                <div class="ratings-full">
                    <span class="ratings" style="width:80%"></span>
                    <span class="tooltiptext tooltip-top"></span>
                </div>
                <a href="product.html" class="rating-reviews">( 6 reviews )</a>
            </div>
            <p class="product-short-desc">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor
                incididunt ut labore et dolore magna aliqua.
            </p>
            <div class="product-action">
                <a href="#" class="btn-product btn-cart" data-toggle="modal"
                    data-target="#addCartModal" title="Add to cart"><i
                        class="d-icon-bag"></i><span>Add to cart</span></a>
                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
                        class="d-icon-heart"></i></a>
                <a href="#" class="btn-product-icon btn-quickview" title="Quick View"><i
                        class="d-icon-search"></i></a>
            </div>
        </div>
    </div>
    
</div> --}}
