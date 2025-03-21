@extends('front-end.layouts.master')

@section('content')
<div class="page-content pt-7 pb-10 mb-10">
    <div class="step-by pr-4 pl-4">
        <h3 class="title title-simple title-step"><a href="{{ route('panier') }}">1. Panier</a></h3>
        <h3 class="title title-simple title-step active"><a href="{{ route('checkout') }}">2. Recapitulatif</a></h3>
        <h3 class="title title-simple title-step"><a href="#">3. Commande Terminée</a></h3>
    </div>

    <div class="container mt-7 m-auto">
        <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <input type="hidden" name="shipping_method" id="shipping_method">
            <input type="hidden" name="shipping_address" id="shipping_address">
            <input type="hidden" name="cart_data" id="cart_data">
            <input type="hidden" name="total_price" id="total_price">
            <input type="hidden" name="id" id="id">

            <div class="row">
                <aside class="col-lg-5 sticky-sidebar-wrapper m-auto" style="margin: auto">
                    <div class="sticky-sidebar mt-1" data-sticky-options="{'bottom': 50}">
                        <div class="summary pt-5">
                            <h3 class="title title-simple text-left text-uppercase">Votre commande</h3>
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix</th>
                                    </tr>
                                </thead>
                                <tbody id="order-items">
                                    <!-- Produits affichés dynamiquement -->
                                </tbody>
                                <tr class="summary-shipping-method">
                                    <td><h4 class="summary-subtitle">Moyen de Livraison</h4></td>
                                    <td><p id="delivery-method" class="text-body">Non sélectionné</p></td>
                                </tr>
                                <!-- Ajout de l'adresse et du téléphone sous la méthode de livraison -->
                                <tr id="shipping-address-row" class="summary-shipping-address">
                                    <td><h4 class="summary-subtitle">Adresse de Livraison</h4></td>
                                    <td><p id="shipping-address" class="text-body">Non spécifié</p></td>
                                </tr>
                                
                                <tr class="summary-total">
                                    <td><h4 class="summary-subtitle">Total</h4></td>
                                    <td><p id="subtotal-price" class="summary-total-price ls-s text-primary">0 FCFA</p></td>
                                </tr>
                            </table>

                            <div class="row">
                                <button type="submit" class="btn btn-dark btn-rounded btn-order mt-2 mb-2">Valider la commande</button>
                                <a class="btn btn-success btn-rounded" href="{{ route('panier') }}">Retour</a>
                            </div>
                            
                        </div>
                    </div>
                </aside>
            </div>
        </form>

        <div id="checkout-message" class="mt-4"></div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const orderItems = document.getElementById("order-items");
    const subtotalPriceElement = document.getElementById("subtotal-price");
    const deliveryMethodElement = document.getElementById("delivery-method");
    const deliveryAddressElement = document.getElementById("shipping-address");
    const shippingAddressRow = document.getElementById("shipping-address-row");

    function updateOrderDisplay() {
        orderItems.innerHTML = "";
        let subtotal = 0;

        if (cart.length === 0) {
            orderItems.innerHTML = "<tr><td colspan='2' class='text-center'>Votre panier est vide.</td></tr>";
            return;
        }

        cart.forEach(item => {
            let row = document.createElement("tr");
            row.innerHTML = `<td>${item.name} × ${item.quantity}</td><td>${(item.price * item.quantity).toFixed(0)} FCFA</td>`;
            orderItems.appendChild(row);
            subtotal += item.price * item.quantity;
        });

        subtotalPriceElement.textContent = subtotal.toFixed(0) + " FCFA";

        // Récupération de la méthode de livraison depuis localStorage
        let selectedDeliveryMethod = localStorage.getItem("shipping_method") || "Retirer au Magasin";
        deliveryMethodElement.textContent = selectedDeliveryMethod;

        if (selectedDeliveryMethod === "Retirer au Magasin") {
            shippingAddressRow.style.display = "none"; // Masquer l'adresse
            document.getElementById("shipping_method").value = "Retirer au Magasin";
            document.getElementById("shipping_address").value = ""; // Pas d'adresse pour le retrait en magasin
        } else {
            // Affichage de l'adresse de livraison
            let deliveryCommune = localStorage.getItem("commune") || "Non spécifié";
            let deliveryQuartier = localStorage.getItem("quartier") || "Non spécifié";
            let deliveryPhone = localStorage.getItem("phone") || "Non spécifié";

            let fullDeliveryAddress = `${deliveryCommune}, ${deliveryQuartier}, ${deliveryPhone}`;
            deliveryAddressElement.textContent = fullDeliveryAddress;
            shippingAddressRow.style.display = "table-row"; // Afficher l'adresse

            document.getElementById("shipping_method").value = "Livraison / Expédition";
            document.getElementById("shipping_address").value = fullDeliveryAddress; // Enregistrer l'adresse
        }

        // Mise à jour des valeurs cachées dans le formulaire
        document.getElementById("cart_data").value = JSON.stringify(cart);
        document.getElementById("total_price").value = subtotal.toFixed(0);

        // Debug console
        console.log("Méthode de livraison :", selectedDeliveryMethod);
        console.log("Sous-total de la commande :", subtotal.toFixed(0) + " FCFA");
        console.log("Adresse complète de livraison :", document.getElementById("shipping_address").value);
    }

    updateOrderDisplay();
});

</script>
</script>
@endpush
