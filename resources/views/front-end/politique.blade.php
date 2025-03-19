@extends('front-end.layouts.master')

@section('content')

<div class="page-header" style="background-image: url({{ asset('front/bg_politique.avif') }})">
    <h1 class="page-title font-weight-bold text-capitalize ls-l text-dark">Politique de confidentialité
    </h1>
</div>
<div class="container">
    <div class="page-content mt-10 pt-7">
        <section class="contact-section">
            <div class="container mt-5">
            
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item">
                        <h4>Introduction</h4>
                        <p>Notre site e-commerce <strong>Wuras</strong> s’engage à respecter la vie privée de ses utilisateurs et à protéger leurs données personnelles conformément aux réglementations en vigueur en Côte d’Ivoire.</p>
                    </li>
            
                    <li class="list-group-item">
                        <h4>Collecte de données personnelles</h4>
                        <p>Nous collectons les données personnelles suivantes :</p>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item">Informations de contact (nom, e-mail, adresse, téléphone)</li>
                            <li class="list-group-item">Informations de paiement (numéros de carte, facturation)</li>
                            <li class="list-group-item">Informations de livraison (adresse, préférences de livraison)</li>
                            <li class="list-group-item">Historique des achats (produits achetés, montants dépensés)</li>
                        </ol>
                    </li>
            
                    <li class="list-group-item">
                        <h4>Utilisation des données personnelles</h4>
                        <p>Nous utilisons vos données personnelles pour :</p>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item">Fournir les services demandés (commandes, livraisons)</li>
                            <li class="list-group-item">Vous informer des promotions et événements</li>
                            <li class="list-group-item">Améliorer notre site et nos services</li>
                            <li class="list-group-item">Prévenir la fraude et assurer la sécurité</li>
                            <li class="list-group-item">Respecter les obligations légales</li>
                        </ol>
                    </li>
            
                    <li class="list-group-item">
                        <h4>Partage des données personnelles</h4>
                        <p>Nous ne partageons pas vos données personnelles sans votre consentement, sauf avec :</p>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item">Nos prestataires de services pour les commandes et livraisons</li>
                            <li class="list-group-item">Les autorités compétentes en cas d’enquête légale</li>
                        </ol>
                    </li>
            
                    <li class="list-group-item">
                        <h4>Sécurité des données personnelles</h4>
                        <p>Nous utilisons des mesures de protection avancées, y compris le chiffrement des données de paiement.</p>
                    </li>
            
                    <li class="list-group-item">
                        <h4>Conservation des données personnelles</h4>
                        <p>Vos données sont conservées uniquement le temps nécessaire pour fournir nos services et respecter la loi.</p>
                    </li>
            
                    <li class="list-group-item">
                        <h4>Droits des utilisateurs</h4>
                        <p>Vous avez le droit de :</p>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item">Accéder et obtenir une copie de vos données</li>
                            <li class="list-group-item">Demander leur rectification si elles sont inexactes</li>
                            <li class="list-group-item">Demander leur suppression</li>
                            <li class="list-group-item">Vous opposer au traitement à des fins marketing</li>
                            <li class="list-group-item">Limiter le traitement sous certaines conditions</li>
                        </ol>
                    </li>
            
                    <li class="list-group-item">
                        <h4>Contact</h4>
                        <p>Pour toute question, contactez-nous à <strong>contact@wuras.ci</strong>.</p>
                    </li>
            
                    <li class="list-group-item">
                        <h4>Modification de la politique</h4>
                        <p>Nous nous réservons le droit de modifier cette politique à tout moment. Les modifications seront effectives dès leur publication.</p>
                    </li>
                </ol>
            </div>
        </section>
        <!-- End About Section-->
    
        
    
       
    </div>
</div>
@endsection