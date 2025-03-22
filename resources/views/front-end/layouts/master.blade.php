<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Wuras | Ventes de matériel informatiques</title>

    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Riode - Ultimate eCommerce Template">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/icons/favicon-1.png">
    <!-- Preload Font -->
    {{-- <link rel="preload" href="{{ asset() }} fonts/riode.ttf?5gap68" as="font" type="font/woff2" crossorigin="anonymous"> --}}
    <link rel="preload" href="{{ asset('front/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }} " as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('front/vendor/fontawesome-free/webfonts/fa-brands-400-1.woff2') }} " as="font" type="font/woff2" crossorigin="anonymous">

    <script>
        WebFontConfig = {
            google: { families: [ 'Poppins:300,400,500,600,700,800' ] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[ 0 ];
            wf.src = '{{ asset('front/js/webfont.js') }}';
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>

    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/fontawesome-free/css/all.min-1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/animate/animate.min-1.css') }} ">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/magnific-popup/magnific-popup.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/owl-carousel/owl.carousel.min.css') }} ">

    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/sticky-icon/stickyicon.css') }} ">

    <!-- Main CSS File -->    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/style.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/market1.min-1.css') }} ">

    <style>
        /* Plein écran pour le loader */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease-out;
            z-index: 9999;
        }

        /* Loader animé */
        .loader {
            width: 60px;
            height: 60px;
            border: 6px solid rgba(255, 0, 0, 0.3);
            border-top-color: red;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Animation de rotation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Cache le loader une fois la page chargée */
        .hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .sticky-content-wrapper i{
            color: #ffffff;
        }
        .sticky-icon-links li a:hover {
            background: #f8f9fa !important;
            color: #000000!important;
        }

        .banner-group .img1{
            width: 300px; /* Ajuste la largeur selon ton besoin */
            height: 200px; /* Ajuste la hauteur selon ton besoin */
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url({{ asset('front/images/banner/card_01.webp') }});
            background-size: cover;
            background-position: center;
            border-radius: 10px; /* Optionnel pour des bords arrondis */
        }


    </style>
</head>

<body class="home market">

    <div class="loader-container" id="loader">
        <div class="loader"></div>
    </div>

    <div class="page-wrapper">
       
        @include('front-end.layouts.header')
        <!-- End Header -->

        <main class="main">
           @yield('content')
            
        </main>
        <!-- End Main -->

       @include('front-end.layouts.footer')
        <!-- End Footer -->
    </div>
    <!-- Sticky Footer -->
    <div class="sticky-footer sticky-content fix-bottom">
        <a href="/" class="sticky-link">
            <i class="d-icon-home"></i>
            <span>Accueil</span>
        </a>
        <a href="{{ route('magasin') }}" class="sticky-link">
            <i class="d-icon-volume"></i>
            <span>Magasin</span>
        </a>
        <a href="{{ route('panier') }}" class="sticky-link">
            <i class="d-icon-bag"></i>
            <span>Panier</span>
        </a>
        <a href="/home" class="sticky-link">
            <i class="d-icon-user"></i>
            <span>Compte</span>
        </a>
        <div class="header-search hs-toggle dir-up">
            <a href="#" class="search-toggle sticky-link">
                <i class="d-icon-search"></i>
                <span>Rechercher</span>
            </a>
            <form action="{{ route('magasin') }}" method="GET" class="input-wrapper">
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" autocomplete="off" placeholder="Rechercher..." required>
                <button class="btn btn-search" type="submit" title="submit-button">
                    <i class="d-icon-search"></i>
                </button>
            </form>
        </div>
        
    </div>
    <!-- Scroll Top -->
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="d-icon-arrow-up"></i></a>

    <!-- MobileMenu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay">
        </div>
        <!-- End of Overlay -->
        <a class="mobile-menu-close" href="#"><i class="d-icon-times"></i></a>
        <!-- End of CloseButton -->
        <div class="mobile-menu-container scrollable">
            <form action="{{ route('magasin') }}" method="GET" class="input-wrapper">
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" autocomplete="off" placeholder="Rechercher..." required>
                <button class="btn btn-search" type="submit" title="submit-button">
                    <i class="d-icon-search"></i>
                </button>
            </form>
            <!-- End of Search Form -->
            <ul class="mobile-menu mmenu-anim">
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a href="/">Accueil</a>
                </li>
                <li class="{{ Request::is('magasin*') ? 'active' : '' }}">
                    <a href="{{ route('magasin') }}">Magasin</a>
                </li>
                <li class="{{ Request::is('contact*') ? 'active' : '' }}">
                    <a href="{{ route('contact') }}">Contact</a>
                </li>
            
                <!-- Si l'utilisateur est non authentifié -->
                @guest
                    <li class="{{ Request::is('login') ? 'active' : '' }}">
                        <a href="{{ route('login') }}">Se Connecter</a>
                    </li>
                    <li class="{{ Request::is('register') ? 'active' : '' }}">
                        <a href="{{ route('register') }}">S'inscrire</a>
                    </li>
                @endguest
            
                <!-- Si l'utilisateur est authentifié -->
                @auth
                    @if(Auth::user()->hasRole(['Administrateur','Manager']))
                        <li class="{{ Request::is('mon-compte*') ? 'active' : '' }}">
                            <a href="/administration">Administration</a>
                        </li>
                    @endif

                    @if(Auth::user()->hasRole('User'))
                        <li class="{{ Request::is('mon-compte*') ? 'active' : '' }}">
                            <a href="/home">Mon Compte</a>
                        </li>
                    @endif
                   
                    
                    <li>
                        <a href="#" onclick="document.getElementById('logout-form').submit();" class="">
                            Se Déconnecter
                        </a>
                    
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    
                
                @endauth
            </ul>
            
        </div>
    </div>
    
    <!-- sticky icons-->
	<div class="sticky-icons-wrapper">
		<div class="sticky-icon-links">
			<ul>
				<li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a href="/"><i class="fas fa-home"></i><span>Accueil</span></a>
                </li>
                <li class="{{ Request::is('magasin') ? 'active' : '' }}">
                    <a href="/magasin"><i class="fas fa-shopping-bag"></i><span>Magasin</span></a>
                </li>
                <li class="{{ Request::is('contact') ? 'active' : '' }}">
                    <a href="{{ route('contact') }}"><i class="fas fa-phone"></i><span>Contacts</span></a>
                </li>
                
			</ul>
		</div>
		
	</div>

    @include('front-end.layouts.apercu')

    <script>
        // Lorsque la page est complètement chargée, cache le loader
        window.addEventListener("load", function() {
            document.getElementById("loader").classList.add("hidden");
        });
    </script>
    
    <script src="{{ asset('front/vendor/jquery/jquery.min.js') }}"></script>

	<!-- Plugins JS File -->
    <script src="{{ asset('front/vendor/jquery.plugin/jquery.plugin.min.js') }} "></script>
    <script src="{{ asset('front/vendor/imagesloaded/imagesloaded.pkgd.min.js') }} "></script>
    <script src="{{ asset('front/vendor/magnific-popup/jquery.magnific-popup.min.js') }} "></script>
    <script src="{{ asset('front/vendor/owl-carousel/owl.carousel.min.js') }} "></script>
    <script src="{{ asset('front/vendor/compare/compare.min.js') }} "></script>

    <script src="{{ asset('front/vendor/isotope/isotope.pkgd.min.js') }} "></script>
    <script src="{{ asset('front/vendor/photoswipe/photoswipe.min.js') }} "></script>
    <script src="{{ asset('front/vendor/photoswipe/photoswipe-ui-default.min.js') }} "></script>
    <script src="{{ asset('front/vendor/elevatezoom/jquery.elevatezoom.min.js') }} "></script>
    <script src="{{ asset('front/vendor/jquery.countdown/jquery.countdown.min.js') }} "></script>

    <!-- Main JS File -->
    <script src="{{ asset('front/js/main.min.js') }} "></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('successOrder'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Succès!',
            text: '{!! session('successOrder') !!}',
            confirmButtonText: 'Ok'  // Pas de point-virgule ici
        });
    </script>
@endif


    <script>
        document.addEventListener("DOMContentLoaded", function () {


            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            let compareList = JSON.parse(localStorage.getItem("compareList")) || [];
    
            updateCartDisplay();
            updateCompareDisplay();
            
    
            document.querySelectorAll(".btn-cart").forEach(button => {
                button.addEventListener("click", function (e) {
                    e.preventDefault();
                    let productElement = this.closest(".product");

                    // Debug: Afficher l'élément produit pour vérifier sa structure
                    console.log("Élément produit:", productElement);

                    let productId = productElement ? productElement.dataset.id : undefined;
                    let productName = productElement.querySelector(".product-name a").textContent;
                    let productPrice = parseFloat(productElement.querySelector(".new-price").textContent.replace(/\D/g, ''));
                    let productImage = productElement.querySelector("img").src;
                    let productSlug = productElement.dataset.slug;  // Récupération du slug

                    // Debug: Afficher l'ID du produit, son nom, prix, image, et slug
                    console.log('ID du produit:', productId);
                    console.log('Nom du produit:', productName);
                    console.log('Prix du produit:', productPrice);
                    console.log('Image du produit:', productImage);
                    console.log('Slug du produit:', productSlug);  // Affiche le slug

                    // Vérification si le produit est déjà dans le panier
                    let existingProduct = cart.find(item => item.id === productId);

                    if (existingProduct) {
                        existingProduct.quantity++;
                        console.log('Produit existant trouvé, quantité mise à jour');
                    } else {
                        cart.push({ id: productId, name: productName, price: productPrice, image: productImage, slug: productSlug, quantity: 1 });
                        console.log('Produit ajouté au panier');
                    }

                    // Sauvegarder les données dans le localStorage
                    localStorage.setItem("cart", JSON.stringify(cart));
                    updateCartDisplay();
                });
            });
    
            function updateCartDisplay() {
                let cartCount = document.querySelector(".cart-count");
                let cartPrice = document.querySelector(".cart-price");
                let carSousTotal = document.querySelector(".sous-price")
                let cartDropdown = document.querySelector(".cart-dropdown .products");
    
                if (cart.length === 0) {
                    cartCount.textContent = "0";
                    cartPrice.textContent = "0 FCFA";
                    carSousTotal.textContent = "0 FCFA";
                    cartDropdown.innerHTML = "<p>Votre panier est vide.</p>";
                } else {
                    let totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                    cartCount.textContent = cart.length;
                    cartPrice.textContent = totalPrice.toFixed(0) + " FCFA";
                    carSousTotal.textContent = totalPrice.toFixed(0) + " FCFA";
    
                    cartDropdown.innerHTML = cart.map(item => `
                        <div class="product product-cart">
                            <figure class="product-media">
                                <a href="#"><img src="${item.image}" width="80" height="88"></a>
                                <button class="btn btn-link btn-close" onclick="removeFromCart('${item.id}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </figure>
                            <div class="product-detail">
                                <a href="/magasin/${item.slug}" class="product-name">${item.name}</a>
                                <div class="price-box">
                                    <span class="product-quantity">${item.quantity}</span>
                                    <span class="product-price">${item.price} FCFA</span>
                                </div>
                            </div>
                        </div>
                    `).join("");
                }
            }

            
            window.removeFromCart = function(productId) {
                cart = cart.filter(item => item.id !== productId);
                localStorage.setItem("cart", JSON.stringify(cart));
                updateCartDisplay();
                console.log('Produit supprimé du panier:', productId);
            };


            window.updateQuantity = function(productId, change) {
                let product = cart.find(item => item.id == productId);
                if (product) {
                    product.quantity = Math.max(1, product.quantity + change);
                    localStorage.setItem("cart", JSON.stringify(cart));
                    updateCartDisplay();
                    console.log('Quantité mise à jour pour le produit:', productId, 'Nouvelle quantité:', product.quantity);
                }
            };


            // Comparaison
            document.querySelectorAll(".btn-compare").forEach(button => {
                button.addEventListener("click", function (e) {
                    e.preventDefault();
                    let productElement = this.closest(".product");

                    let productId = productElement.dataset.id;
                    let productName = productElement.querySelector(".product-name a").textContent;
                    let productImage = productElement.querySelector("img").src;
                    let productCategory = productElement.dataset.category;  // Récupération de la catégorie
                    let productPrice = productElement.dataset.price;  // Récupération du prix
                    let productMarque = productElement.dataset.marque;  // Récupération du poids
                    let productStock = productElement.dataset.stock;  // Récupération du stock
                    let productColor = productElement.dataset.color;  // Récupération des couleurs
                    let productDescription = productElement.dataset.description;  // Récupération de la description
                    let productSlug = productElement.dataset.slug;  // Récupération du slug

                    // Debug: Afficher les informations du produit pour vérifier
                    console.log('Slug du produit:', productSlug);

                    // Vérifie si le produit n'est pas déjà dans la liste de comparaison
                    if (!compareList.some(item => item.id === productId)) {
                        compareList.push({
                            id: productId,
                            name: productName,
                            image: productImage,
                            category: productCategory,
                            price: productPrice,
                            marque: productMarque,
                            stock: productStock,
                            color: productColor,
                            productDescription: productDescription,
                            slug: productSlug  // Ajoute le slug à l'objet
                        });

                        // Sauvegarde les modifications dans le cookie et localStorage
                        document.cookie = "compareList=" + JSON.stringify(compareList) + "; path=/";
                        localStorage.setItem("compareList", JSON.stringify(compareList));
                        updateCompareDisplay();
                    }
                });
            });



    
            function updateCompareDisplay() {
                let compareDropdown = document.querySelector(".compare-dropdown .products");

                if (!compareDropdown) {
                    console.warn("Élément .compare-dropdown .products introuvable.");
                    return;
                }

                if (compareList.length === 0) {
                    compareDropdown.innerHTML = "<p>Aucun produit en comparaison.</p>";
                } else {
                    compareDropdown.innerHTML = compareList.map(item => `
                        <div class="product product-compare">
                            <figure class="product-media">
                                <a href="/magasin/${item.slug}"><img src="${item.image}" width="80" height="88" alt="${item.name}"></a>
                                <button class="btn btn-link btn-close" onclick="removeFromCompare('${item.id}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </figure>
                            <div class="product-detail">
                                <a href="/magasin/${item.slug}" class="product-name">${item.name}</a>
                                
                            </div>
                        </div>
                    `).join("");
                }
            }



    
            window.removeFromCompare = function(productId) {
                compareList = compareList.filter(item => item.id !== productId);
                document.cookie = "compareList=" + JSON.stringify(compareList) + "; path=/";
                localStorage.setItem("compareList", JSON.stringify(compareList));
                updateCompareDisplay();
                console.log('Produit supprimé de la comparaison:', productId);
            };

    
           
        });
    </script>
    

    
   
        @stack('scripts')
        
        

</body>

</html>