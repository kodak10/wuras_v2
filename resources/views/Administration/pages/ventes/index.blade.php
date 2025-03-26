@extends('Administration.layouts.master')

@section('content')
<div class="page-titles mb-7 mb-md-5">
    <div class="row">
      <div class="col-lg-8 col-md-6 col-12 align-self-center">
        
        <h2 class="mb-0 fw-bolder fs-8">Liste des ventes du magasin</h2>
      </div>
      
    </div>
  </div>

  <div class="product-list">
    <div class="card">
      <div class="card-body p-3">
        @if(session('success'))
            <div class="alert customize-alert alert-dismissible text-primary text-primary alert-light-primary bg-primary-subtle fade show remove-close-icon" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex align-items-center me-3 me-md-0">
                    <i class="ti ti-info-circle fs-5 me-2 flex-shrink-0 text-primary"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
        
      <div class="table-responsive">
        <table id="lang_file" class="table w-100 table-striped table-bordered display">
            <thead>
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        </div>
                    </th>
                    <th>Date</th>
                    <th>Articles</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Réduction</th>
                    <th>Total</th>
                    <th>Vendu par</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventes as $vente)
                    <tr>
                        <td>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value="{{ $vente->id }}" id="flexCheckDefault{{ $vente->id }}">
                            </div>
                        </td>
                        <td> {{ $vente->created_at }}</td>
                        <td>
                            <p class="mb-0">{{ $vente->produit->name }}</p>
                        </td>
                        <td class="order-total">
                            <span class="order-quantity">{{ $vente->produit->price }}</span>
                        </td>
                        <td class="order-total">
                            <span class="order-quantity">{{ $vente->quantity }}</span>
                        </td>
                        <td class="order-total">
                            <span class="order-quantity">{{ $vente->discount }}</span>
                        </td>
                        <td class="order-total">
                            <span class="order-quantity">{{ $vente->total }}</span>
                        </td>
                        <td>{{ $vente->user->name }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        </div>
                    </th>
                    <th>Date</th>
                    <th>Articles</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Réduction</th>
                    <th>Total</th>
                    <th>Vendu par</th>
                </tr>
            </tfoot>
        </table>
    </div>
    

      </div>
    </div>
  </div>
   




@push('scripts')

<script>
    $(document).ready(function() {
        $('#lang_file').DataTable({
            responsive: true, // Rendre la table responsive
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json' // Traduction en français
            },
            columnDefs: [
                { orderable: false, targets: 0 }, // Désactiver le tri sur la première colonne (les checkboxes)
            ],
            ordering: true, // Activer le tri
            pageLength: 10, // Nombre de lignes par page
        });
    });
</script>


<script>
    function confirmDelete(articleId) {
        // Afficher une boîte de confirmation avant de soumettre le formulaire
        if (confirm("Êtes-vous sûr de vouloir supprimer cet article ?")) {
            // Si l'utilisateur clique sur "OK", soumettre le formulaire
            document.getElementById('delete-form-' + articleId).submit();
        }
    }
</script>
@endpush

@endsection