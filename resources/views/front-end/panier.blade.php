@extends('front-end.layouts.master')

@section('content')
<div class="page-content pt-7 pb-10">
    <div class="step-by pr-4 pl-4">
        <h3 class="title title-simple title-step active"><a href="{{ route('panier') }}">1. Panier</a></h3>
        <h3 class="title title-simple title-step"><a href="{{ route('checkout') }}">2. Recapitulatif</a></h3>
        <h3 class="title title-simple title-step"><a href="#">3. Commande Terminée</a></h3>
    </div>
    <div class="container mt-7 mb-2">
        <div class="row">
            <div class="col-lg-8 col-md-12 pr-lg-4">
                <table class="shop-table cart-table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th></th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Sous-total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <!-- Produits injectés ici via JavaScript -->
                    </tbody>
                </table>

                <div class="cart-actions mb-6 pt-4">
                    <a href="{{ route('magasin') }}" class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4">
                        <i class="d-icon-arrow-left"></i>Continuer vos achats
                    </a>
                    <button id="update-cart-button" class="btn btn-primary btn-md btn-rounded" onclick="refreshPage()">Mettre à jour</button>
                </div>
            </div>

            <aside class="col-lg-4 sticky-sidebar-wrapper">
                <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
                    <div class="summary mb-4">
                        <h3 class="summary-title text-left">Total du Panier</h3>
                        <table class="shipping">
                            <tr class="summary-subtotal">
                                <td><h4 class="summary-subtitle">Total</h4></td>
                                <td><p class="summary-subtotal-price" id="subtotal-price">0</p></td>
                            </tr>
                            <tr class="sumnary-shipping shipping-row-last">
                                <td colspan="2">
                                    <h4 class="summary-subtitle">Moyens de livraison</h4>
                                    <ul>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="free-shipping" name="shipping" class="custom-control-input" value="Retirer au Magasin">
                                                <label class="custom-control-label" for="free-shipping">Retirer au Magasin</label>
                                            </div>
                                        </li>
                                        <li class="mb-5">
                                            <div class="custom-radio">
                                                <input type="radio" id="flat_rate" name="shipping" class="custom-control-input" value="Livraison / Expédition">
                                                <label class="custom-control-label" for="flat_rate">Livraison / Expédition</label>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </table>

                        <div class="shipping-address mt-3" id="shipping-address" style="display: none;">
                            <div class="select-box">
                                <select name="commune" class="form-control" id="commune">
                                    <option selected>Lieu</option>
                                    <option value="Abobo">Abobo</option>
                                    <option value="Cocody">Cocody</option>
                                    <option value="Bassam">Bassam</option>
                                    <option value="Yopougon">Yopougon</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Adjamé">Adjamé</option>
                                    <option value="Koumassi">Koumassi</option>
                                    <option value="Marcory">Marcory</option>
                                    <option value="Treichville">Treichville</option>
                                    <option value="Port-Bouët">Port-Bouët</option>
                                    <option value="Attécoubé">Attécoubé</option>
                                    <option value="Songon">Songon</option>
                                    <option value="Intérieur du Pays">Intérieur du Pays</option>
                                </select>
                            </div>
                            <input type="text" class="form-control" name="quartier" placeholder="Quartier" id="quartier"/>
                            <input type="text" class="form-control" name="phone" placeholder="Numéro de téléphone" id="phone"/>
                            <input type="hidden" name="shipping_adresse" id="shipping_adresse"/>
                        </div>

                        <a href="{{ route('checkout') }}" class="btn btn-dark btn-rounded btn-checkout">Passer la commande</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const savedShippingMethod = localStorage.getItem("shipping_method");

        if (savedShippingMethod === "Livraison / Expédition") {
            document.getElementById("flat_rate").checked = true;
            document.getElementById("shipping-address").style.display = 'block';
        } else {
            document.getElementById("free-shipping").checked = true;
            document.getElementById("shipping-address").style.display = 'none';
        }

        const savedShippingAdresse = localStorage.getItem("shipping_address");


        document.querySelectorAll('input[name="shipping"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const shippingAddressSection = document.getElementById('shipping-address');

                if (this.value === 'Livraison / Expédition') {
                    shippingAddressSection.style.display = 'block';
                    localStorage.setItem("shipping_method", "Livraison / Expédition");
                } else {
                    shippingAddressSection.style.display = 'none';
                    localStorage.setItem("shipping_method", "Retirer au Magasin");
                }
            });
        });

        // Chargement des valeurs sauvegardées dans localStorage pour l'adresse
        if (localStorage.getItem('commune')) document.getElementById('commune').value = localStorage.getItem('commune');
        if (localStorage.getItem('quartier')) document.getElementById('quartier').value = localStorage.getItem('quartier');
        if (localStorage.getItem('phone')) document.getElementById('phone').value = localStorage.getItem('phone');
        
        updateShippingAddress();
    });

    function updateShippingAddress() {
        const commune = document.getElementById('commune').value;
        const quartier = document.getElementById('quartier').value;
        const phone = document.getElementById('phone').value;
        const fullAddress = `${commune}, ${quartier}, ${phone}`;

        localStorage.setItem('commune', commune);
        localStorage.setItem('quartier', quartier);
        localStorage.setItem('phone', phone);

        // Correction ici
        document.getElementById('shipping_address').value = fullAddress;
    }

    // Mise à jour automatique de l'adresse lorsque l'utilisateur change un champ
    document.getElementById('commune').addEventListener('change', updateShippingAddress);
    document.getElementById('quartier').addEventListener('keyup', updateShippingAddress);
    document.getElementById('phone').addEventListener('keyup', updateShippingAddress);
</script>



<script>
document.addEventListener("DOMContentLoaded", function () {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const cartItems = document.getElementById("cart-items");
    const subtotalPriceElement = document.getElementById("subtotal-price");

    function updateCartDisplay() {
        cartItems.innerHTML = "";
        let totalPrice = 0;

        if (cart.length === 0) {
            cartItems.innerHTML = "<tr><td colspan='6' class='text-center'>Votre panier est vide.</td></tr>";
            return;
        }

        cart.forEach(item => {
            const subtotal = item.price * item.quantity;
            totalPrice += subtotal;

            let row = document.createElement("tr");
            row.setAttribute("data-product-id", item.id);
            row.innerHTML = `
                <td class="product-thumbnail">
                    <figure>
                        <a href="/magasin/${item.slug}">
                            <img src="${item.image}" width="100" height="100" alt="product">
                        </a>
                    </figure>
                </td>
                <td class="product-name">
                    <a href="/magasin/${item.slug}">${item.name}</a>
                </td>
                <td class="product-price">
                    <span class="amount">${item.price} FCFA</span>
                </td>
                <td class="product-quantity">
                    <div class="input-group">
                        <button class="quantity-minus" data-id="${item.id}" data-change="-1">-</button>
                        <input class="form-control quantity-input" type="number" min="1" value="${item.quantity}" data-id="${item.id}">
                        <button class="quantity-plus" data-id="${item.id}" data-change="1">+</button>
                    </div>
                </td>
                <td class="product-subtotal">
                    <span class="amount subtotal">${subtotal.toFixed(0)} FCFA</span>
                </td>
                <td class="product-close">
                    <a href="#" class="product-remove" data-id="${item.id}">
                        <i class="fas fa-times"></i>
                    </a>
                </td>
            `;
            cartItems.appendChild(row);
        });

        subtotalPriceElement.textContent = totalPrice.toFixed(0) + " FCFA";
    }

    function updateQuantity(productId, change) {
        let product = cart.find(item => item.id.toString() === productId.toString());
        if (product) {
            product.quantity = Math.max(1, product.quantity + change);
            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartDisplay();
        }
    }

    function removeFromCart(productId) {
        cart = cart.filter(item => item.id.toString() !== productId.toString());
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartDisplay();
    }

    cartItems.addEventListener("click", function (event) {
        if (event.target.matches(".quantity-minus, .quantity-plus")) {
            const productId = event.target.getAttribute("data-id");
            const change = parseInt(event.target.getAttribute("data-change"), 10);
            updateQuantity(productId, change);
        }

        // Vérifie si le bouton cliqué est pour supprimer
        const removeButton = event.target.closest(".product-remove");
        if (removeButton) {
            const productId = removeButton.getAttribute("data-id");
            removeFromCart(productId);
        }
    });

    cartItems.addEventListener("input", function (event) {
        if (event.target.matches(".quantity-input")) {
            const productId = event.target.getAttribute("data-id");
            const newQuantity = parseInt(event.target.value, 10) || 1;
            let product = cart.find(p => p.id.toString() === productId.toString());
            if (product) {
                product.quantity = Math.max(1, newQuantity);
                localStorage.setItem("cart", JSON.stringify(cart));
                updateCartDisplay();
            }
        }
    });

    updateCartDisplay();
});

</script>



<script>
    // Fonction pour activer le bouton de mise à jour
    function enableUpdateButton() {
        const updateButton = document.getElementById('update-cart-button');
        updateButton.classList.remove('disabled');

        updateQuantity();
    }

    // Fonction pour mettre à jour la quantité (ajouter ou soustraire)
    function updateQuantity(itemId, change) {
        const quantityInput = document.getElementById(`quantity-${itemId}`);
        let currentQuantity = parseInt(quantityInput.value, 10);
        currentQuantity += change;
        
        // Assurer que la quantité ne soit jamais inférieure à 1
        if (currentQuantity < 1) currentQuantity = 1;
        
        quantityInput.value = currentQuantity;
        enableUpdateButton();
    }

    // Fonction pour actualiser la page
    function refreshPage() {
        location.reload();  // Recharge la page actuelle
    }
</script>

@endpush