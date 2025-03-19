@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">

    <div class="row">
         <div class="col-lg-12">
              <div class="card">
                   <div class="card-body">
                    <div class="row">
                         <div class="col-lg-5">
                             @php
                                 // Récupérer l'image principale (vignette) associée au produit
                                 $thumbnail = $product->images()->where('is_thumbnail', true)->first();
                                 $imageUrl = $thumbnail ? asset('storage/' . $thumbnail->path) : asset('images/default.png'); // Image par défaut si pas d'image
                             @endphp
                             <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                 <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="img-fluid rounded">
                             </div>
                         </div>
                         <div class="col-lg-7">
                             <!-- Crossfade -->
                             <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                 <div class="carousel-inner" role="listbox">
                                     @foreach ($product->images as $index => $image)
                                         @if (!$image->is_thumbnail)  <!-- Ignorer l'image thumbnail -->
                                             <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                 <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}" class="img-fluid bg-light rounded">
                                             </div>
                                         @endif
                                     @endforeach
                                 </div>
                                 <div class="carousel-indicators m-0 mt-2 d-lg-flex d-none position-static h-100">
                                     @foreach ($product->images as $index => $image)
                                         @if (!$image->is_thumbnail) <!-- Ignorer l'image thumbnail -->
                                             <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="{{ $index }}" aria-label="Slide {{ $index + 1 }}" class="w-auto h-auto rounded bg-light {{ $index === 0 ? 'active' : '' }}">
                                                 <img src="{{ asset('storage/' . $image->path) }}" class="d-block avatar-xl" alt="swiper-indicator-img">
                                             </button>
                                         @endif
                                     @endforeach
                                 </div>
                             </div>
                         </div>
                     </div>
                     
                       
                   </div>
                 
              </div>
         </div>
         
    </div>
    
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                 <div class="card-body">
                      <h4 class="badge bg-success text-light fs-14 py-1 px-2"></h4>
                      <p class="mb-1">
                           <a href="#!" class="fs-24 text-dark fw-medium">{{ $product->name }}</a>
                      </p>
                      
                      <h2 class="fw-medium my-3">{{ $product->price }} <span class="fs-16 text-decoration-line-through">$100.00</span><small class="text-danger ms-2">(30%Off)</small></h2>

                      <div class="row align-items-center g-2 mt-3">
                           <div class="col-lg-3">
                                <div class="">
                                     <h5 class="text-dark fw-medium">Colors > <span class="text-muted">Dark</span></h5>
                                     <div class="d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                                          <input type="checkbox" class="btn-check" id="color-dark2" checked>
                                          <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="color-dark2"> <i class="bx bxs-circle fs-18 text-dark"></i></label>

                                          <input type="checkbox" class="btn-check" id="color-yellow2">
                                          <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="color-yellow2"> <i class="bx bxs-circle fs-18 text-warning"></i></label>

                                          <input type="checkbox" class="btn-check" id="color-white2">
                                          <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="color-white2"> <i class="bx bxs-circle fs-18 text-white"></i></label>

                                          <input type="checkbox" class="btn-check" id="color-green2">
                                          <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" for="color-green2"> <i class="bx bxs-circle fs-18 text-success"></i></label>

                                     </div>
                                </div>
                           </div>
                           
                      </div>
                      <div class="quantity mt-4">
                           <h4 class="text-dark fw-medium mt-3">Quantité : {{ $product->stock }}</h4>
                           
                      </div>
                     
                      <h4 class="text-dark fw-medium">Description :</h4>
                      <p class="text-muted">{{ $product->description }}</p>
                      
                 </div>
            </div>
       </div>
         <div class="col-lg-5">
              <div class="card">
                   <div class="card-header">
                        <h4 class="card-title">Commentaire et notation</h4>
                   </div>
                   <div class="card-body">
                        {{-- <div class="d-flex align-items-center gap-2">
                             <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-md rounded-circle">
                             <div>
                                  <h5 class="mb-0">Henny K. Mark</h5>
                             </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 mt-3 mb-1">
                             <ul class="d-flex text-warning m-0 fs-20 list-unstyled">
                                  <li>
                                       <i class="bx bxs-star"></i>
                                  </li>
                                  <li>
                                       <i class="bx bxs-star"></i>
                                  </li>
                                  <li>
                                       <i class="bx bxs-star"></i>
                                  </li>
                                  <li>
                                       <i class="bx bxs-star"></i>
                                  </li>
                                  <li>
                                       <i class="bx bxs-star-half"></i>
                                  </li>
                             </ul>
                             <p class="fw-medium mb-0 text-dark fs-15">Excellent Quality</p>
                        </div>

                        <p class="mb-0 text-dark fw-medium fs-15">Reviewed in Canada on 16 November 2023</p>
                        <p class="text-muted">Medium thickness. Did not shrink after wash. Good elasticity . XL size Perfectly fit for 5.10 height and heavy body. Did not fade after wash. Only for maroon colour t-shirt colour lightly gone in first wash but not faded. I bought 5 tshirt of different colours. Highly recommended in so low price.</p>
                        <div class="mt-2">
                             <a href="#!" class="fs-14 me-3 text-muted"><i class='bx bx-like'></i> Helpful</a>
                             <a href="#!" class="fs-14 text-muted">Report</a>
                        </div>

                        <hr class="my-3"> --}}

                       
                   </div>
              </div>
         </div>
    </div>

</div>
@endsection