@extends('front-end.layouts.master')

@section('content')
<div class="page-content compare-default">
    <div class="container riode-compare-table">
        <div class="compare-row compare-basic">
            <div class="compare-col compare-field">
                Produits
            </div>

            <div id="compare-products" class="d-flex">
                <!-- Les produits seront affichés ici dynamiquement -->
            </div>
        </div>

        <div class="compare-row compare-attributes">
            <div class="compare-col compare-field">
                Caractéristiques
            </div>
            <div id="compare-attributes">
                <!-- Les caractéristiques des produits seront affichées ici -->
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ url()->previous() }}" class="btn btn-dark"><span>Retour</span></a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let compareList = JSON.parse(localStorage.getItem("compareList")) || [];
        const compareProductsContainer = document.getElementById("compare-products");
        const compareAttributesContainer = document.getElementById("compare-attributes");

        updateCompareDisplay();

        function updateCompareDisplay() {
            compareProductsContainer.innerHTML = "";
            compareAttributesContainer.innerHTML = "";

            if (compareList.length === 0) {
                compareProductsContainer.innerHTML = `<p class="text-center w-100">Aucun produit à comparer.</p>`;
                compareAttributesContainer.innerHTML = `<p class="text-center w-100">Aucune caractéristique disponible.</p>`;
                return;
            }

            compareList.forEach(item => {
                let productHtml = `
                    <div class="compare-col compare-value" data-title="${item.name}">
                        <div class="product product-compare">
                            <figure class="product-media">
                                <a href="${item.url}">
                                    <img src="${item.image}" alt="${item.name}" width="80" height="88">
                                </a>
                                <button class="btn btn-link btn-close" onclick="removeFromCompare('${item.id}')">
                                    <i class="fas fa-times"></i><span class="sr-only">Fermer</span>
                                </button>
                            </figure>
                            <div class="product-detail">
                                <a href="${item.url}" class="product-name">${item.name}</a>
                                <div class="price-box">
                                    <span class="product-price">${item.price} CFA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                compareProductsContainer.innerHTML += productHtml;

                let attributeHtml = `
                    <div class="compare-col compare-value" data-title="${item.name}">
                        <ul>
                            <li><strong>Marque :</strong> ${item.brand ?? 'N/A'}</li>
                            <li><strong>Catégorie :</strong> ${item.category ?? 'N/A'}</li>
                            <li><strong>Disponibilité :</strong> ${item.stock > 0 ? 'En stock' : 'Rupture de stock'}</li>
                        </ul>
                    </div>
                `;
                compareAttributesContainer.innerHTML += attributeHtml;
            });
        }

        window.removeFromCompare = function(productId) {
            compareList = compareList.filter(item => item.id !== productId);
            localStorage.setItem("compareList", JSON.stringify(compareList));
            updateCompareDisplay();
        };
    });
</script>
@endsection
