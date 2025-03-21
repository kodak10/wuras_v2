@extends('Administration.layouts.master')

@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-flex align-items-center gap-1">
                            <iconify-icon icon="solar:shop-2-bold-duotone" class="text-primary fs-20"></iconify-icon>
                            Paramètres généraux
                        </h4>
                        @if (session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('parametres.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nom du magasin</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name', $parametre->name ?? '') }}" 
                                               placeholder="Entrer le nom du magasin">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Numéro de téléphone du propriétaire</label>
                                        <input type="text" name="numero_proprietaire" class="form-control @error('numero_proprietaire') is-invalid @enderror" 
                                               value="{{ old('numero_proprietaire', $parametre->numero_proprietaire ?? '') }}" 
                                               placeholder="Entrer le numéro du propriétaire">
                                        @error('numero_proprietaire')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Numéro de téléphone du magasin</label>
                                        <input type="text" name="number_magasin" class="form-control @error('number_magasin') is-invalid @enderror" 
                                               value="{{ old('number_magasin', $parametre->number_magasin ?? '') }}" 
                                               placeholder="Entrer le numéro du magasin">
                                        @error('number_magasin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Adresse Email du magasin</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email', $parametre->email ?? '') }}" 
                                               placeholder="Entrer l'adresse Email du magasin">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Adresse complète</label>
                                        <textarea class="form-control bg-light-subtle @error('adresse') is-invalid @enderror" 
                                                  name="adresse" rows="3" placeholder="Entrer l'adresse complète">{{ old('adresse', $parametre->adresse ?? '') }}</textarea>
                                        @error('adresse')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 text-end">
                                    <a href="{{ route('parametres.index') }}" class="btn btn-danger">Annuler</a>
                                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                                </div>
                            </div>
                        </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
