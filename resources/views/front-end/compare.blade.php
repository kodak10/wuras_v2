@extends('front-end.layouts.master')

@section('content')
<div class="page-content compare-default">
    <div class="container riode-compare-table">
        <div class="compare-table">
            <!-- En-tête des produits -->
            <div class="compare-row compare-header">
                <div class="compare-col compare-field"></div>
            </div>

            <!-- Ligne pour les titres -->
            <div class="compare-row">
                <div class="compare-col compare-field">Nom du produit</div>
            </div>

            <!-- Ligne pour les prix -->
            <div class="compare-row">
                <div class="compare-col compare-field">Prix</div>
            </div>

            <!-- Ligne pour les types -->
            <div class="compare-row">
                <div class="compare-col compare-field">Catégorie</div>
            </div>

            <!-- Ligne pour la disponibilité -->
            <div class="compare-row">
                <div class="compare-col compare-field">Disponibilité</div>
            </div>

            <!-- Ligne pour les descriptions -->
            <div class="compare-row">
                <div class="compare-col compare-field">Description</div>
            </div>

            <!-- Ligne pour les couleurs -->
            <div class="compare-row">
                <div class="compare-col compare-field">Color</div>
            </div>

            <!-- Ligne pour les tailles -->
            <div class="compare-row">
                <div class="compare-col compare-field">Poid</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let compareList = JSON.parse(localStorage.getItem("compareList")) || [];

        // Sélection des lignes où les produits doivent être affichés
        const rows = {
            products: document.querySelector(".compare-header"),
            titles: document.querySelectorAll(".compare-row")[1],
            prices: document.querySelectorAll(".compare-row")[2],
            types: document.querySelectorAll(".compare-row")[3],
            availability: document.querySelectorAll(".compare-row")[4],
            descriptions: document.querySelectorAll(".compare-row")[5],
           
            colors: document.querySelectorAll(".compare-row")[6],
            sizes: document.querySelectorAll(".compare-row")[7]
        };

        function updateCompareDisplay() {
            // Réinitialiser les colonnes de chaque ligne
            Object.values(rows).forEach(row => {
                row.querySelectorAll(".compare-col:not(.compare-field)").forEach(col => col.remove());
            });

            if (compareList.length === 0) {
                rows.products.innerHTML += `<p class="text-center w-100">Aucun produit à comparer.</p>`;
                return;
            }

            compareList.forEach(item => {
                // Ajouter une colonne pour chaque produit dans chaque ligne correspondante
                rows.products.innerHTML += `
                    <div class="compare-col">
                        <div class="product product-classic text-center">
                            <figure class="product-media">
                                <a href="${item.url}">
                                    <img src="${item.image}" alt="${item.name}" width="100">
                                </a>
                            </figure>

                            <div class="product-details">
                                    <div class="product-action">
                                        <a href="#" class="btn-product-icon btn-left btn-moving to-left" title="Exchange left"><i class="d-icon-angle-left"></i></a>
                                        <a href="#" class="btn-product-icon btn-default btn-cart " title="Add to cart" data-toggle="modal" data-target="#addCartModal"><i class="d-icon-bag"></i></a>
                                        <a href="#" class="btn-product-icon btn-default btn-wishlist" title="Add to wishlist"><i class="d-icon-heart"></i></a>
                                        <a href="#" class="btn-product-icon btn-default" title="Add to close"><i class="d-icon-close"></i></a>
                                        <a href="#" class="btn-product-icon btn-right btn-moving to-right" title="Exchange right"><i class="d-icon-angle-right"></i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                `;

                rows.titles.innerHTML += `<div class="compare-col">${item.name}</div>`;
                rows.prices.innerHTML += `<div class="compare-col">${item.price}</div>`;
                rows.types.innerHTML += `<div class="compare-col">${item.type}</div>`;
                rows.availability.innerHTML += `<div class="compare-col">${item.stock > 0 ? 'En stock' : 'Rupture de stock'}</div>`;
                rows.descriptions.innerHTML += `<div class="compare-col">${item.description ?? 'Aucune description'}</div>`;
                
                rows.colors.innerHTML += `<div class="compare-col">${item.color ?? 'N/A'}</div>`;
                rows.sizes.innerHTML += `<div class="compare-col">${item.size ?? 'N/A'}</div>`;
            });
        }

        updateCompareDisplay();

        window.removeFromCompare = function (productId) {
            compareList = compareList.filter(item => item.id !== productId);
            localStorage.setItem("compareList", JSON.stringify(compareList));
            updateCompareDisplay();
        };
    });
</script>
@endpush
