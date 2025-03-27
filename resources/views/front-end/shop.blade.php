@extends('front-end.layouts.master')

@section('content')
<div class="page-content mb-10 pb-3">
    <div class="container">
        <div class="row main-content-wrap gutter-lg">
            <aside class="col-lg-3 sidebar sidebar-fixed sidebar-toggle-remain shop-sidebar sticky-sidebar-wrapper">
                <div class="sidebar-overlay"></div>
                <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
                <div class="sidebar-content">
                    <div class="sticky-sidebar" data-sticky-options="{'top': 10}">
                        <div class="filter-actions mb-4">
                            <a href="#" class="sidebar-toggle-btn toggle-remain btn btn-outline btn-primary btn-icon-right btn-rounded">Filter<i class="d-icon-arrow-left"></i></a>
                            {{-- <a href="{{ route('magasin') }}" class="text-dark">Tout éffacer</a> --}}
                        </div>
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">Toutes les Catégories</h3>
                            <ul class="widget-body filter-items search-ul">
                                @foreach ($categories as $categorie)
                                    <li><a href="{{ route('magasin', ['category_name' => $categorie->name]) }}">{{ $categorie->name }}</a></li>

                                @endforeach
                                
                               
                            </ul>
                        </div>
                        {{-- <div class="widget widget-collapsible">
                            <h3 class="widget-title">Trirer Par Prix</h3>
                            <div class="widget-body mt-3">
                                <form action="#">
                                    <div class="filter-price-slider"></div>

                                    <div class="filter-actions">
                                        <div class="filter-price-text mb-4">Prix:
                                           
                                            <span class="filter-price-range"></span>
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-filter btn-rounded">Filtrer</button>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
                       
                       
                        
                    </div>
                </div>
            </aside>
            <div class="col-lg-9 main-content">
                <nav class="toolbox sticky-toolbox sticky-content fix-top">
                    <div class="toolbox-left">
                        <a href="#" class="toolbox-item left-sidebar-toggle btn btn-sm btn-outline btn-primary btn-rounded btn-icon-right d-lg-none">Filtrer<i class="d-icon-arrow-right"></i></a>
                        <div class="toolbox-item toolbox-sort select-box text-dark">
                            <label>Trier Par :</label>
                            
                            <select name="orderby" class="form-control filter-update">

                                <option value="">Defaut</option>
                                <option value="date" selected="selected">Récent</option>
                                <option value="price-low">Plus bas prix</option>
                                <option value="price-high">Plus haut prix</option>
                            </select>
                        </div>
                    </div>
                    <div class="toolbox-right">
                        <div class="toolbox-item toolbox-show select-box text-dark">
                            <label>Afficher :</label>
                            <select name="count" class="form-control">
                                <option value="8">8</option>
                                <option value="24">24</option>
                                <option value="36">36</option>
                            </select>
                        </div>
                       
                        <div class="toolbox-item toolbox-layout">
                            <a href="#" class="d-icon-mode-list btn-layout {{ $viewMode == 'list' ? 'active' : '' }}" data-view-mode="list"></a>
                            <a href="#" class="d-icon-mode-grid btn-layout {{ $viewMode == 'grid' ? 'active' : '' }}" data-view-mode="grid"></a>
                        </div>
                        
                        
                    </div>
                </nav>
               
               
                {{-- <div>
                    Mode actuel : {{ $viewMode }}
                </div> --}}
                
                
                    <!-- Dynamically change the classes based on viewMode -->
                    <div class="{{ $viewMode == 'grid' ? 'row cols-2 cols-sm-4' : 'product-lists' }} product-wrapper">
                        @include('front-end.partials.product-' . $viewMode, ['products' => $products])
                    </div>
                
                
                
                
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('pagination::bootstrap-4') }}  
                </div>
                
                
                
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
    <script>
        $(document).ready(function() { // ✅ S'assurer que le DOM est chargé
            console.log("Script shop chargé");

            function updateProducts() {
                var orderBy = $('select[name="orderby"]').val();
                var count = $('select[name="count"]').val();
                var viewMode = localStorage.getItem('view_mode') || 'grid';

                console.log('Mode:', viewMode);

                $.ajax({
                    url: $('#magasin-route').val(), // ✅ Vérifie que cet élément existe dans ton HTML
                    type: 'GET',
                    data: { orderby: orderBy, count: count, view_mode: viewMode },
                    success: function(response) {
                        $('.product-wrapper')
                            .removeClass('row cols-2 cols-sm-4 product-lists')
                            .addClass(viewMode === 'grid' ? 'row cols-2 cols-sm-4' : 'product-lists')
                            .html(response.products);

                        $('.pagination').html(response.pagination);

                        console.log("Produits mis à jour, réattachement des événements");
                    },
                    error: function() {
                        alert('Une erreur s\'est produite.');
                    }
                });
            }

            // ✅ Délégation des événements
            $(document).on('change', '.filter-update, select[name="count"]', updateProducts);
            $(document).on('click', '.toolbox-layout a', function(e) {
                e.preventDefault();
                localStorage.setItem('view_mode', $(this).data('view-mode'));
                updateProducts();
            });

            updateProducts(); // ✅ Charger les produits au démarrage
        });
    </script>
@endpush

