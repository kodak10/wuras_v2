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

            <!-- Ligne pour les category -->
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
                <div class="compare-col compare-field">Marque: </div>
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
            category: document.querySelectorAll(".compare-row")[3],
            stock: document.querySelectorAll(".compare-row")[4],
            description: document.querySelectorAll(".compare-row")[5],
            colors: document.querySelectorAll(".compare-row")[6],
            marque: document.querySelectorAll(".compare-row")[7]
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
                        <div class="product product-classic text-center"
                        data-id="${item.id}"
                        data-category="${item.category}" 
                        data-name="${item.name}"
                        data-price="${item.price}" 
                        data-marque="${item.marque}" 
                        data-stock="${item.stock}"
                        data-description="${item.description}"
                        data-slug="${item.slug}"
                        >
                            <figure class="product-media ">
                                <a href="/magasin/${item.slug}">
                                    <img src="${item.image}" alt="${item.name}" width="100">
                                </a>
                            </figure>

                            <div class="product-details">
                                <div class="product-action">
                                     <a href="#" class="btn-product-icon btn-cart" title="Ajouter au panier">
                                         <i class="d-icon-bag"></i>
                                     </a>

                                    <a href="#" class="btn-product-icon btn-default btn-remove remove-from-compare" title="Supprimer de la comparaison" data-id="${item.id}">
                                        <i class="d-icon-close"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                rows.titles.innerHTML += `<div class="compare-col product-name"><a href="wuras.ci/magasin/${item.slug}">${item.name}</a> </div>`;
                rows.prices.innerHTML += `<div class="compare-col product-price">${item.price}</div>`;
                rows.category.innerHTML += `<div class="compare-col">${item.category}</div>`;
                rows.stock.innerHTML += `<div class="compare-col">${item.stock}</div>`;
                rows.description.innerHTML += `<div class="compare-col">${item.description ?? 'Aucune description'}</div>`;
                rows.colors.innerHTML += `<div class="compare-col">${item.color ?? 'N/A'}</div>`;
                rows.marque.innerHTML += `<div class="compare-col">${item.marque}</div>`;
            });
        }

        updateCompareDisplay();

        // Suppression de la comparaison
        $(document).on("click", ".remove-from-compare", function (e) {
            let productId = $(this).data("id"); // On récupère l'ID depuis l'attribut data-id
            console.log("🔴 Suppression du produit de la comparaison:", productId);

            compareList = compareList.filter(item => item.id !== productId);
            localStorage.setItem("compareList", JSON.stringify(compareList));
            updateCompareDisplay();
        });

        // Ajout au panier
        $(document).on("click", ".btn-cart", function (e) {
            let productElement = $(this).closest(".product");
            let productId = productElement.data("id");
            let productName = productElement.find(".product-name a").text();
            let productPrice = parseFloat(productElement.find(".new-price").text().replace(/\D/g, ''));
            let productImage = productElement.find("img").attr("src");
            let productSlug = productElement.data("slug");

            console.log("Produit ajouté au panier:", { productId, productName, productPrice, productImage, productSlug });

            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            let existingProduct = cart.find(item => item.id === productId);

            if (existingProduct) {
                existingProduct.quantity++;
            } else {
                cart.push({ id: productId, name: productName, price: productPrice, image: productImage, slug: productSlug, quantity: 1 });
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            alert("Produit ajouté au panier");
        });
    });
</script>
@endpush
