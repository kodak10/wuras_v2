@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title mb-2">Total Commandes</h4>
                            <p class="text-muted fw-medium fs-22 mb-0">{{ $totalOrders }}</p>
                        </div>
                        <div>
                            <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                <iconify-icon icon="solar:chat-round-money-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title mb-2">Commande Annulée</h4>
                            <p class="text-muted fw-medium fs-22 mb-0">{{ $cancelledOrders }}</p>
                        </div>
                        <div>
                            <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                <iconify-icon icon="solar:cart-cross-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title mb-2">Commande en Attente</h4>
                            <p class="text-muted fw-medium fs-22 mb-0">{{ $pendingOrders }}</p>
                        </div>
                        <div>
                            <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                <iconify-icon icon="solar:box-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title mb-2">Commandes Terminée</h4>
                            <p class="text-muted fw-medium fs-22 mb-0">{{ $completedOrders }}</p>
                        </div>
                        <div>
                            <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                <iconify-icon icon="solar:tram-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
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
                        <h4 class="card-title">Liste de toutes les commandes</h4>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
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
                                                <a href="{{ route('commandes.edit', $order->id) }}" class="btn btn-soft-primary btn-sm">
                                                    <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                                </a>
                                            </div>
                                        </td>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialisation de DataTable
        $('.table').DataTable({
            responsive: true, // Rendre la table responsive
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json' // Traduction en français
            },
            columnDefs: [
                { orderable: false, targets: 7 } // Désactiver le tri sur la colonne des actions
            ]
        });
    });
</script>

@endpush