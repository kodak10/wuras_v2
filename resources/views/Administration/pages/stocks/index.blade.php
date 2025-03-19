@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">

     <div class="row">
          <div class="col-md-6 col-xl-4">
              <div class="card">
                  <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                          <div>
                              <h4 class="card-title mb-2">Total des Produits</h4>
                              <p class="text-muted fw-medium fs-22 mb-0">{{ $totalProducts }}</p> <!-- Afficher le nombre total de produits -->
                          </div>
                          <div>
                              <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                  <iconify-icon icon="solar:clipboard-remove-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      
          <div class="col-md-6 col-xl-4">
              <div class="card">
                  <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                          <div>
                              <h4 class="card-title mb-2">Bientôt épuisé</h4>
                              <p class="text-muted fw-medium fs-22 mb-0">{{ $lowStockProducts }}</p> <!-- Afficher le nombre de produits bientôt épuisés -->
                          </div>
                          <div>
                              <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                  <iconify-icon icon="solar:clock-circle-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      
          <div class="col-md-6 col-xl-4">
              <div class="card">
                  <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                          <div>
                              <h4 class="card-title mb-2">Epuisé</h4>
                              <p class="text-muted fw-medium fs-22 mb-0">{{ $outOfStockProducts }}</p> <!-- Afficher le nombre de produits épuisés -->
                          </div>
                          <div>
                              <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                  <iconify-icon icon="solar:clipboard-check-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      

    <div class="row">
         <div class="col-xl-12">
              <div class="card">
                   <div class="d-flex card-header justify-content-between align-items-center">
                        <div>
                             <h4 class="card-title">Tous les produits</h4>
                        </div>
                        
                   </div>

                   <div>
                        <div class="table-responsive">
                             <table class="table align-middle mb-0 table-hover table-centered">
                                  <thead class="bg-light-subtle">
                                       <tr>
                                            <th>Nom avec image</th>
                                            <th>Quantité Disponible</th>
                                            <th>Alerte</th>
                                            <th>Action</th>
                                       </tr>
                                  </thead>
                                  <tbody>
                                   @foreach($products as $product)
                                   <tr>
                                       <td>
                                           @php
                                               // Récupérer l'image principale (vignette) associée au produit
                                               $thumbnail = $product->images()->where('is_thumbnail', true)->first();
                                               $imageUrl = $thumbnail ? asset('storage/' . $thumbnail->path) : asset('images/default.png'); // Image par défaut si pas d'image
                                           @endphp
                               
                                           <img src="{{ $imageUrl }}" alt="{{ $product->name }}" width="40" class="rounded-circle me-2">
                                           {{ $product->name }}
                                       </td>
                                       <td>{{ $product->stock }}</td>
                                       <td>
                                           @if ($product->stock == 0)
                                               <span class="badge bg-danger text-white py-1 px-2">Épuisé</span>
                                           @elseif ($product->stock < 3)
                                               <span class="badge bg-warning text-dark py-1 px-2">Bientôt épuisé</span>
                                           @elseif ($product->stock < 5)
                                               <span class="badge bg-secondary text-white py-1 px-2">En stock</span>
                                           @else
                                               <span class="badge bg-success text-white py-1 px-2">En stock</span>
                                           @endif
                                       </td>
                                       <td>
                                           <div class="d-flex gap-2">
                                               
                                               <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#codeBarreModal_{{ $product->id }}">
                                                  <iconify-icon icon="mdi:barcode-scan" class="align-middle fs-18"></iconify-icon>
                                              </button>

                                               <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editStockModal_{{ $product->id }}">
                                                   <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                               </button>
                                           </div>
                                       </td>
                                   </tr>
                               
                                   <!-- Modal pour modifier le stock -->
                                   <div class="modal fade" id="editStockModal_{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editStockModalLabel_{{ $product->id }}" aria-hidden="true">
                                       <div class="modal-dialog">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <h5 class="modal-title" id="editStockModalLabel_{{ $product->id }}">Modifier le stock de {{ $product->name }}</h5>
                                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                               </div>
                                               <div class="modal-body">
                                                   <form action="{{ route('products.updateStock') }}" method="POST">
                                                       @csrf
                                                       @method('PUT')
                                                       <input type="hidden" name="product_id" value="{{ $product->id }}">
                               
                                                       <div class="mb-3">
                                                           <label for="stock_{{ $product->id }}" class="form-label">Stock</label>
                                                           <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock_{{ $product->id }}" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required>
                                                           @error('stock')
                                                               <div class="invalid-feedback">
                                                                   {{ $message }}
                                                               </div>
                                                           @enderror
                                                       </div>
                               
                                                       <div class="mb-3">
                                                           <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                       </div>
                                                   </form>
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <!-- Modal pour code barre -->
                                   <div class="modal fade" id="codeBarreModal_{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="codeBarreModal_Label_{{ $product->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editStockModalLabel_{{ $product->id }}">Générer le code barre de {{ $product->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                  <form action="{{ route('codeBarres.add') }}" method="POST">
                                                       @csrf
                                                       <div class="mb-3">
                                                           <label for="quantity" class="form-label">Quantité</label>
                                                           <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                                                       </div>
                                               
                                                       <div class="mb-3">
                                                           <label for="show_name" class="form-check-label">Afficher le nom</label>
                                                           <input type="checkbox" class="form-check-input" name="show_name" checked>
                                                       </div>
                                               
                                                       <div class="mb-3">
                                                           <label for="show_price" class="form-check-label">Afficher le prix</label>
                                                           <input type="checkbox" class="form-check-input" name="show_price" checked>
                                                       </div>
                                               
                                                       <div class="mb-3">
                                                           <label for="show_promo" class="form-check-label">Reduction</label>
                                                           <input type="checkbox" class="form-check-input" name="show_promo">
                                                       </div>
                                               
                                                       
                                               
                                                       <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                       
                                               
                                                       <div class="modal-footer">
                                                           <button type="submit" class="btn btn-primary">Générer et Imprimer</button>
                                                       </div>
                                                   </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               @endforeach
                               

                                        
                                  </tbody>
                             </table>
                        </div>
                        <!-- end table-responsive -->
                   </div>
                   <div class="card-footer border-top">
                        <nav aria-label="Page navigation example">
                             <ul class="pagination justify-content-end mb-0">
                                  <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                  <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                  <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                  <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                  <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                             </ul>
                        </nav>
                   </div>
              </div>
         </div>

    </div>


</div>
@endsection

