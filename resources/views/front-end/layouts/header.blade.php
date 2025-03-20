<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg ls-normal">Bienvenue sur Wuras, votre destination de matériel informatique !</p>
            </div>
            <div class="header-right d-none d-xl-flex">
                <span class="divider"></span>
            
                @auth
                    @if(Auth::user()->hasRole('Administrateur'))
                        <a href="/administration" class="help d-lg-show">
                            <i class="d-icon-home"></i> Administration
                        </a>
                    @endif
                    
                    @if(Auth::user()->hasRole('User'))
                        <a href="/home" class="help d-lg-show">
                            <i class="d-icon-home"></i> Mon Compte
                        </a>
                    @endif
                   
                   
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="text-white" style="border: none; background: none; cursor: pointer;">
                            <i class="d-icon-user"></i> Se Déconnecter
                        </button>
                    </form>
                @endauth
            
                @guest
                    <a class="" href="{{ route('login') }}">
                        <i class="d-icon-user mr-1"></i> Se Connecter
                    </a>
                    <span class="delimiter">/</span>
                    <a class=" ml-0" href="{{ route('register') }}">
                        S'Inscrire
                    </a>
                @endguest
            </div>
            
        </div>
       
    </div>

   

    <div class="header-middle sticky-header fix-top sticky-content">
        <div class="container">
            <div class="header-left mr-4">
                <a href="#" class="mobile-menu-toggle">
                    <i class="d-icon-bars2"></i>
                </a>
                <a href="/" class="logo">
                    <img src="{{ asset('front/logo.webp') }}" alt="logo" style="width:150% !important">
                </a>

                <div class="header-search hs-expanded">
                    <form action="{{ route('magasin') }}" method="GET" class="input-wrapper">
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" autocomplete="off" placeholder="Rechercher..." required>
                        <button class="btn btn-search" type="submit" title="Rechercher">
                            <i class="d-icon-search" style="color: #000 !important;"></i>
                        </button>
                    </form>
                </div>
                

            </div>
            <div class="header-right">
                <div class="icon-box icon-box-side">
                    <div class="icon-box-icon mr-0 mr-lg-2">
                        <i class="d-icon-phone"></i>
                    </div>
                    <div class="icon-box-content d-lg-show">
                        <h2 class="icon-box-title text-dark text-normal">
                          </h2>
                        <p><a href="tel:0749667007">0749667007</a></p>
                    </div>
                </div>
                {{-- <span class="divider mr-4"></span>
                <div class="dropdown compare-dropdown off-canvas mr-xl-7 mr-4">
                    <a href="#" class="compare compare-toggle mr-0" title="compare">
                        <i class="d-icon-compare"></i>
                    </a>
                    <div class="canvas-overlay"></div>
                    <!-- End Compare Toggle -->
                    <div class="dropdown-box scrollable">
                        <div class="canvas-header">
                            <h4 class="canvas-title">Comparer</h4>
                            <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close">Fermer<i class="d-icon-arrow-right"></i><span class="sr-only">Compare</span></a>
                        </div>
                        <div class="products scrollable">
                            <div class="product product-compare">
                                <figure class="product-media">
                                    <a href="product-1.html">
                                        <img src="images/compare/product-1-1.jpg" alt="product" width="80" height="88">
                                    </a>
                                    <button class="btn btn-link btn-close">
                                        <i class="fas fa-times"></i><span class="sr-only">Fermer</span>
                                    </button>
                                </figure>
                                <div class="product-detail">
                                    <a href="product-1.html" class="product-name">Riode White Trends</a>
                                    <div class="price-box">
                                        <span class="product-price">$21.00
                                            <del class="old-price pl-1">$40.00</del>
                                        </span>
                                    </div>
                                </div>

                            </div>
                           
                        </div>
                        <a href="{{ route('compare') }}" class="btn btn-dark compare-btn mt-4"><span>Aller à Comparaison
                                </span></a>
                        <!-- End of Products  -->
                    </div>
                    <!-- End Dropdown Box -->
                </div> --}}
               
                <span class="divider"></span>
                <div class="dropdown cart-dropdown type2 off-canvas mr-0 mr-lg-2">
                    <a href="#" class="cart-toggle label-block link">
                        <div class="cart-label d-lg-show">
                            <span class="cart-name">Panier:</span>
                            <span class="cart-price">00 FCFA</span>
                        </div>
                        <i class="d-icon-bag"><span class="cart-count">0</span></i>
                    </a>
                    <div class="canvas-overlay"></div>
                    <!-- End Cart Toggle -->
                    <div class="dropdown-box">
                        <div class="canvas-header">
                            <h4 class="canvas-title">Panier</h4>
                            <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close">Fermer<i class="d-icon-arrow-right"></i><span class="sr-only">Cart</span></a>
                        </div>
                        <div class="products scrollable">
                            {{-- <div class="product product-cart">
                                <figure class="product-media">
                                    <a href="product-1.html">
                                        <img src="images/cart/product-1-1.jpg" alt="product" width="80" height="88">
                                    </a>
                                    <button class="btn btn-link btn-close">
                                        <i class="fas fa-times"></i><span class="sr-only">Fermer</span>
                                    </button>
                                </figure>
                                <div class="product-detail">
                                    <a href="product-1.html" class="product-name">Riode White Trends</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$21.00</span>
                                    </div>
                                </div>

                            </div> --}}
                          
                        </div>
                        <!-- End of Products  -->
                        <div class="cart-total">
                            <label>Sous Total:</label>
                            <span class="sous-price">00</span>
                        </div>
                        <!-- End of Cart Total -->
                        <div class="cart-action">
                            <a href="{{ route('panier') }}" class="btn btn-dark btn-link">Voir Panier</a>
                            <a href="{{ route('checkout') }}" class="btn btn-dark"><span>Payer</span></a>
                        </div>
                        <!-- End of Cart Action -->
                    </div>
                    <!-- End Dropdown Box -->
                </div>
            </div>
        </div>
    </div>

   
    <div class="header-bottom d-lg-show">
        <div class="container">
            <div class="header-left">
                <nav class="main-nav">
                    <ul class="menu">
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                            <a href="/">Accueil</a>
                        </li>
                        <li class="{{ Request::is('magasin*') ? 'active' : '' }}">
                            <a href="/magasin">Magasin</a>
                        </li>
                        <li class="{{ Request::is('contact') ? 'active' : '' }}">
                            <a href="{{ route('contact') }}">Contactez-Nous</a>
                        </li>
                    </ul>
                    
                </nav>
            </div>
            
        </div>
    </div>
</header>