@extends('Administration.layouts.master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Gestion des Ventes</h1>

    <div class="row">
        <!-- Liste des Produits -->
        <div class="col-md-7">
            <h3>Produits Disponibles</h3>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table id="products-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 2) }} FCFA</td>
                            <td>
                                <button class="btn btn-primary btn-sm add-to-cart" 
                                    data-id="{{ $product->id }}" 
                                    data-name="{{ $product->name }}" 
                                    data-price="{{ $product->price }}">
                                    Ajouter
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Panier -->
        <div class="col-md-5">
            <h3>Panier</h3>
            <table class="table table-bordered" id="cart-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Réduction</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            {{-- <h4 class="text-right mt-3">Total avant réduction: <span id="subtotal-price">0</span> FCFA</h4>
            <h4 class="text-right mt-3">Réduction globale: 
                <input type="number" id="discount" class="form-control" min="0" placeholder="Ex: 5000"> --}}
            </h4>
            <h4 class="text-right mt-3">Total après réduction: <span id="total-price">0</span> FCFA</h4>

            <button class="btn btn-success mt-3" id="validate-sale">Valider la Vente</button>

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès!',
                        text: "{{ session('success') }}",
                        confirmButtonColor: '#3085d6'
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur!',
                        text: "{{ session('error') }}",
                        confirmButtonColor: '#d33'
                    });
                </script>
            @endif

        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery & DataTables CDN -->
<script>
$(document).ready(function () {
    let cart = [];
    let subtotal = 0;
    let discountPercentage = 0;

    console.log("Script chargé !");

    // Initialisation de DataTables
    $('#products-table').DataTable();

    // Ajouter un produit au panier
    $(document).on('click', '.add-to-cart', function () {
        console.log("Bouton Ajouter cliqué !");
        
        const id = $(this).data('id');
        const name = $(this).data('name');
        const price = parseFloat($(this).data('price'));

        console.log(`Ajout du produit - ID: ${id}, Nom: ${name}, Prix: ${price}`);

        // Vérifier si le produit est déjà dans le panier
        let existingProduct = cart.find(item => item.id === id);
        if (existingProduct) {
            existingProduct.quantity++;
            existingProduct.total = (existingProduct.quantity * existingProduct.price) - existingProduct.discount;

            // Vérification pour éviter un total négatif
            if (existingProduct.total < 0) {
                existingProduct.total = 0;
            }
        } else {
            cart.push({
                id: id,
                name: name,
                price: price,
                quantity: 1,
                total: price,
                discount: 0
            });
        }


        updateCartTable();
    });

    // Mettre à jour le tableau du panier
    function updateCartTable() {
        const tbody = $('#cart-table tbody');
        tbody.empty();
        subtotal = 0;

        cart.forEach(item => {
            const row = `
                <tr>
                    <td>${item.name}</td>
                    <td><input type="number" class="form-control quantity" data-id="${item.id}" value="${item.quantity}" min="1"></td>
                    <td>${item.price.toFixed(2)} FCFA</td>
                    <td><input type="number" class="form-control discount" data-id="${item.id}" value="${item.discount}" min="0"></td>
                    <td>${item.total.toFixed(2)} FCFA</td>
                    <td><button class="btn btn-danger btn-sm remove-from-cart" data-id="${item.id}">Supprimer</button></td>
                </tr>
            `;

            tbody.append(row);
            subtotal += item.total;
        });

        $('#subtotal-price').text(subtotal.toFixed(2));
        $('#total-price').text((subtotal * (1 - discountPercentage / 100)).toFixed(2));
    }

    // Supprimer un produit du panier
    $(document).on('click', '.remove-from-cart', function () {
        const id = $(this).data('id');
        console.log(`Suppression du produit - ID: ${id}`);
        cart = cart.filter(item => item.id !== id);
        updateCartTable();
    });

    // Mise à jour des quantités et réductions
    $(document).on('input', '.quantity, .discount', function () {
        const id = $(this).data('id');
        const product = cart.find(item => item.id === id);

        if (product) {
            if ($(this).hasClass('quantity')) {
                product.quantity = parseInt($(this).val()) || 1;
            } else {
                product.discount = parseFloat($(this).val()) || 0;
            }
            product.total = (product.quantity * product.price) - product.discount;
            updateCartTable();
        }
    });

    // Ajouter une remise globale
    $('#discount').on('input', function () {
        discountPercentage = parseFloat($(this).val()) || 0;
        updateCartTable();
    });

    // Valider la vente
    $('#validate-sale').on('click', function () {
        if (cart.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Votre panier est vide !'
            });
            return;
        }

        console.log("Validation de la vente avec : ", cart);

        $.ajax({
            url: '{{ route('ventes.store') }}',
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            contentType: 'application/json',
            data: JSON.stringify({ cart: cart, total: parseFloat($('#total-price').text()) }),
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Succès!',
                    text: response.message,
                    confirmButtonColor: '#3085d6'
                });

                cart = [];
                updateCartTable();
            },
            error: function (xhr) {
                console.error(xhr);

                let errorMessage = 'Une erreur est survenue.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Erreur!',
                    text: errorMessage,
                    confirmButtonColor: '#d33'
                });
            }
        });
    });

});
</script>
@endpush
