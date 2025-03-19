@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <!-- Logo & title -->
                    <div class="clearfix pb-3 bg-info-subtle p-lg-3 p-2 m-n2 rounded position-relative">
                        <div class="float-sm-start">
                            <div class="auth-logo">
                                <img class="logo-dark me-1" src="{{ asset('front/logo.webp') }}" alt="logo-dark" height="64" />
                            </div>
                        </div>
                        
                        <div class="float-sm-end">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="p-0 pe-5 py-1">
                                                <p class="mb-0 text-dark fw-semibold"> Facture : </p>
                                            </td>
                                            <td class="text-end text-dark fw-semibold px-0 py-1">{{ $order->order_number }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-0 pe-5 py-1">
                                                <p class="mb-0">Date d'émission: </p>
                                            </td>
                                            <td class="text-end text-dark fw-medium px-0 py-1">{{ $order->created_at->format('d F Y') }}</td>
                                        </tr>
                                        
                                        
                                        
                                        <tr>
                                            <td class="p-0 pe-5 py-1">
                                                <p class="mb-0">Status de Commande : </p>
                                            </td>
                                            <td class="text-end px-0 py-1">
                                                <span class="badge 
                                                    @if($order->status == 'en attente') bg-secondary
                                                    @elseif($order->status == 'confirmée') bg-info
                                                    @elseif($order->status == 'expédiée') bg-primary
                                                    @elseif($order->status == 'livrée') bg-success
                                                    @else bg-danger 
                                                    @endif text-white px-2 py-1 fs-13">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-0 pe-5 py-1">
                                                <p class="mb-0">Status de Payement : </p>
                                            </td>
                                            <td class="text-end px-0 py-1">
                                                <span class="badge 
                                                    @if($order->payment_status == 'payé') bg-success 
                                                    @elseif($order->payment_status == 'remboursé') bg-warning
                                                    @else bg-danger 
                                                    @endif text-white px-2 py-1 fs-13">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="position-absolute top-100 start-50 translate-middle">
                            <img src="assets/images/check-2.png" alt="" class="img-fluid">
                        </div>
                    </div>

                    <div class="clearfix pb-3 mt-4">
                        <div class="float-sm-start">
                            <div class="">
                                <h4 class="card-title">Magasin</h4>
                                <div class="mt-3">
                                    <h4>{{ $parametre->name ?? 'Nom non défini' }}</h4>
                                    <p class="mb-2">{{ $parametre->adresse ?? 'Adresse non renseignée' }}</p>
                                    <p class="mb-2"><span class="text-decoration-underline">Numéro de téléphone :</span> {{ $parametre->number_magasin ?? 'Non renseigné' }}</p>
                                    <p class="mb-2"><span class="text-decoration-underline">Email :</span> {{ $parametre->email ?? 'Non renseigné' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="float-sm-end">
                            <div class="">
                                <h4 class="card-title">Client</h4>
                                <div class="mt-3">
                                    <h4>{{ $order->user->name }}</h4>
                                    <p class="mb-2"><span class="text-decoration-underline">Numéro de téléphone :</span> {{ $order->user->phone ?? 'Non renseigné' }}</p>
                                    <p class="mb-2"><span class="text-decoration-underline">Email :</span> {{ $order->user->email }}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive table-borderless text-nowrap table-centered">
                                <table class="table mb-0"> 
                                    <thead class="bg-light bg-opacity-50">
                                        <tr>
                                            <th class="border-0 py-2">Produit</th>
                                            <th class="border-0 py-2">Quantité</th>
                                            <th class="border-0 py-2">Prix</th>
                                            <th class="text-end border-0 py-2">Total</th>
                                        </tr>
                                    </thead> <!-- end thead -->
                                    <tbody>
                                        @foreach ($order->details as $detail)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <!-- Affichage de l'image du produit -->
                                                    <div class="rounded bg-light avatar d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('storage/products/' . $detail->product->image) }}" alt="" class="avatar">
                                                    </div>
                                                    <div>
                                                        <!-- Affichage du nom du produit -->
                                                        <a href="#!" class="text-dark fw-medium fs-15">{{ $detail->product->name }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>{{ number_format($detail->price, 2) }} CFA</td>
                                            <td class="text-end">{{ number_format($detail->quantity * $detail->price, 2) }} CFA</td>
                                        </tr>
                                        @endforeach
                                    </tbody> <!-- end tbody -->
                                </table> <!-- end table -->
                                
                            </div> <!-- end table responsive -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <div class="row justify-content-end">
                        <div class="col-lg-5 col-6">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr class="">
                                            <td class="text-end p-0 pe-5 py-2">
                                                <p class="mb-0"> Sous Total : </p>
                                            </td>
                                            <td class="text-end text-dark fw-medium  py-2">$777.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-end p-0 pe-5 py-2">
                                                <p class="mb-0">Livraison / Expédition : </p>
                                            </td>
                                            <td class="text-end text-dark fw-medium  py-2">$60.00</td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="text-end p-0 pe-5 py-2">
                                                <p class="mb-0">Réduction : </p>
                                            </td>
                                            <td class="text-end text-dark fw-medium  py-2">-$60.00</td>
                                        </tr>

                                        
                                        <tr class="border-top">
                                            <td class="text-end p-0 pe-5 py-2">
                                                <p class="mb-0 text-dark fw-semibold">Montant Total : </p>
                                            </td>
                                            <td class="text-end text-dark fw-semibold  py-2">$737.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                   

                    <div class="mt-3 mb-1">
                        <div class="text-end d-print-none">
                            <a href="javascript:window.print()" class="btn btn-info width-xl">Télécharger</a>
                            <a href="javascript:void(0);" class="btn btn-outline-primary width-xl">Annuler la commande</a>
                        </div>
                    </div>

                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->

</div>
@endsection