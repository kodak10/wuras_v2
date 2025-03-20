@extends('front-end.layouts.master')

@push('styles')
<style>
    .select-box select, .select-menu select{
        max-width: 100% !important;
    }
</style>
@endpush

@section('content')
    
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content mt-5">
        <div class="container">
            <div class="row gutter-lg mb-10">
                <div class="col-lg-8 pr-lg-4 mb-6 mt-3">
                    <table class="shop-table cart-table">
                        <thead>
                            <tr>
                                <th class="product-name"><span>Produits</span></th>
                                <th></th>
                                <th class="product-price"><span>Prix</span></th>
                                <th class="product-quantity"><span>Quantité</span></th>
                                <th class="product-subtotal"><span>Sous-Total</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->details as $detail)
                                <tr>
                                    <td class="product-thumbnail">
                                        <div class="p-relative">
                                            <figure>
                                                @php
                                                    // Récupérer l'image principale (vignette) associée au produit
                                                    $thumbnail = $detail->product->images()->where('is_thumbnail', true)->first();
                                                @endphp

                                                @if($thumbnail)
                                                    <img src="{{ asset('storage/' . $thumbnail->path) }}" alt="" width="280" height="315">
                                                @else
                                                    <p>Pas d'image disponible</p>
                                                @endif

                                                {{-- <img src="{{ asset('storage/' . $detail->article->couverture) }}" alt="product" width="100" height="100"> --}}
                                            </figure>
                                            
                                        </div>
                                    </td>
                                    <td class="product-name">
                                        <span class="amount">{{ $detail->product->name }}</span>
                                    </td>
                                    
                                    <td class="product-price">
                                        <span class="amount">{{ $detail->product->price }}</span>
                                    </td>

                                    <td class="product-name">
                                        <span class="amount">{{ $detail->quantity }}</span>
                                    </td>
                                    
                                    <td class="product-subtotal">
                                        <span class="amount">{{ number_format($detail->product->price * $detail->quantity, 2) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                    
                </div>
    
                <div class="col-lg-4 sticky-sidebar-wrapper">
                    <div class="sticky-sidebar">
                        <div class="cart-summary mb-4">
                            <h3 class="cart-title text-uppercase">Details</h3>

                            <ul class="shipping-methods mb-3">
                                
                                <li>
                                    <label class="shipping-title text-dark font-weight-bold">Mode de réception :</label>
                                    <span>
                                        @if($order->shipping_method == 'flat_rate')
                                            A Retirer au magasin
                                        @elseif($order->shipping_method == 'free_shipping')
                                            Livraison / Expédition
                                        @else
                                            {{ ucfirst(str_replace('_', ' ', $order->shipping_method)) }}
                                        @endif
                                    </span>
                                </li>
                                
                                
                            </ul>

                            <hr class="divider">

                            <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                <label class="ls-25">Total</label>
                                <strong>{{ $order->total_price }} FCFA</strong>
                            </div>
    
    
                            
    
                            <div class="shipping-calculator">
                                {{-- <form class="shipping-calculator-form" action="" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <div class="select-box">
                                            <select name="country" class="form-control form-control-md">
                                                <option value="CI" selected="selected">Côte D'Ivoire</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="select-box">
                                            <select name="state" class="form-control form-control-md">
                                                <option value="default" selected="selected">Commune</option>
                                                <option value="Abobo">Abobo</option>
                                                <option value="Adjame">Adjamé</option>
                                                <option value="Attécoube">Attécoubé</option>
                                                <option value="Ayaman">Ayaman</option>
                                                <option value="Cocody">Cocody</option>
                                                <option value="Koumassi">Koumassi</option>
                                                <option value="Marcory">Marcory</option>
                                                <option value="Treichville">Treichville</option>
                                                <option value="Port-Bouet">Port-Bouet</option>
                                                <option value="interieur">Intérieur de Pays</option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <input class="form-control form-control-md" type="text" name="location_detail" placeholder="Précision du lieu">
                                    </div>
    
                                    <button type="submit" class="btn btn-dark btn-outline btn-rounded mt-5">Mettre à jour Totaux</button>
                                </form> --}}
                            </div>
    
                            <hr class="divider mb-6">
                            
                            <a href="{{ route('order.downloadReceipt', $order->id) }}" class="mb-3 btn btn-success w-100 btn-icon-right btn-rounded btn-checkout">
                                Imprimer le reçu <i class="w-icon-download fs-10"></i>
                            </a>

                            <a href="/home" class="btn btn-block btn-dark btn-icon-right btn-rounded btn-checkout">
                                Retour <i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- End of PageContent -->
@endsection

