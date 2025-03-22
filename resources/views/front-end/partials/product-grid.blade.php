    @foreach ($products as $product)


        @php
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
