@extends('front-end.layouts.master')

@section('content')

<div class="page-header" style="background-image: url({{ asset('front/bg_contact.jpg') }})">
    <h1 class="page-title font-weight-bold text-capitalize ls-l text-dark">Contact
    </h1>
</div>
<div class="container">
    <div class="page-content mt-10 pt-7">
        <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 ls-m mb-4">
                        <div class="grey-section d-flex align-items-center h-100">
                            <div>
                                <h4 class="mb-2 text-capitalize">Adresse</h4>
                                <p>Abidjan, Adjamé Liberté Hassan 220 logement non loin du rond point</p>
    
                                <h4 class="mb-2 text-capitalize">Numéro de téléphone</h4>
                                <p>
                                    <a href="tel:0749667007">07 49 66 70 07</a><br>
                                    <a href="tel:0749667007">07 49 66 70 07</a>
                                </p>
    
                                <p class="mb-4">
                                    <a href="#">Contact@wuras.ci</a><br>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-6 d-flex align-items-center mb-4">
                        <div class="w-100">
                            <form class="pl-lg-2" action="#">
                                <h4 class="ls-m font-weight-bold">Connectons-nous</h4>
                                <p>Votre adresse e-mail ne sera pas publiée. Les champs obligatoires sont marqués d'un astérisque (*).</p>
                                <div class="row mb-2">
                                    <div class="col-12 mb-4">
                                        <textarea class="form-control" required
                                            placeholder="Message*"></textarea>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <input class="form-control" type="text" placeholder="Nom *" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <input class="form-control" type="email" placeholder="Email *" required>
                                    </div>
                                </div>
                                <button class="btn btn-dark btn-rounded">Envoyer<i
                                        class="d-icon-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section-->
    
        
    
        <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
        <div class="grey-section google-map" id="googlemaps" style="height: 386px"></div>
        <!-- End Map Section -->
    </div>
</div>
@endsection