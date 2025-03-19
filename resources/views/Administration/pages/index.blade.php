@extends('Administration.layouts.master')

@section('content')
     <!-- Start Container Fluid -->
     <div class="container-fluid">

          <div class="row">
               <!-- Total Orders Card -->
               <div class="col-md-6">
                   <div class="card overflow-hidden">
                       <div class="card-body">
                           <div class="row">
                               <div class="col-6">
                                   <div class="avatar-md bg-soft-primary rounded">
                                       <i class="bx bx-cart avatar-title fs-32 text-primary"></i>
                                   </div>
                               </div>
                               <div class="col-6 text-end">
                                   <p class="text-muted mb-0 text-truncate">Total des commandes</p>
                                   <h3 class="text-dark mt-1 mb-0">{{ $totalOrders }}</h3>
                               </div>
                           </div>
                       </div>
                       <div class="card-footer py-2 bg-light bg-opacity-50">
                           <div class="d-flex align-items-center justify-content-between">
                               <div>
                                   <span class="text-success"> 
                                       <i class="bx bxs-up-arrow fs-12"></i> {{ number_format($orderGrowthWeek, 2) }}%
                                   </span>
                                   <span class="text-muted ms-1 fs-12">La semaine dernière</span>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           
               <!-- Paid Orders Card -->
               <div class="col-md-6">
                   <div class="card overflow-hidden">
                       <div class="card-body">
                           <div class="row">
                               <div class="col-6">
                                   <div class="avatar-md bg-soft-success rounded">
                                       <i class="bx bx-check avatar-title fs-32 text-success"></i>
                                   </div>
                               </div>
                               <div class="col-6 text-end">
                                   <p class="text-muted mb-0 text-truncate">Commandes payées</p>
                                   <h3 class="text-dark mt-1 mb-0">{{ $paidOrders }}</h3>
                               </div>
                           </div>
                       </div>
                       <div class="card-footer py-2 bg-light bg-opacity-50">
                           <div class="d-flex align-items-center justify-content-between">
                               <div>
                                   <span class="text-success"> 
                                       <i class="bx bxs-up-arrow fs-12"></i> {{ number_format($paidOrderGrowthWeek, 2) }}%
                                   </span>
                                   <span class="text-muted ms-1 fs-12">La semaine dernière</span>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           
              
           </div>
           
           

        <div class="row">
             <div class="col">
                  <div class="card">
                       <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                 <h4 class="card-title">
                                    Commandes récentes
                                 </h4>

                                 <a href="{{ route('commandes.index') }}" class="btn btn-sm btn-soft-primary">
                                      <i class="bx bx-plus me-1"></i>Liste des commandes
                                 </a>
                            </div>
                       </div>
                       <!-- end card body -->
                       <div class="table-responsive table-centered">
                         <table class="table align-middle mb-0 table-hover table-centered">
                              <thead class="bg-light-subtle">
                                  <tr>
                                      <th>N° Commande</th>
                                      <th>Date</th>
                                      <th>Client</th>
                                      <th>Nombre articles</th>
                                      <th>Total</th>
                                      <th>Status Commande</th>
                                      <th>Statut de Paiement</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($orders as $order)
                                      <tr>
                                          <td>{{ $order->order_number }}</td>
                                          <td>{{ $order->created_at->format('M d, Y') }}</td>
                                          <td><a href="#!" class="link-primary fw-medium">{{ $order->user->name }}</a></td>
                                          <td>{{ $order->details->count() }}</td>
                                          <td>{{ $order->total_price }} FCFA</td>
                                          <td><span class="badge bg-light text-dark px-2 py-1 fs-13">{{ ucfirst($order->status) }}</span></td>
                                          <td><span class="badge border border-secondary text-secondary px-2 py-1 fs-13">{{ ucfirst($order->payment_status) }}</span></td>
                                          <td>
                                              <div class="d-flex gap-2">
                                                  {{-- <a href="{{ route('orders.show', $order->id) }}" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a> --}}
                                                  <a href="{{ route('commandes.edit', $order->id) }}" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                  {{-- <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="submit" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>
                                                  </form> --}}
                                              </div>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                            <!-- end table -->
                       </div>
                       <!-- table responsive -->

                       
                  </div>
                  <!-- end card -->
             </div>
             <!-- end col -->
        </div> <!-- end row -->

   </div>
   <!-- End Container Fluid -->
@endsection