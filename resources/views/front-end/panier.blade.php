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
                        <!-- Les produits seront injectés ici via JavaScript -->
                    </tbody>
                </table>
                
                <div class="cart-actions mb-6 pt-4">
                    <a href="{{ route('magasin') }}" class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4"><i
                            class="d-icon-arrow-left"></i>Continuer vos achats</a>

                            

                    <button type="button" id="update-cart-button" class="btn btn-outline btn-dark btn-md btn-rounded btn-disabled" disabled>Mettre à jour</button>

                    {{-- <button type="submit"
                        class="btn btn-outline btn-dark btn-md btn-rounded btn-disabled">Update
                        Cart</button> --}}
                </div>
                
            </div>
            <aside class="col-lg-4 sticky-sidebar-wrapper">
                <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
                    <div class="summary mb-4">
                        <h3 class="summary-title text-left">Total du Panier</h3>
                        <table class="shipping">
                            <tr class="summary-subtotal">
                                <td>
                                    <h4 class="summary-subtitle">Sous-Total</h4>
                                </td>
                                <td>
                                    <p class="summary-subtotal-price" id="subtotal-price">0</p>
                                </td>
                            </tr>
                            <tr class="sumnary-shipping shipping-row-last">
                                <td colspan="2">
                                    <h4 class="summary-subtitle">Moyens de livraison</h4>
                                    <ul>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="flat_rate" name="shipping" class="custom-control-input" value="Retirer au Magasin" checked>
                                                <label class="custom-control-label" for="flat_rate">Retirer au Magasin</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="free-shipping" name="shipping" class="custom-control-input" value="Livraison / Expédition">
                                                <label class="custom-control-label" for="free-shipping">Livraison / Expédition</label>
                                            </div>
                                        </li>
                                        
                                    </ul>
                                </td>
                            </tr>
                        </table>
                        
                        <!-- Section de livraison qui sera affichée si l'utilisateur sélectionne "Livraison" -->
                        <div class="shipping-address mt-3" name="shipping_adresse" id="shipping-address" style="display: none;">
                            <div class="select-box">
                                <select name="commune" class="form-control" id="commune" onchange="updateShippingAddress()">
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
                                    <option value="Koumassi">Koumassi</option>
                                    <option value="Songon">Songon</option>
                                    <option value="Intérieur du Pays">Intérieur du Pays</option>
                                </select>
                            </div>
                            <input type="text" class="form-control" name="quartier" placeholder="Quartier" id="quartier" onkeyup="updateShippingAddress()"/>
                            <input type="text" class="form-control" name="phone" placeholder="Numéro de téléphone" id="phone" />
                        
                            <!-- Champ caché ou visible qui contient l'adresse complète -->
                            <input type="hidden" name="shipping_adresse" id="shipping_adresse" />
                        </div>
            
                        <table class="total">
                            


                            <tr class="summary-subtotal">
                                
                                <td>
                                    <h4 class="summary-subtitle">Total</h4>
                                </td>
                                <td>
                                    <p class="summary-total-price ls-s" id="total-price">0</p>
                                </td>
                            </tr>
                            
                        </table>
                        
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
    // Variables de gestion du panier
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const cartItems = document.getElementById("cart-items");
    const updateCartButton = document.getElementById("update-cart-button");
    const subtotalPriceElement = document.getElementById("subtotal-price");
    const totalPriceElement = document.getElementById("total-price");
    const freeShippingRadio = document.getElementById("free-shipping");
    const flatRateRadio = document.getElementById("flat_rate");
    const shippingAddress = document.getElementById("shipping-address");
    const shippingFeeRow = document.getElementById("shipping-fee-row");
    const shippingFeeElement = document.getElementById("shipping-fee");
    const shippingFee = 2000;

    // Initialisation de l'affichage du panier et des totaux
    updateCartDisplay();

    // Mise à jour de l'affichage du panier
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
                        <a href="#">
                            <img src="${item.image}" width="100" height="100" alt="product">
                        </a>
                    </figure>
                </td>
                <td class="product-name">
                    <div class="product-name-section">
                        <a href="#">${item.name}</a>
                    </div>
                </td>
                <td class="product-price">
                    <span class="amount">${item.price} FCFA</span>
                </td>
                <td class="product-quantity">
                    <div class="input-group">
                        <button class="quantity-minus d-icon-minus" onclick="updateQuantity('${item.id}', -1)"></button>
                        <input class="quantity form-control" type="number" min="1" value="${item.quantity}" onchange="enableUpdateButton()">
                        <button class="quantity-plus d-icon-plus" onclick="updateQuantity('${item.id}', 1)"></button>
                    </div>
                </td>
                <td class="product-subtotal">
                    <span class="amount">${subtotal.toFixed(2)} FCFA</span>
                </td>
                <td class="product-close">
                    <a href="#" class="product-remove" onclick="removeFromCart('${item.id}')">
                        <i class="fas fa-times"></i>
                    </a>
                </td>
            `;
            cartItems.appendChild(row);
        });

        // Mise à jour du total global
        subtotalPriceElement.textContent = totalPrice.toFixed(2) + " FCFA";
        updateTotal();
    }

    // Fonction de mise à jour de la quantité
    window.updateQuantity = function(productId, change) {
        let product = cart.find(item => item.id === productId);
        if (product) {
            product.quantity = Math.max(1, product.quantity + change);
            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartDisplay();
        }
    };

    // Fonction pour supprimer un produit du panier
    window.removeFromCart = function(productId) {
        cart = cart.filter(item => item.id !== productId);
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartDisplay();
    };

    // Active le bouton "Update Cart" quand la quantité est modifiée
    window.enableUpdateButton = function() {
        updateCartButton.disabled = false;
    };

    // Fonction pour mettre à jour les sous-totaux lors de l'édition de la quantité
    updateCartButton.addEventListener("click", function() {
        let cartItems = document.querySelectorAll(".quantity");
        cartItems.forEach(item => {
            let productId = item.closest('tr').getAttribute('data-product-id');
            let newQuantity = parseInt(item.value);
            let product = cart.find(p => p.id === productId);
            if (product) {
                product.quantity = newQuantity;
            }
        });

        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartDisplay();
        this.disabled = true;
    });

    // Écouteurs pour le changement d'option de livraison
    freeShippingRadio.addEventListener('change', function () {
        if (freeShippingRadio.checked) {
            shippingAddress.style.display = 'block'; // Afficher les champs de livraison
            shippingFeeRow.style.display = 'table-row'; // Afficher la ligne de frais de livraison
        }
        updateTotal();
    });

    flatRateRadio.addEventListener('change', function () {
        if (flatRateRadio.checked) {
            shippingAddress.style.display = 'none'; // Cacher les champs de livraison
            shippingFeeRow.style.display = 'none'; // Cacher la ligne de livraison
        }
        updateTotal();
    });

    // Fonction pour mettre à jour le total
    function updateTotal() {
        const subtotal = parseFloat(subtotalPriceElement.textContent.replace(' FCFA', ''));
        let total = subtotal;

        if (freeShippingRadio.checked) {
            total += shippingFee;
            shippingFeeElement.textContent = shippingFee + " FCFA";
        }

        totalPriceElement.textContent = total.toFixed(2) + " FCFA";
    }

    


    // Initialisation du total au chargement de la page
    updateTotal();
});

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Charger la valeur sélectionnée depuis le localStorage
        let selectedShipping = localStorage.getItem("shipping_method") || "flat_rate";
        document.getElementById(selectedShipping).checked = true;

        // Écouter le changement et sauvegarder la sélection
        document.querySelectorAll("input[name='shipping']").forEach(input => {
            input.addEventListener("change", function () {
                localStorage.setItem("shipping_method", this.id);
            });
        });
    });
</script>

<script>
    function updateShippingAddress() {
        var commune = document.getElementById('commune').value;
        var quartier = document.getElementById('quartier').value;
        
        // Créez l'adresse complète en combinant la commune et le quartier
        var fullAddress = commune + (quartier ? ', ' + quartier : '');

        // Mettre à jour le champ shipping_adresse
        document.getElementById('shipping_adresse').value = fullAddress;
    }
</script>
@endpush