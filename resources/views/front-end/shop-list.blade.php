

<div class="product-lists product-wrapper">
    @foreach ($products as $products)
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
    @endforeach
    
    
</div>


