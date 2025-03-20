@extends('front-end.layouts.master')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title mb-0">Mon Compte</h1>
    </div>
</div>
    <div class="page-content mt-4 mb-10 pb-6">
        <div class="container">
            <div class="tab tab-vertical gutter-lg">
                <ul class="nav nav-tabs mb-4 col-lg-3 col-md-4" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#dashboard">Tableau de Bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#orders">Mes Commandes</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#account">Details de mon compte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Se Déconnecter
                        </a>
                    
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    
                </ul>
                <div class="tab-content col-lg-9 col-md-8">
                    <div class="tab-pane active" id="dashboard">
                        <p class="mb-0">
                            Bonjour <span>{{ Auth::user()->name }}</span> 
                            (Voulez-vous vous  
                            <a href="{{ route('logout') }}" class="text-primary" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Déconnecté ?
                            </a>)
                        </p>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        
                        <p class="mb-8">
                            Depuis le tableau de bord de votre compte, 
                            vous pouvez consulter vos <a href="#orders" class="link-to-tab text-primary">
                                commandes récentes
                                <br></a> et <a href="#account">et modifier votre mot de passe et les détails de votre compte</a>
                        </p>
                        @if(session('success'))
                            <div class="alert alert-success text-white mb-3">{{ session('success') }}</div>
                        @endif
                        
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <a href="{{ route('magasin') }}" class="btn btn-dark btn-rounded">Aller au Magasin<i
                                class="d-icon-arrow-right"></i></a>
                    </div>
                    <div class="tab-pane" id="orders">
                       
                        
                        <table class="shop-table account-orders-table mb-6">
                            <thead>
                                <tr>
                                    <th class="order-id">N°</th>
                                    <th class="order-date">Date</th>
                                    <th class="order-status">Statut</th>
                                    <th class="order-total">Quantité</th>
                                    <th class="order-total">Coût</th>
                                    <th class="order-actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="order-id">{{ $order->order_number }}</td>
                                        <td class="order-date">{{ $order->created_at->format('d F, Y H:i:s') }}</td>
                                        <td class="order-status">
                                            @switch($order->status)
                                                @case('en attente')
                                                    <span class="badge badge-warning">En attente</span>
                                                    @break
                                        
                                                @case('confirmée')
                                                    <span class="badge badge-info">Disponible au magasin</span>
                                                    @break
                                        
                                                @case('expédiée')
                                                    <span class="badge badge-primary">Expédiée</span>
                                                    @break
                                        
                                                @case('livrée')
                                                    <span class="badge badge-success">Récupérée</span>
                                                    @break
                                        
                                                @case('annulée')
                                                    <span class="badge badge-danger">Annulée</span>
                                                    @break
                                        
                                                @default
                                                    <span class="badge badge-secondary">Statut inconnu</span>
                                            @endswitch
                                        </td>
                                        
                                        <td class="order-total">
                                            <span class="order-quantity">{{ $order->details->sum('quantity') }}</span> article(s)
                                        </td>
                                        <td class="order-total">
                                            <span class="order-price">{{ $order->details->sum(fn($detail) => $detail->quantity * $detail->price) }}</span> FCFA
                                        </td>
                                        <td class="order-action">
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="btn btn-outline btn-default btn-block btn-sm btn-rounded">
                                                Voir
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucune commande trouvée.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                        
                        
                    </div>
                    
                    
                    <div class="tab-pane" id="account">
                        <form action="{{ route('profile.update') }}" method="POST" class="form">
                            @csrf
                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Pseudo / Nom *</label>
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name', auth()->user()->name) }}" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Email *</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                
                                </div>
                            </div>
                        
                            
                           
                                <div class="row">
                                    <div class="col-sm-6">
                                       
                        
                                        <label>Mot de passe actuel (laisser vide pour ne pas modifier)</label>
                                        <input type="password" class="form-control" name="current_password">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Nouveau mot de passe (laisser vide pour ne pas modifier)</label>
                                        <input type="password" class="form-control" name="new_password">
                                    </div>
                                </div>
                        
                                
                            
                        
                            <button type="submit" class="btn btn-primary">ENREGISTRER LES MODIFICATIONS</button>
                        </form>
                        
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection