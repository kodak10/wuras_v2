<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <a href="market1-1.html" class="logo-footer">
                        <img src="{{ asset('front/logo.webp') }}" alt="logo-footer" style="width:70% !important">
                    </a>
                    <!-- End FooterLogo -->
                </div>
                <div class="col-lg-4 widget-newsletter mb-4 mb-lg-0">
                    <h4 class="widget-title ls-m">Abonnez-vous à notre newsletter</h4>
                    <p>Obtenez toutes les dernières informations sur offres et ventes.</p>
                </div>
                <div class="col-lg-5 widget-newsletter">
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="input-wrapper-inline mx-auto mx-lg-0">
                        @csrf <!-- Protection CSRF -->
                        <input type="email" class="form-control" name="email" id="email" placeholder="Adresse e-mail ici..." required>
                        <button class="btn btn-primary btn-rounded ml-2" type="submit">S'abonner<i class="d-icon-arrow-right"></i></button>
                    </form>
                    @if(session('success'))
                        <div class="alert alert-success mt-3 text-white">{{ session('success') }}</div>
                    @endif
                </div>
                
            </div>
        </div>
        <!-- End FooterTop -->
        <div class="footer-middle">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget widget-info">
                        <h4 class="widget-title">Coordonnées</h4>
                        <ul class="widget-body">
                            <li>
                                <label>Téléphone:</label>
                                <a href="tel:0749667007">07 49 66 70 07</a>
                            </li>
                            <li>
                                <label>Email:</label>
                                <a href="">Contact@wuras.ci</a>
                            </li>
                            <li>
                                <label>Adresse:</label>
                                <a href="#">Abidjan, Adjamé Liberté Hassan 220 <br> logement non loin du rond point</a>
                            </li>
                            <li>
                                <label>JOURS / HEURES D'OUVERTURE :</label>
                            </li>
                            <li>
                                <a href="#">Lundi - Samedi / 8:00 - 18:00</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Widget -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="widget">
                        <h4 class="widget-title">Navigation</h4>
                        <ul class="widget-body">
                            <li>
                                <a href="{{ route('magasin') }}">Magasin</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('contact') }}">Contactez-Nous</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}">Connexion</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">Inscription</a>
                            </li>
                           
                        </ul>
                    </div>
                    <!-- End Widget -->
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="widget">
                        <h4 class="widget-title">Compte</h4>
                        <ul class="widget-body">
                            <li>
                                <a href="/home">Mon Compte</a>
                            </li>
                            <li>
                                <a href="{{ route('panier') }}">Panier</a>
                            </li>
                            <li>
                                <a href="{{ route('compare') }}">Comparaison</a>
                            </li>
                           
                           
                        </ul>
                    </div>
                    <!-- End Widget -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget">
                        <h4 class="widget-title">SERVICE CLIENT</h4>
                        <ul class="widget-body">
                            <li>
                                <a href="https://wa.me/2250749667007">Centre d'assistance</a>
                            </li>
                            <li>
                                <a href="{{ route('politique') }}">Politique de confidentialité</a>
                            </li>
                            <li>
                                <a href="#">FaQs</a>
                            </li>

                            
                        </ul>
                    </div>
                    <!-- End Widget -->
                </div>
               
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="footer-left">
                <p class="copyright">Wuras &copy; 2025. Tous droits réservés</p>
            </div>
            <div class="footer-center">
                
            </div>
            <div class="footer-right">
                <div class="social-links">
                    <a href="https://www.facebook.com/p/WURAS-Services-100091904923429/?locale=tl_PH" title="social-link" class="social-link social-facebook fab fa-facebook-f"></a>
                   
                </div>
            </div>
        </div>
        <!-- End FooterBottom -->
    </div>
</footer>