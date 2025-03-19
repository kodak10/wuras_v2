@extends('Administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
         <div class="col-xl-12">
              <div class="card">
                   <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">Liste de tous les produits</h4>
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">
                            Ajouter un produit
                        </a>
                   </div>
                   <div class="row">
                    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
                   </div>

                   <div>
                        <div class="table-responsive">
                             <table class="table align-middle mb-0 table-hover table-centered">
                                  <thead class="bg-light-subtle">
                                       <tr>
                                            <th style="width: 20px;">
                                                 <div class="form-check ms-1">
                                                      <input type="checkbox" class="form-check-input" id="checkAll">
                                                      <label class="form-check-label" for="checkAll"></label>
                                                 </div>
                                            </th>
                                            <th>Nom</th>
                                            <th>Prix</th>
                                            <th>Stock</th>
                                            <th>Catégorie</th>
                                            <th>Action</th>
                                       </tr>
                                  </thead>
                                  <tbody>
                                       @foreach($products as $product)
                                       <tr>
                                            <td>
                                                 <div class="form-check ms-1">
                                                      <input type="checkbox" class="form-check-input" id="check{{ $product->id }}">
                                                      <label class="form-check-label" for="check{{ $product->id }}"></label>
                                                 </div>
                                            </td>
                                            <td>
                                                 <div class="d-flex align-items-center gap-2">
                                                       @php
                                                            // Récupérer l'image principale (vignette) associée au produit
                                                            $thumbnail = $product->images()->where('is_thumbnail', true)->first();
                                                            $imageUrl = $thumbnail ? asset('storage/' . $thumbnail->path) : asset('images/default.png'); // Image par défaut si pas d'image
                                                       @endphp
                                                       
                                                       <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="avatar-md">
                                                       </div>
                                              
                                                      <div>
                                                           <a href="{{ route('products.show', $product->id) }}" class="text-dark fw-medium fs-15">{{ $product->name }}</a>
                                                      </div>
                                                 </div>
                                            </td>
                                            <td>{{ number_format($product->price, 2) }} CFA</td>
                                            <td>
                                                  <p class="mb-1 text-muted">
                                                  <span class="text-white fw-medium {{ $product->stock <= 5 ? 'bg-danger' : ($product->stock <= 20 ? 'bg-warning' : 'bg-success') }} p-2 rounded">
                                                       {{ $product->stock }} en stock
                                                  </span>
                                                  </p>
                                             </td>
                                         
                                            <td>{{ $product->category->name ?? 'Non catégorisé' }}</td>
                                            <td>
                                                 <div class="d-flex gap-2">
                                                     
                                                      
                                                      <a href="{{ route('products.edit', $product->id) }}" class="btn btn-soft-primary btn-sm">
                                                           <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                                      </a>
                                                      <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                                           @csrf
                                                           @method('DELETE')
                                                           <button type="submit" class="btn btn-soft-danger btn-sm">
                                                                <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                                           </button>
                                                      </form>
                                                 </div>
                                            </td>
                                       </tr>
                                       @endforeach
                                  </tbody>
                             </table>
                        </div>
                   </div>

                   <div class="card-footer border-top">
                    <nav aria-label="Pagination">
                        <ul class="pagination justify-content-center">
                            {{-- Vérifie si la pagination existe et personnalise les liens --}}
                            {{ $products->links('pagination::bootstrap-5') }}
                        </ul>
                    </nav>
                </div>
                
              </div>
         </div>
    </div>
</div>
@endsection
