<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
         <a href="/administration" class="logo-dark">
              <img src="{{ asset('front/logo.webp') }}" class="logo-sm" alt="logo sm" style="height: 80px">
              <img src="{{ asset('front/logo.webp') }}" class="logo-lg" alt="logo dark" style="height: 80px">
         </a>

         <a href="/administration" class="logo-light">
              <img src="{{ asset('front/logo.webp') }}" class="logo-sm" alt="logo sm" style="height: 80px">
              <img src="{{ asset('front/logo.webp') }}" class="logo-lg" alt="logo light" style="height: 80px">
         </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
         <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>
         <ul class="navbar-nav" id="navbar-nav">


              <li class="menu-title">General</li>

               <li class="nav-item {{ request()->is('administration') ? 'active' : '' }}">
               <a class="nav-link" href="{{ url('/administration') }}">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Menu Général </span>
               </a>
               </li>

               <li class="nav-item {{ request()->is('administration/products*') ? 'active' : '' }}">
               <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Produits </span>
               </a>
               <div class="collapse {{ request()->is('administration/products*') ? 'show' : '' }}" id="sidebarProducts">
                    <ul class="nav sub-navbar-nav">
                         <li class="sub-nav-item {{ request()->is('administration/products') ? 'active' : '' }}">
                              <a class="sub-nav-link" href="{{ url('/administration/products') }}">Liste</a>
                         </li>
                         
                         <li class="sub-nav-item {{ request()->is('administration/products/create') ? 'active' : '' }}">
                              <a class="sub-nav-link" href="{{ url('/administration/products/create') }}">Ajouter</a>
                         </li>
                    </ul>
               </div>
               </li>

               <li class="nav-item {{ request()->is('administration/stocks*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ url('/administration/stocks') }}">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Stock / Code Barres </span>
               </a>
               </li>

               <li class="nav-item {{ request()->is('administration/commandes*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/administration/stocks') }}">
                         <span class="nav-icon">
                              <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                         </span>
                         <span class="nav-text">Commandes </span>
                    </a>
                    </li>

               {{-- <li class="nav-item ">
               <a class="nav-link menu-arrow" href="#sidebarOrders" data-bs-toggle="collapse">
                    <span class="nav-icon">
                         
                    </span>
                    <span class="nav-text">  </span>
               </a>
               <div class="collapse {{ request()->is('administration/commandes*') ? 'show' : '' }}" id="sidebarOrders">
                    <ul class="nav sub-navbar-nav">
                         <li class="sub-nav-item {{ request()->is('administration/commandes') ? 'active' : '' }}">
                              <a class="sub-nav-link" href="{{ url('/administration/commandes') }}">Liste</a>
                         </li>
                         <li class="sub-nav-item {{ request()->is('administration/commandes/details') ? 'active' : '' }}">
                              <a class="sub-nav-link" href="{{ url('/administration/commandes/details') }}">Détails</a>
                         </li>
                         <li class="sub-nav-item {{ request()->is('administration/commandes/recu') ? 'active' : '' }}">
                              <a class="sub-nav-link" href="{{ url('/administration/commandes/recu') }}">Reçu de commande</a>
                         </li>
                    </ul>
               </div>
               </li> --}}

               <li class="nav-item {{ request()->is('administration/settings') ? 'active' : '' }}">
               <a class="nav-link" href="{{ url('/administration/settings') }}">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Paramétrage </span>
               </a>
               </li>

               {{-- <li class="menu-title mt-2">Users</li>

               <li class="nav-item {{ request()->is('administration/profile') ? 'active' : '' }}">
               <a class="nav-link" href="{{ url('/administration/profile') }}">
                    <span class="nav-icon">
                         <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Profile </span>
               </a>
               </li> --}}


{{-- 
              <li class="menu-title mt-2">Other</li>

              <li class="nav-item">
                   <a class="nav-link menu-arrow" href="#sidebarCoupons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCoupons">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:leaf-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Coupons </span>
                   </a>
                   <div class="collapse" id="sidebarCoupons">
                        <ul class="nav sub-navbar-nav">
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="coupons-list.html">List</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="coupons-add.html">Add</a>
                             </li>
                        </ul>
                   </div>
              </li>

              <li class="nav-item">
                   <a class="nav-link" href="pages-review.html">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Commentaire </span>
                   </a>
              </li>

              <li class="menu-title mt-2">Custom</li>

              <li class="nav-item">
                   <a class="nav-link menu-arrow" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:gift-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Pages </span>
                   </a>
                   <div class="collapse" id="sidebarPages">
                        <ul class="nav sub-navbar-nav">
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="pages-starter.html">Welcome</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="pages-comingsoon.html">Coming Soon</a>
                             </li>
                           
                            
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="pages-404.html">404 Error</a>
                             </li>
                            
                        </ul>
                   </div>
              </li>

             

              <li class="menu-title mt-2">Components</li>

              <li class="nav-item">
                   <a class="nav-link menu-arrow" href="#sidebarBaseUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBaseUI">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:bookmark-square-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Base UI </span>
                   </a>
                   <div class="collapse" id="sidebarBaseUI">
                        <ul class="nav sub-navbar-nav">
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-accordion.html">Accordion</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-alerts.html">Alerts</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-avatar.html">Avatar</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-badge.html">Badge</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-breadcrumb.html">Breadcrumb</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-buttons.html">Buttons</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-card.html">Card</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-carousel.html">Carousel</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-collapse.html">Collapse</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-dropdown.html">Dropdown</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-list-group.html">List Group</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-modal.html">Modal</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-tabs.html">Tabs</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-offcanvas.html">Offcanvas</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-pagination.html">Pagination</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-placeholders.html">Placeholders</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-popovers.html">Popovers</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-progress.html">Progress</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-scrollspy.html">Scrollspy</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-spinners.html">Spinners</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-toasts.html">Toasts</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="ui-tooltips.html">Tooltips</a>
                             </li>
                        </ul>
                   </div>
              </li>

              <li class="nav-item">
                   <a class="nav-link menu-arrow" href="#sidebarExtendedUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarExtendedUI">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:case-round-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Advanced UI </span>
                   </a>
                   <div class="collapse" id="sidebarExtendedUI">
                        <ul class="nav sub-navbar-nav">
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="extended-ratings.html">Ratings</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="extended-sweetalert.html">Sweet Alert</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="extended-swiper-silder.html">Swiper Slider</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="extended-scrollbar.html">Scrollbar</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="extended-toastify.html">Toastify</a>
                             </li>
                        </ul>
                   </div>
              </li>

              <li class="nav-item">
                   <a class="nav-link menu-arrow" href="#sidebarCharts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCharts">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:pie-chart-2-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Charts </span>
                   </a>
                   <div class="collapse" id="sidebarCharts">
                        <ul class="nav sub-navbar-nav">
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-area.html">Area</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-bar.html">Bar</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-bubble.html">Bubble</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-candlestick.html">Candlestick</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-column.html">Column</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-heatmap.html">Heatmap</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-line.html">Line</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-mixed.html">Mixed</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-timeline.html">Timeline</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-boxplot.html">Boxplot</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-treemap.html">Treemap</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-pie.html">Pie</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-radar.html">Radar</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-radialbar.html">RadialBar</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-scatter.html">Scatter</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="charts-apex-polar-area.html">Polar Area</a>
                             </li>
                        </ul>
                   </div>
              </li>

              <li class="nav-item">
                   <a class="nav-link menu-arrow" href="#sidebarForms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarForms">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:book-bookmark-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Forms </span>
                   </a>
                   <div class="collapse" id="sidebarForms">
                        <ul class="nav sub-navbar-nav">
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-basic.html">Basic Elements</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-checkbox-radio.html">Checkbox &amp; Radio</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-choices.html">Choice Select</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-clipboard.html">Clipboard</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-flatepicker.html">Flatepicker</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-validation.html">Validation</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-wizard.html">Wizard</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-fileuploads.html">File Upload</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-editors.html">Editors</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-input-mask.html">Input Mask</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="forms-range-slider.html">Slider</a>
                             </li>
                        </ul>
                   </div>
              </li>

              <li class="nav-item">
                   <a class="nav-link menu-arrow" href="#sidebarTables" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:tuning-2-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Tables </span>
                   </a>
                   <div class="collapse" id="sidebarTables">
                        <ul class="nav sub-navbar-nav">
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="tables-basic.html">Basic Tables</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="tables-gridjs.html">Grid Js</a>
                             </li>
                        </ul>
                   </div>
              </li>

              <li class="nav-item">
                   <a class="nav-link menu-arrow" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:ufo-2-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Icons </span>
                   </a>
                   <div class="collapse" id="sidebarIcons">
                        <ul class="nav sub-navbar-nav">
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="icons-boxicons.html">Boxicons</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="icons-solar.html">Solar Icons</a>
                             </li>
                        </ul>
                   </div>
              </li>

              <li class="nav-item">
                   <a class="nav-link menu-arrow" href="#sidebarMaps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMaps">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:streets-map-point-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Maps </span>
                   </a>
                   <div class="collapse" id="sidebarMaps">
                        <ul class="nav sub-navbar-nav">
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="maps-google.html">Google Maps</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="maps-vector.html">Vector Maps</a>
                             </li>
                        </ul>
                   </div>
              </li>

              <li class="nav-item">
                   <a class="nav-link" href="javascript:void(0);">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:volleyball-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text">Badge Menu</span>
                        <span class="badge bg-danger badge-pill text-end">1</span>
                   </a>
              </li>

              <li class="nav-item">
                   <a class="nav-link menu-arrow" href="#sidebarMultiLevelDemo" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMultiLevelDemo">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:share-circle-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Menu Item </span>
                   </a>
                   <div class="collapse" id="sidebarMultiLevelDemo">
                        <ul class="nav sub-navbar-nav">
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link" href="javascript:void(0);">Menu Item 1</a>
                             </li>
                             <li class="sub-nav-item">
                                  <a class="sub-nav-link  menu-arrow" href="#sidebarItemDemoSubItem" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarItemDemoSubItem">
                                       <span> Menu Item 2 </span>
                                  </a>
                                  <div class="collapse" id="sidebarItemDemoSubItem">
                                       <ul class="nav sub-navbar-nav">
                                            <li class="sub-nav-item">
                                                 <a class="sub-nav-link" href="javascript:void(0);">Menu Sub item</a>
                                            </li>
                                       </ul>
                                  </div>
                             </li>
                        </ul>
                   </div>
              </li>

              <li class="nav-item">
                   <a class="nav-link disabled" href="javascript:void(0);">
                        <span class="nav-icon">
                             <iconify-icon icon="solar:user-block-rounded-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Disable Item </span>
                   </a>
              </li> --}}
         </ul>
    </div>
</div>