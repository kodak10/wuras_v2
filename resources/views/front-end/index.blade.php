@extends('front-end.layouts.master')

@section('content')
<section class="intro-section">
    <div class="container m-0 p-0">
        <div class="row">
            <div class="col-lg-9 mb-4">
                <div class="owl-carousel owl-theme owl-dot-inner row gutter-no cols-1 animation-slider" data-owl-options="{
                    'nav': false,
                    'dots': true,
                    'autoplay': false,
                    'items': 1
                }">
                    <div class="banner banner-fixed content-middle intro-slide intro-slide1 banner-radius">
                        <figure>
                            <img src="{{ asset('front/images/banner/01.png') }}" alt="Banner" width="1030" style="background-color: #fefefe; height:450px !important">
                        </figure>
                        <div class="banner-content">
                            <div class="slide-animate" data-animation-options="{
                                'name': 'fadeInLeftShorter', 'duration': '1s'
                            }">
                                <h5 class="banner-subtitle text-capitalize font-weight-normal">Des Ordinateurs</h5>
                               
                                <div class="banner-price-info font-weight-semi-bold text-body text-uppercase ls-m">
                                   <span class="text-white">Portable & Bureautique</span>
                                </div>
                                <p class="text-dark font-weight-normal">Parfait pour les professionnels et les particuliers.
                                </p>
                               
                                <a href="{{ route('magasin', ['category_name' => 'Ordinateur']) }}" class="btn btn-dark btn-rounded">
                                    Acheter Maintenant<i class="d-icon-arrow-right"></i>
                                </a>


                            </div>
                        </div>
                    </div>
                    <div class="banner banner-fixed content-middle intro-slide intro-slide2 banner-radius">
                        <figure>
                            <img src="{{ asset('front/images/banner/02.png') }}" alt="Banner" width="1030" height="450" style="background-color: #e2e2e3;height:450px !important">
                        </figure>
                        <div class="banner-content text-right">
                            <div class="slide-animate" data-animation-options="{
                                'name': 'fadeInRightShorter', 'duration': '1s'
                            }">
                                <h5 class="banner-subtitle text-capitalize font-weight-normal">Accessoires informatiques</h5>
                                <h3 class="banner-title text-uppercase font-weight-bold ls-m text-white">de qualité
                                </h3>
                                <p class="text-white font-weight-normal">Pour des performances au quotidien
                                </p>
                                <a href="{{ route('magasin', ['category_name' => 'Accessoires']) }}" class="btn btn-dark btn-rounded">
                                    Acheter Maintenant<i class="d-icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row cols-lg-1 cols-sm-2 cols-1">
                    <div class="intro-banner mb-4">
                        <div class="banner banner-fixed content-middle banner-radius overlay-zoom">
                            <figure>
                                <img src="{{ asset('front/images/banner/03.png') }}" alt="Intro Banner" width="330" style="background-color: #232323;height:215px">
                            </figure>
                            <div class="banner-content">
                                <h3 class="banner-title font-weight-bold text-white ls-m">Ordinateurs</h3>
                                <div class="product-count text-uppercase text-white font-weight-semi-bold">{{ $computerCount }}
                                    Produits</div>
                                <span class="divider bg-white"></span>
                                <a href="{{ route('magasin', ['category_name' => 'Ordinateur']) }}" class="btn btn-white btn-link btn-underline ls-m">
                                    Achetez maintenant<i class="d-icon-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="intro-banner mb-4">
                        <div class="banner banner-fixed content-middle banner-radius overlay-zoom">
                            <figure>
                                <img src="{{ asset('front/images/banner/04.png') }}" alt="Intro Banner" width="330" style="background-color: #eca5a9;  height:215px">
                            </figure>
                            <div class="banner-content">
                                <h3 class="banner-title font-weight-bold text-white ls-m">Accessories</h3>
                                <div class="product-count text-uppercase text-white font-weight-semi-bold">{{ $accessoiresCount }}
                                    Produits</div>
                                <span class="divider bg-white"></span>
                                <a href="{{ route('magasin', ['category_name' => 'Accessoires']) }}" class="btn btn-white btn-link btn-underline ls-m">
                                    Achetez maintenant<i class="d-icon-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="mb-10 pb-6">
    <div class="container">
        <h2 class="title title-line title-underline with-link">
            
            <a href="{{ route('magasin', ['category_name' => 'Ordinateur']) }}" class="btn btn-dark btn-link font-weight-semi-bold text-capitalize btn-more">Voir Plus<i class="d-icon-arrow-right"></i></a>
        </h2>
        <div class="product-wrapper products-grid row">
            <div class="banner-wrapper">
                <div class="banner banner-fixed content-top banner-radius" style="background-image: url(images/demos/demo-market1/banner/3.jpg);
                background-color: #313131;">
                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white text-uppercase">Collection</h4>
                        <h3 class="banner-title text-white font-weight-bold ls-m">Ordinateurs</h3>
                       
                        <a href="{{ route('magasin', ['category_name' => 'Ordinateur']) }}" class="btn btn-white btn-outline btn-rounded">Achter Maintenant<i class="d-icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @foreach ($computers as $product)
            <div class="product text-center">
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
                    
                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-cart" title="Ajouter au panier"><i class="d-icon-bag"></i></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Ajouter à la comparaison"><i class="d-icon-compare"></i></a>
                    </div>
                    <div class="product-action">
                        <a href="javascript:void(0);" class="btn-product btn-quickview" 
                            data-id="{{ $product->id }}" 
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}"
                            data-sku="{{ $product->sku }}"
                            data-description="{{ $product->description }}"
                            data-images="{{ json_encode($product->images) }}"
                            title="Quick View">Aperçu</a>

                        {{-- <a href="{{ route('products.show', $product->id) }}" class="btn-product btn-quickview" title="Quick View">Aperçu</a> --}}
                    </div>
                </figure>
                <div class="product-details">
                    <h4 class="product-name">
                        <a href="{{ route('products.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                    </h4>
                    <div class="product-price">
                        <ins class="new-price">{{ number_format($product->price, 0, '.', '') }} FCFA</ins>
                        <del class="old-price">{{ number_format($product->price, 0, '.', '') }} FCFA</del>
                    </div>
                </div>
            </div>
            @endforeach
            
            
        </div>
    </div>
</section>


<section class="grey-section pt-8 pb-4 mb-5">
    <div class="container">
        <div class="row cols-xl-5 cols-lg-4 cols-md-3 cols-sm-2 cols-1">
            @foreach ($categories as $category)
                <div class="category category-ellipse mb-4">
                    <figure class="category-media mr-2">
                        <a href="{{ route('magasin', ['category_name' => $category->name]) }}">
                            <img src="{{ asset($category->path) }}" style="height: 100px" alt="{{ $category->name }}" width="100" height="100">
                        </a>
                    </figure>
                    <div class="category-content pt-0 text-left">
                        <h3 class="category-name font-weight-normal ls-s">
                            <a href="{{ route('magasin', ['category_name' => $category->name]) }}">{{ $category->name }}</a>
                        </h3>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>
</section>


<section class="banner-group mt-4">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="banner banner-3 overlay-zoom banner-fixed banner-radius content-middle appear-animate" data-animation-options="{'name': 'fadeInLeftShorter', 'duration': '1s', 'delay': '.2s'}">
                    <figure>
                        <img src="{{ asset('front/images/banner/card_01.webp') }}" alt="banner" width="380" height="207" style="background-color: #000000;height:177px ">
                    </figure>
                    <div class="banner-content">
                        <h3 class="banner-title text-dark mb-1">Imprimantes</h3>
                        <h4 class="banner-subtitle text-uppercase font-weight-normal text-dark">
                            Des imprimantes laser et à jet d'encre.
                        </h4>
                        <hr class="banner-divider">
                        <a href="{{ route('magasin', ['category_name' => 'Imprimantes']) }}" class="btn btn-dark btn-link btn-underline">Acheter Maintenant<i class="d-icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4 order-lg-auto order-sm-last">
                <div class="banner banner-4 banner-fixed banner-radius overlay-effect2 content-middle content-center appear-animate" data-animation-options="{'name': 'fadeIn', 'duration': '1s', 'delay': '.2s'}">
                    <figure>
                        <img src="{{ asset('front/images/banner/card_02.jpg') }}" alt="banner" width="350" height="177" style="background-color: #1e1e1e;height:177px">
                    </figure>
                    <div class="banner-content d-flex align-items-center w-100 text-left">
                        <div class="mr-auto mb-4 mb-md-0">
                            
                            <h2 class="banner-title text-primary font-weight-bold lh-1 mb-0">Ecran</h2>
                        </div>
                        <a href="{{ route('magasin', ['category_name' => 'Ecrans']) }}" class="btn btn-primary btn-outline btn-rounded font-weight-bold text-white">Acheter Maintenant<i class="d-icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="banner overlay-zoom banner-5 banner-fixed banner-radius content-middle appear-animate" data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.2s'}">
                    <figure>
                        <img src="{{ asset('front/images/banner/card_03.jpg') }}" alt="banner" width="380" height="207" style="background-color: #97928b;height:177px">
                    </figure>
                    <div class="banner-content">
                        <h3 class="banner-title text-primary mb-1">Ordinateurs</h3>
                        <h4 class="banner-subtitle text-uppercase font-weight-bold text-white">Tous en 1
                        </h4>
                        <hr class="banner-divider">
                        <a href="{{ route('magasin', ['category_name' => 'Ordinateur']) }}" class="btn btn-dark btn-link btn-underline">Acheter Maintenant<i class="d-icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="mb-10 pb-6">
    <div class="container">
        <h2 class="title title-line title-underline with-link">
            <a href="{{ route('magasin', ['category_name' => ['Ecrans', 'Imprimantes']]) }}" class="btn btn-dark btn-link font-weight-semi-bold text-capitalize btn-more">
                Voir Plus<i class="d-icon-arrow-right"></i>
            </a>
            
            {{-- <a href="{{ route('magasin', ['category_name' => 'Ecran', 'Imprimantes']) }}" class="btn btn-dark btn-link font-weight-semi-bold text-capitalize btn-more">Voir Plus<i class="d-icon-arrow-right"></i></a> --}}
        </h2>
        <div class="product-wrapper products-grid row">
            <div class="banner-wrapper">
                <div class="banner banner-fixed content-bottom banner-radius" style="background-image: url(images/demos/demo-market1/banner/4.jpg);
                background-color: #61615e;">
                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white text-uppercase">Collections</h4>
                        <h3 class="banner-title text-white font-weight-bold ls-m">Ecrans & Imprimantes</h3>
                        
                        <a href="/magasin" class="btn btn-white btn-outline btn-rounded">Acheter Maintenant<i class="d-icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @foreach ($EcransImprimantes as $product)
            <div class="product text-center">
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
                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-cart" title="Ajouter au panier"><i class="d-icon-bag"></i></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Ajouter à la comparaison"><i class="d-icon-compare"></i></a>
                    </div>
                    <div class="product-action">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-product btn-quickview" title="Quick View">Aperçu</a>
                    </div>
                </figure>
                <div class="product-details">
                    <h4 class="product-name">
                        <a href="{{ route('products.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                    </h4>
                    <div class="product-price">
                        <ins class="new-price">{{ number_format($product->price, 0, '.', '') }} FCFA</ins>
                        <del class="old-price">{{ number_format($product->price, 0, '.', '') }} FCFA</del>                    </div>
                </div>
            </div>
            @endforeach
           
        </div>
    </div>
</section>


<section class="banner-section mb-10 pb-7">
    <div class="container">
        <div class="banner banner-radius" style="background-image: url(images/demos/demo-market1/banner/5.jpg); background-color: #2f2d2c;">
            <div class="banner-content content-left mr-4">
                <h3 class="banner-title text-white text-uppercase font-weight-bold ls-m">NOS AVANTAGES
                </h3>
                
            </div>
            <div class="banner-content content-right">
                <div class="owl-carousel owl-theme row cols-1" data-owl-options="{
                    'nav': true,
                    'dots': false,
                    'items': 1
                }">
                    <div class="banner-item text-center">
                        <h4 class="item-subtitle text-white text-uppercase font-weight-bold ls-m">Livraison
                        </h4>
                        <h3 class="item-title text-primary ls-m">en 24H</h3>
                        <a href="{{ route('magasin') }}" class="btn btn-white btn-link btn-slide-right">Acheter Maintenant<i class="d-icon-arrow-right"></i></a>
                    </div>
                    <div class="banner-item text-center">
                        <h4 class="item-subtitle text-white text-uppercase font-weight-bold ls-m">Qualité</h4>
                        <h3 class="item-title text-primary ls-m">FIABLE</h3>
                        <a href="{{ route('magasin') }}" class="btn btn-white btn-link btn-slide-right">Acheter Maintenant<i class="d-icon-arrow-right"></i></a>
                    </div>
                    <div class="banner-item text-center">
                        <h4 class="item-subtitle text-white text-uppercase font-weight-bold ls-m">Assistance</h4>
                        <h3 class="item-title text-primary ls-m">24H/24</h3>
                        <a href="{{ route('magasin') }}" class="btn btn-white btn-link btn-slide-right">Acheter Maintenant<i class="d-icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="mb-10 pb-7">
    <div class="container">
        <h2 class="title title-line title-underline with-link">
            
            <a href="{{ route('magasin', ['category_name' => 'Accessoires']) }}" class="btn btn-dark btn-link font-weight-semi-bold text-capitalize btn-more">Voir Plus<i class="d-icon-arrow-right"></i></a>
        </h2>
        <div class="product-wrapper products-grid row">
            <div class="banner-wrapper">
                <div class="banner banner-fixed content-top banner-radius" style="background-image: url(images/demos/demo-market1/banner/6.jpg);
                background-color: #313131;">
                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white text-uppercase">Collection</h4>
                        <h3 class="banner-title text-white font-weight-bold ls-m">Accessoires</h3>
                        
                        <a href="{{ route('magasin', ['category_name' => 'Accessoires']) }}" class="btn btn-white btn-outline btn-rounded">Acheter Maintenant<i class="d-icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @foreach ($accessoires as $product)
            <div class="product text-center">
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
                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-cart" title="Ajouter au panier"><i class="d-icon-bag"></i></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Ajouter à la comparaison"><i class="d-icon-compare"></i></a>
                    </div>
                    <div class="product-action">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-product btn-quickview" title="Quick View">Aperçu</a>
                    </div>
                </figure>
                <div class="product-details">
                    <h4 class="product-name">
                        <a href="{{ route('products.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                    </h4>
                    <div class="product-price">
                        <ins class="new-price">{{ number_format($product->price, 0, '.', '') }} FCFA</ins>
                        <del class="old-price">{{ number_format($product->price, 0, '.', '') }} FCFA</del>                    </div>
                    
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>


<section class="mb-10 pb-3">
    <div class="container">
        <h2 class="title title-line title-underline with-link">
            Top des ventes
        </h2>
        <div class="owl-carousel owl-theme row cols-xl-5 cols-lg-4 cols-md-3 cols-2" data-owl-options="{
            'nav': false,
            'dots': true,
            'margin': 20,
            'responsive': {
                '0': {
                    'items': 2
                },
                '576': {
                    'items': 3
                },
                '768': {
                    'items': 4
                },
                '992': {
                    'items': 5
                }
            }
        }">
            <div class="product text-center">
                <figure class="product-media">
                    <a href="#">
                        <img src="images/demos/demo-market1/product/34.jpg" alt="product" width="260" height="293">
                    </a>
                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-cart" title="Ajouter au panier"><i class="d-icon-bag"></i></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Ajouter à la comparaison"><i class="d-icon-compare"></i></a>
                    </div>
                    <div class="product-action">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-product btn-quickview" title="Quick View">Aperçu</a>
                    </div>
                </figure>
                <div class="product-details">
                    <h3 class="product-name">
                        <a href="#">Fashionable Hand Bag</a>
                    </h3>
                    <div class="product-price">
                        <ins class="new-price">{{ number_format($product->price, 0, '.', '') }} FCFA</ins>
                        <del class="old-price">{{ number_format($product->price, 0, '.', '') }} FCFA</del>                    </div>
                    
                </div>
            </div>
           
        </div>
    </div>
</section>

<section class="product-deals-wrapper mb-10 pb-6">
    <div class="container">
        <h2 class="title title-line title-underline with-link">
            Actuellement En Promotion
            <a href="{{ route('magasin', ['promotion' => 'true']) }}" class="btn btn-dark btn-link text-capitalize font-weight-semi-bold btn-more">
                Voir Plus<i class="d-icon-arrow-right"></i>
            </a>
        </h2>
        
        <div class="row grid-type">
            <!-- Affichage du premier produit -->
            @if($firstProduct)
            <div class="product-single-wrap">
                <div class="product product-single">
                    <div class="row product-gallery align-items-center mb-0">
                        <div class="col-md-6 p-relative mb-4 mb-md-0">
                            <div class="">
                                <figure class="product-image">

                                    @php
                                    // Récupérer l'image principale (vignette) associée au produit
                                    $thumbnail = $product->images()->where('is_thumbnail', true)->first();
                                @endphp

                                @if($thumbnail)

                                    {{-- <img src="{{ asset('storage/' . $firstProduct->thumbnail->path) }}" alt="{{ $product->name }}" width="280" height="315"> --}}
                                @else
                                    <p>Pas d'image disponible</p>
                                @endif

                                </figure>
                            </div>
                            <div class="countdown-container d-flex align-items-center font-weight-semi-bold text-white x-50 w-100 justify-content-center flex-wrap">
                                <label class="text-white text-capitalize mr-1">Prend fin dans:</label>
                                <div class="product-countdown countdown-compact" data-format="DHMS" data-until="+10d" data-relative="true" data-compact="true">00:00:00
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-details pb-0 pl-0">
                                <h2 class="product-name font-weight-semi-bold"><a href="{{ route('products.details', $firstProduct->slug) }}">{{ $firstProduct->name }}</a></h2>
                                <div class="product-price mb-2">
                                    <span class="price">{{ $firstProduct->price }} FCFA</span>
                                </div>
                                
                                <div class="product-form product-color">
                                    <label>Marque</label>
                                    <div class="product-form-group">
                                        <div class="product-variations">
                                            <a class="size" href="#">{{ $firstProduct->marque }}</a>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="product-form product-size">
                                    <label>Description:</label>
                                    <div class="product-form-group">
                                        <div class="product-variations">
                                            {{ \Illuminate\Support\Str::limit($firstProduct->description, 80, '...') }}
                                        </div>
                                        <a href="#" class="product-variation-clean">Clean All</a>
                                    </div>
                                </div>
                                <div class="product-variation-price">
                                    <span>${{ $firstProduct->price }}</span>
                                </div>
                                <div class="product-form product-qty mb-0">
                                    <div class="product-form-group">
                                        <div class="input-group mr-2 mb-0">
                                            <button class="quantity-minus d-icon-minus" title="quantity"></button>
                                            <input class="quantity form-control" type="number" min="1" max="1000000" title="quantity">
                                            <button class="quantity-plus d-icon-plus" title="quantity"></button>
                                        </div>
                                        <button class="btn-product btn-cart text-normal ls-normal font-weight-semi-bold mb-0"><i class="d-icon-bag"></i>Ajouter au Panier</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Affichage des autres produits -->
            @foreach($otherProducts as $product)
            <div class="product-wrap">
            
                <div class="product product-list-sm">
                    <a href="{{ route('products.details', $product->slug) }}" class="product-media">
                        <figure class="product-image">

                            @php
                            // Récupérer l'image principale (vignette) associée au produit
                            $thumbnail = $product->images()->where('is_thumbnail', true)->first();
                        @endphp

                        @if($thumbnail)

                            {{-- <img src="{{ asset('storage/' . $firstProduct->thumbnail->path) }}" alt="{{ $product->name }}" width="280" height="315"> --}}
                        @else
                            <p>Pas d'image disponible</p>
                        @endif

                        </figure>
                    </a>
                    <div class="product-details">
                        <h3 class="product-name">
                            <a href="{{ route('products.details', $product->slug) }}">{{ $product->name }}</a>
                        </h3>
                        <div class="product-price">
                            <ins class="new-price">{{ number_format($product->price, 0, '.', '') }} FCFA</ins> <br>
                            <del class="old-price">{{ number_format($product->price, 0, '.', '') }} FCFA</del>
                        </div>
                        {{-- <div class="product-price">
                            <span class="price">${{ $product->price }}</span>
                        </div> --}}
                        
                    </div>
                </div>
            
            </div>
            @endforeach
            
        </div>
    </div>
</section>

<section class="recent-product mb-10 pb-8">
    <div class="container">
        <h2 class="title title-line title-underline">Vos produits récemment consultés</h2>
        <div class="owl-carousel owl-theme row cols-xl-8 cols-lg-6 cols-md-5 cols-sm-3 cols-2" data-owl-options="{
            'nav': false,
            'dots': true,
            'margin': 20,
            'responsive': {
                '0': {
                    'items': 2
                },
                '576': {
                    'items': 3
                },
                '768': {
                    'items': 4
                },
                '992': {
                    'items': 6
                },
                '1200': {
                    'items': 8
                }
            }
        }">
            @foreach($recentlyViewedProducts as $product)
                <a href="{{ route('products.details', ['slug' => $product->slug]) }}">
                    <figure>
                        <img src="{{ asset('storage/' . ($product->images()->where('is_thumbnail', true)->first()->path ?? 'default.jpg')) }}" alt="{{ $product->name }}" width="155" height="174">
                    </figure>
                </a>
            @endforeach
        </div>
    </div>
</section>

@endsection