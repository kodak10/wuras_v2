@extends('front-end.layouts.master')

@section('content')

<div class="page-content mb-10 pb-6">
    <div class="container">
        <div class="product product-single row mb-7">
            <div class="col-md-6 sticky-sidebar-wrapper">
                <div class="product-gallery pg-vertical sticky-sidebar" data-sticky-options="{'minWidth': 767}">
                    <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                        @foreach($product->images as $image) <!-- Afficher toutes les images du produit -->
                            <figure class="product-image">
                                <img src="{{ asset('storage/' . $image->path) }}" data-zoom-image="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}" width="800" height="900">
                            </figure>
                        @endforeach
                    </div>
                    <div class="product-thumbs-wrap">
                        <div class="product-thumbs">
                            @foreach($product->images as $image) <!-- Miniatures des images -->
                                <div class="product-thumb @if($loop->first) active @endif">
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="product thumbnail" width="109" height="122">
                                </div>
                            @endforeach
                        </div>
                        <button class="thumb-up disabled"><i class="fas fa-chevron-left"></i></button>
                        <button class="thumb-down disabled"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    <div class="product-label-group">
                        @if($product->discount)
                            <label class="product-label label-sale">{{ $product->discount }}% OFF</label>
                        @endif
                        @if($product->is_new) <!-- Si le produit est marqué comme 'nouveau' -->
                            <label class="product-label label-new">new</label>
                        @endif
                    </div>
                </div>
            </div>
        
            <div class="col-md-6">
                <div class="product-details">
                   
        
                    <h1 class="product-name">{{ $product->name }}</h1>
                    <div class="product-meta">
                        Marque: <span class="product-brand">{{ $product->marque }}</span>
                    </div>
                    <div class="product-price">
                        @if($product->discount)
                            <ins class="new-price">{{ $product->price * (1 - $product->discount / 100) }} FCFA</ins>
                            <del class="old-price">{{ $product->price }} $</del>
                        @else
                            <ins class="new-price">{{ $product->price }} $</ins>
                        @endif
                    </div>
                  
                    <p class="product-short-desc">{{ $product->description }}</p>
        
                    <div class="product-form product-variations product-color">
                        <label>Couleur:</label>
                        
                    </div>
                    
                    <div class="product-variation-price">
                        <span>{{ $product->price }} FCFA</span>
                    </div>
        
                    <hr class="product-divider">
        
                    <div class="product-form product-qty">
                        <div class="product-form-group">
                            <div class="input-group mr-2">
                                <button class="quantity-minus d-icon-minus"></button>
                                <input class="quantity form-control" type="number" min="1" max="1000000">
                                <button class="quantity-plus d-icon-plus"></button>
                            </div>
                            <button class="btn-product btn-cart text-normal ls-normal font-weight-semi-bold"><i class="d-icon-bag"></i>Ajouter au Panier</button>
                        </div>
                    </div>
        
                    <hr class="product-divider mb-3">
        
                    <div class="product-footer">
                        <div class="social-links mr-4">
                            <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                            <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                            <a href="#" class="social-link social-pinterest fab fa-pinterest-p"></a>
                        </div>
                        <span class="divider d-lg-show"></span>
                        <a href="#" class="btn-product btn-compare"><i class="d-icon-compare"></i>Ajouter à comparer</a>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="tab tab-nav-simple product-tabs">
            <ul class="nav nav-tabs justify-content-center" role="tablist">
                
               
               
                <li class="nav-item">
                    <a class="nav-link active" href="#product-tab-reviews">Reviews (2)</a>
                </li>
            </ul>
            <div class="tab-content">
                
                
              
                <div class="tab-pane active" id="product-tab-reviews">
                    <div class="row">
                        <div class="col-lg-4 mb-6">
                            <div class="avg-rating-container">
                                <mark>5.0</mark>
                                <div class="avg-rating">
                                    <span class="avg-rating-title">Average Rating</span>
                                    <div class="ratings-container mb-0">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:100%"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <span class="rating-reviews">(2 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ratings-list mb-2">
                                <div class="ratings-item">
                                    <div class="ratings-container mb-0">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:100%"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                    <div class="rating-percent">
                                        <span style="width:100%;"></span>
                                    </div>
                                    <div class="progress-value">100%</div>
                                </div>
                                <div class="ratings-item">
                                    <div class="ratings-container mb-0">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:80%"></span>
                                            <span class="tooltiptext tooltip-top">4.00</span>
                                        </div>
                                    </div>
                                    <div class="rating-percent">
                                        <span style="width:0%;"></span>
                                    </div>
                                    <div class="progress-value">0%</div>
                                </div>
                                <div class="ratings-item">
                                    <div class="ratings-container mb-0">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:60%"></span>
                                            <span class="tooltiptext tooltip-top">4.00</span>
                                        </div>
                                    </div>
                                    <div class="rating-percent">
                                        <span style="width:0%;"></span>
                                    </div>
                                    <div class="progress-value">0%</div>
                                </div>
                                <div class="ratings-item">
                                    <div class="ratings-container mb-0">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:40%"></span>
                                            <span class="tooltiptext tooltip-top">4.00</span>
                                        </div>
                                    </div>
                                    <div class="rating-percent">
                                        <span style="width:0%;"></span>
                                    </div>
                                    <div class="progress-value">0%</div>
                                </div>
                                <div class="ratings-item">
                                    <div class="ratings-container mb-0">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:20%"></span>
                                            <span class="tooltiptext tooltip-top">4.00</span>
                                        </div>
                                    </div>
                                    <div class="rating-percent">
                                        <span style="width:0%;"></span>
                                    </div>
                                    <div class="progress-value">0%</div>
                                </div>
                            </div>
                            <a class="btn btn-dark btn-rounded submit-review-toggle" href="#">Submit
                                Review</a>
                        </div>
                        <div class="col-lg-8 comments pt-2 pb-10 border-no">
                            
                            <ul class="comments-list">
                                <li>
                                    <div class="comment">
                                        <figure class="comment-media">
                                            <a href="#">
                                                <img src="images/blog/comments/1.jpg" alt="avatar">
                                            </a>
                                        </figure>
                                        <div class="comment-body">
                                            <div class="comment-rating ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="comment-user">
                                                <span class="comment-date">by <span class="font-weight-semi-bold text-uppercase text-dark">John
                                                        Doe</span> on
                                                    <span class="font-weight-semi-bold text-dark">Nov 22,
                                                        2018</span></span>
                                            </div>

                                            <div class="comment-content mb-5">
                                                <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor
                                                    libero sodales leo,
                                                    eget blandit nunc tortor eu nibh. Nullam mollis. Ut
                                                    justo.
                                                    Suspendisse potenti.
                                                    Sed egestas, ante et vulputate volutpat, eros pede
                                                    semper
                                                    est, vitae luctus metus libero eu augue.</p>
                                            </div>
                                            <div class="file-input-wrappers">

                                                <img class="btn-play btn-img pwsp" src="images/products/product1.jpg" width="280" height="315" alt="product">


                                                <img class="btn-play btn-img pwsp" src="images/products/product3.jpg" width="280" height="315" alt="product">

                                                <a class="btn-play btn-iframe" style="background-image: url(images/product/product.jpg);background-size: cover;" href="video/memory-of-a-woman.mp4">
                                                    <i class="d-icon-play-solid"></i>
                                                </a>
                                            </div>
                                            <div class="feeling mt-5">
                                                <button class="btn btn-link btn-icon-left btn-slide-up btn-infinite like mr-2">
                                                    <i class="fa fa-thumbs-up"></i>
                                                    Like (<span class="count">0</span>)
                                                </button>
                                                <button class="btn btn-link btn-icon-left btn-slide-down btn-infinite unlike">
                                                    <i class="fa fa-thumbs-down"></i>
                                                    Unlike (<span class="count">0</span>)
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="comment">
                                        <figure class="comment-media">
                                            <a href="#">
                                                <img src="images/blog/comments/2.jpg" alt="avatar">
                                            </a>
                                        </figure>

                                        <div class="comment-body">
                                            <div class="comment-rating ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="comment-user">
                                                <span class="comment-date">by <span class="font-weight-semi-bold text-uppercase text-dark">John
                                                        Doe</span> on
                                                    <span class="font-weight-semi-bold text-dark">Nov 22,
                                                        2018</span></span>
                                            </div>

                                            <div class="comment-content">
                                                <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor
                                                    libero sodales leo, eget blandit nunc tortor eu nibh.
                                                    Nullam
                                                    mollis.
                                                    Ut justo. Suspendisse potenti. Sed egestas, ante et
                                                    vulputate volutpat,
                                                    eros pede semper est, vitae luctus metus libero eu
                                                    augue.
                                                    Morbi purus libero,
                                                    faucibus adipiscing, commodo quis, avida id, est. Sed
                                                    lectus. Praesent elementum
                                                    hendrerit tortor. Sed semper lorem at felis. Vestibulum
                                                    volutpat.</p>
                                            </div>
                                            <div class="feeling mt-5">
                                                <button class="btn btn-link btn-icon-left btn-slide-up btn-infinite like mr-2">
                                                    <i class="fa fa-thumbs-up"></i>
                                                    Like (<span class="count">0</span>)
                                                </button>
                                                <button class="btn btn-link btn-icon-left btn-slide-down btn-infinite unlike">
                                                    <i class="fa fa-thumbs-down"></i>
                                                    Unlike (<span class="count">0</span>)
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                            <nav class="toolbox toolbox-pagination justify-content-end">
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                            <i class="d-icon-arrow-left"></i>Prev
                                        </a>
                                    </li>
                                    <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item page-item-dots"><a class="page-link" href="#">6</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link page-link-next" href="#" aria-label="Next">
                                            Next<i class="d-icon-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- End Comments -->
                    <div class="review-form-section">
                        <div class="review-overlay"></div>
                        <div class="review-form-wrapper">
                            <div class="title-wrapper text-left">
                                <h3 class="title title-simple text-left text-normal">Add a Review</h3>
                                <p>Your email address will not be published. Required fields are marked *
                                </p>
                            </div>
                            <div class="rating-form">
                                <label for="rating" class="text-dark">Your rating * </label>
                                <span class="rating-stars selected">
                                    <a class="star-1" href="#">1</a>
                                    <a class="star-2" href="#">2</a>
                                    <a class="star-3" href="#">3</a>
                                    <a class="star-4 active" href="#">4</a>
                                    <a class="star-5" href="#">5</a>
                                </span>

                                <select name="rating" id="rating" required="" style="display: none;">
                                    <option value="">Rate…</option>
                                    <option value="5">Perfect</option>
                                    <option value="4">Good</option>
                                    <option value="3">Average</option>
                                    <option value="2">Not that bad</option>
                                    <option value="1">Very poor</option>
                                </select>
                            </div>
                            <form action="#">
                                <textarea id="reply-message" cols="30" rows="6" class="form-control mb-4" placeholder="Comment *" required=""></textarea>

                                <div class="review-medias">
                                    <div class="file-input form-control image-input" style="background-image: url(images/product/placeholder.png);">
                                        <div class="file-input-wrapper">
                                        </div>
                                        <label class="btn-action btn-upload" title="Upload Media">
                                            <input type="file" accept=".png, .jpg, .jpeg" name="riode_comment_medias_image_1">
                                        </label>
                                        <label class="btn-action btn-remove" title="Remove Media">
                                        </label>
                                    </div>
                                    <div class="file-input form-control image-input" style="background-image: url(images/product/placeholder.png);">
                                        <div class="file-input-wrapper">
                                        </div>
                                        <label class=" btn-action btn-upload" title="Upload Media">
                                            <input type="file" accept=".png, .jpg, .jpeg" name="riode_comment_medias_image_2">
                                        </label>
                                        <label class="btn-action btn-remove" title="Remove Media">
                                        </label>
                                    </div>
                                    <div class="file-input form-control video-input" style="background-image: url(images/product/placeholder.png);">
                                        <video class="file-input-wrapper" controls=""></video>
                                        <label class="btn-action btn-upload" title="Upload Media">
                                            <input type="file" accept=".avi, .mp4" name="riode_comment_medias_video_1">
                                        </label>
                                        <label class="btn-action btn-remove" title="Remove Media">
                                        </label>
                                    </div>
                                </div>
                                <p>Upload images and videos. Maximum count: 3, size: 2MB</p>
                                <button type="submit" class="btn btn-primary btn-rounded">Submit<i class="d-icon-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- End Reply -->
                </div>
            </div>
        </div>

        <section class="pt-3 mt-10">
            <h2 class="title justify-content-center">Related Products</h2>

            <div class="owl-carousel owl-theme owl-nav-full row cols-2 cols-md-3 cols-lg-4" data-owl-options="{
                'items': 5,
                'nav': false,
                'loop': false,
                'dots': true,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 2
                    },
                    '768': {
                        'items': 3
                    },
                    '992': {
                        'items': 4,
                        'dots': false,
                        'nav': true
                    }
                }
            }">
                <div class="product">
                    <figure class="product-media">
                        <a href="product-1.html">
                            <img src="images/product/featured1.jpg" alt="product" width="280" height="315">
                        </a>
                        <div class="product-label-group">
                            <label class="product-label label-new">new</label>
                        </div>
                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                            <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="d-icon-heart"></i></a>
                        </div>
                        <div class="product-action">
                            <a href="#" class="btn-product btn-quickview" title="Quick View">Quick View</a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="product-cat">
                            <a href="shop-grid-3col.html">Clothing</a>
                        </div>
                        <h3 class="product-name">
                            <a href="product-1.html">Solid Pattern in Summer Dress</a>
                        </h3>
                        <div class="product-price">
                            <span class="price">$140.00</span>
                        </div>
                        <div class="ratings-container">
                            <div class="ratings-full">
                                <span class="ratings" style="width:100%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <a href="#" class="rating-reviews">( <span class="review-count">12</span>
                                COMMENTAIRE
                                )</a>
                        </div>
                    </div>
                </div>
                <div class="product">
                    <figure class="product-media">
                        <a href="product-1.html">
                            <img src="images/product/featured2.jpg" alt="product" width="280" height="315">
                        </a>
                        <div class="product-label-group">
                            <label class="product-label label-sale">27% off</label>
                        </div>
                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                            <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="d-icon-heart"></i></a>
                        </div>
                        <div class="product-action">
                            <a href="#" class="btn-product btn-quickview" title="Quick View">Quick View</a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="product-cat">
                            <a href="shop-grid-3col.html">Bags & Backpacks</a>
                        </div>
                        <h3 class="product-name">
                            <a href="product-1.html">Mackintosh Poket Backpack</a>
                        </h3>
                        <div class="product-price">
                            <ins class="new-price">$125.99</ins><del class="old-price">$160.99</del>
                        </div>
                        <div class="ratings-container">
                            <div class="ratings-full">
                                <span class="ratings" style="width:60%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <a href="#" class="rating-reviews">( <span class="review-count">6</span> reviews
                                )</a>
                        </div>
                    </div>
                </div>
                <div class="product">
                    <figure class="product-media">
                        <a href="product-1.html">
                            <img src="images/product/featured3.jpg" alt="product" width="280" height="315">
                        </a>
                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                            <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="d-icon-heart"></i></a>
                        </div>
                        <div class="product-action">
                            <a href="#" class="btn-product btn-quickview" title="Quick View">Quick View</a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="product-cat">
                            <a href="shop-grid-3col.html">Clothing</a>
                        </div>
                        <h3 class="product-name">
                            <a href="product-1.html">Fashionable Orginal Trucker</a>
                        </h3>
                        <div class="product-price">
                            <span class="price">$78.64</span>
                        </div>
                        <div class="ratings-container">
                            <div class="ratings-full">
                                <span class="ratings" style="width:40%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <a href="#" class="rating-reviews">( <span class="review-count">2</span> reviews
                                )</a>
                        </div>
                    </div>
                </div>
                <div class="product">
                    <figure class="product-media">
                        <a href="product-1.html">
                            <img src="images/product/featured4.jpg" alt="product" width="280" height="315">
                        </a>
                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                            <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="d-icon-heart"></i></a>
                        </div>
                        <div class="product-action">
                            <a href="#" class="btn-product btn-quickview" title="Quick View">Quick View</a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="product-cat">
                            <a href="shop-grid-3col.html">Clothing</a>
                        </div>
                        <h3 class="product-name">
                            <a href="product-1.html">Women Red Fur Overcoat</a>
                        </h3>
                        <div class="product-price">
                            <span class="price">$184.00</span>
                        </div>
                        <div class="ratings-container">
                            <div class="ratings-full">
                                <span class="ratings" style="width:80%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <a href="#" class="rating-reviews">( <span class="review-count">6</span> reviews
                                )</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection