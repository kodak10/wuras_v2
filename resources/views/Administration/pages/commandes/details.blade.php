@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">
    <a class="btn btn-outline-secondary bg-outline" href="{{ route('commandes.index') }}"><iconify-icon icon="solar:arrow-left-line-duotone"></iconify-icon>
         Retour</a>

         @if (session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif
    <div class="row">
         <div class="col-xl-9 col-lg-8">
              <div class="row">
                   <div class="col-lg-12">
                        <div class="card">
                             <div class="card-body">
                                  <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                        <div>
                                             <h4 class="fw-medium text-dark d-flex align-items-center gap-2">
                                             #{{ $order->order_number }} - {{ \Carbon\Carbon::parse($order->created_at)->format('F d, Y \a\t h:i A') }}
                                             <span class="badge {{ $order->payment_status == 'payé' ? 'bg-success-subtle text-success' : ($order->payment_status == 'non payé' ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning') }} px-2 py-1 fs-13">
                                                  {{ ucfirst($order->payment_status) }}
                                              </span>
                                              
                                              <span class="border {{ $order->status == 'en attente' || $order->status == 'confirmée' ? 'border-warning text-warning' : ($order->status == 'livrée' || $order->status == 'expédiée' ? 'border-success text-success' : 'border-danger text-danger') }} fs-13 px-2 py-1 rounded">
                                                  {{ ucfirst($order->status) }}
                                              </span>
                                              
                                             </h4>
                                        </div>

                                        
                                        <div>
                                            @if($order->shipping_method === 'free-shipping')
                                                <span class="badge bg-primary">À retirer au magasin</span>
                                            @else
                                                <span class="badge bg-success">Livraison / Expédition</span>
                                                <p>{{ $order->shipping_address }}</p>
                                            @endif
                                        </div>
                                        
                                       


                                    
                                       <div>
                                             <a href="#!" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editStatusModal_{{ $order->id }}">Editer les statuts</a>
                                             <a href="#editOrderModal_{{ $order->id }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editOrderModal_{{ $order->id }}">Editer la commande</a>
                                        </div>

                                        <div class="modal fade" id="editOrderModal_{{ $order->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editOrderModalLabel_{{ $order->id }}" aria-hidden="true">
                                             <div class="modal-dialog">
                                                 <div class="modal-content">
                                                     <div class="modal-header">
                                                         <h5 class="modal-title" id="editOrderModalLabel_{{ $order->id }}">Modifier la commande #{{ $order->order_number }}</h5>
                                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                     </div>
                                                     <div class="modal-body">
                                                         <form action="{{ route('commandes.update', $order->id) }}" method="POST">
                                                             @csrf
                                                             @method('PUT')
                                                             <input type="hidden" name="order_id" value="{{ $order->id }}">
                                         
                                                             <div class="mb-3">
                                                                 <label for="shipping_price" class="form-label">Prix de livraison</label>
                                                                 <input type="number" class="form-control @error('shipping_price') is-invalid @enderror" id="shipping_price" name="shipping_price" value="{{ old('shipping_price', $order->shipping_price) }}" step="0.01" required>
                                                                 @error('shipping_price')
                                                                     <div class="invalid-feedback">
                                                                         {{ $message }}
                                                                     </div>
                                                                 @enderror
                                                             </div>
                                         
                                                             <div class="mb-3">
                                                                 <label for="discount" class="form-label">Réduction</label>
                                                                 <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ old('discount', $order->discount) }}" step="0.01" required>
                                                                 @error('discount')
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

                                        <!-- Modal pour éditer le statut -->
                                        <div class="modal fade" id="editStatusModal_{{ $order->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editStatusModalLabel_{{ $order->id }}" aria-hidden="true">
                                             <div class="modal-dialog">
                                             <div class="modal-content">
                                                  <div class="modal-header">
                                                       <h5 class="modal-title" id="editStatusModalLabel_{{ $order->id }}">Modifier le statut de la commande #{{ $order->order_number }}</h5>
                                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                       <form action="{{ route('commandes.updateStatus', $order->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                        
                                                            <!-- Sélection du statut de la commande -->
                                                            <div class="mb-3">
                                                                 <label for="status" class="form-label">Statut de la commande</label>
                                                                 <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                                 <option value="en attente" {{ $order->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                                                                 <option value="confirmée" {{ $order->status == 'confirmée' ? 'selected' : '' }}>Confirmée</option>
                                                                 <option value="expédiée" {{ $order->status == 'expédiée' ? 'selected' : '' }}>Expédiée</option>
                                                                 <option value="livrée" {{ $order->status == 'livrée' ? 'selected' : '' }}>Livrée</option>
                                                                 <option value="annulée" {{ $order->status == 'annulée' ? 'selected' : '' }}>Annulée</option>
                                                                 </select>
                                                                 @error('status')
                                                                 <div class="invalid-feedback">
                                                                      {{ $message }}
                                                                 </div>
                                                                 @enderror
                                                            </div>
                                        
                                                            <!-- Sélection du statut de paiement -->
                                                            <div class="mb-3">
                                                                 <label for="payment_status" class="form-label">Statut de paiement</label>
                                                                 <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
                                                                 <option value="non payé" {{ $order->payment_status == 'non payé' ? 'selected' : '' }}>Non payé</option>
                                                                 <option value="payé" {{ $order->payment_status == 'payé' ? 'selected' : '' }}>Payé</option>
                                                                 <option value="remboursé" {{ $order->payment_status == 'remboursé' ? 'selected' : '' }}>Remboursé</option>
                                                                 </select>
                                                                 @error('payment_status')
                                                                 <div class="invalid-feedback">
                                                                      {{ $message }}
                                                                 </div>
                                                                 @enderror
                                                            </div>
                                        
                                                            <!-- Boutons pour sauvegarder ou annuler -->
                                                            <div class="modal-footer">
                                                                 <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            </div>
                                                       </form>
                                                  </div>
                                             </div>
                                             </div>
                                        </div>
 
 
                                         
                                  </div>

                                  
                             </div>
                        </div>

                        <div class="card">
                             <div class="card-header">
                                  <h4 class="card-title">Produits</h4>
                             </div>
                             <div class="card-body">
                                  <div class="table-responsive">
                                   <table class="table align-middle mb-0 table-hover table-centered">
                                        <thead class="bg-light-subtle border-bottom">
                                            <tr>
                                                <th>Produits</th>
                                                <th>Quantité</th>
                                                <th>Prix</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->details as $orderDetail)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            @php
                                                                // Récupérer l'image principale (vignette) associée au produit
                                                                $thumbnail = $orderDetail->product->images()->where('is_thumbnail', true)->first();
                                                                $imageUrl = $thumbnail ? asset('storage/' . $thumbnail->path) : asset('images/default.png'); // Image par défaut si pas d'image
                                                            @endphp
                                            
                                                            <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                <img src="{{ $imageUrl }}" alt="{{ $orderDetail->product->name }}" class="avatar-md">
                                                            </div>
                                                        </div>
                                                    </td>
                                                   
                                                    <td>{{ $orderDetail->quantity }}</td>
                                                    <td>{{ number_format($orderDetail->price, 2) }}</td>
                                                    <td>{{ number_format($orderDetail->quantity * $orderDetail->price, 2) }}</td>
                                                  </tr>
                                            @endforeach
                                        </tbody>
                                   </table>
                                    
                                  </div>
                             </div>
                        </div>
                   </div>
              </div>
         </div>

         <div class="col-xl-3 col-lg-4">
              <div class="card">
                   <div class="card-header">
                        <h4 class="card-title">Résumé de la commande</h4>
                   </div>
                   <div class="card-body">
                        <div class="table-responsive">
                         <table class="table mb-0">
                              <tbody>
                                  <tr>
                                      <td class="px-0">
                                          <p class="d-flex mb-0 align-items-center gap-1">
                                              <iconify-icon icon="solar:clipboard-text-broken"></iconify-icon> Sous Total :
                                          </p>
                                      </td>
                                      <td class="text-end text-dark fw-medium px-0">{{ number_format($subTotal, 2) }} FCFA</td>
                                  </tr>
                                  <tr>
                                      <td class="px-0">
                                          <p class="d-flex mb-0 align-items-center gap-1">
                                              <iconify-icon icon="solar:kick-scooter-broken" class="align-middle"></iconify-icon> Coût de livraison / Expédition :
                                          </p>
                                      </td>
                                      <td class="text-end text-dark fw-medium px-0">{{ number_format($deliveryCost, 2) }} FCFA</td>
                                  </tr>
                                  <tr>
                                      <td class="px-0">
                                          <p class="d-flex mb-0 align-items-center gap-1">
                                              <iconify-icon icon="solar:ticket-broken" class="align-middle"></iconify-icon> Réduction :
                                          </p>
                                      </td>
                                      <td class="text-end text-dark fw-medium px-0">-{{ number_format($discount, 2) }} FCFA</td>
                                  </tr>
                                  
                              </tbody>
                         </table>
                          
                          
                        </div>
                   </div>
                   <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                        <div>
                             <p class="fw-medium text-dark mb-0">Total</p>
                        </div>
                        <div>
                             <p class="fw-medium text-dark mb-0">{{ number_format($total, 2) }} FCFA</p>
                        </div>
                   </div>
              </div>

              

              <div class="card">
                   <div class="card-header">
                        <h4 class="card-title">Détails du client</h4>
                   </div>
                   <div class="card-body">
                    <div class="d-flex align-items-center gap-2">
                        <div>
                            <p class="mb-1">{{ $order->user->name }}</p>
                            <a href="mailto:{{ $order->user->email }}" class="link-primary fw-medium">{{ $order->user->email }}</a>
                        </div>
                    </div>
                
                    <div class="d-flex justify-content-between mt-3">
                        <h5 class="">Numéro</h5>
                        <div>
                            <a href="#!"><i class="bx bx-edit-alt fs-18"></i></a>
                        </div>
                    </div>
                    <p class="mb-1">{{ $order->user->phone ?? 'Non fourni' }}</p>
                
                    <div class="d-flex justify-content-between mt-3">
                        <h5 class="">Adresse de livraison</h5>
                        <div>
                            <a href="#!"><i class="bx bx-edit-alt fs-18"></i></a>
                        </div>
                    </div>
                
                    <div>
                        <p class="mb-1">{{ $order->shipping_address ?? 'Adresse non fournie' }}</p>
                        <p class="mb-1">{{ $order->shipping_city ?? 'Ville non spécifiée' }}</p>
                        <p class="mb-1">{{ $order->user->phone ?? 'Téléphone non fourni' }}</p>
                    </div>
                </div>
                
              </div>
         </div>
    </div>
</div>
@endsection
