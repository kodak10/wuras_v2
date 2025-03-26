@extends('Administration.layouts.master')

@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-flex align-items-center gap-1">
                            <iconify-icon icon="solar:user-profile-bold" class="text-primary fs-20"></iconify-icon>
                            Profil de l'utilisateur
                        </h4>
                        @if (session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profil.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nom</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name', $user->name ?? '') }}" 
                                               placeholder="Entrer votre nom">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Numéro de téléphone</label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                               value="{{ old('phone', $user->phone ?? '') }}" 
                                               placeholder="Entrer votre numéro de téléphone">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email', $user->email ?? '') }}" 
                                               placeholder="Entrer votre adresse email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Champs pour la modification du mot de passe -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mot de passe actuel</label>
                                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" 
                                               placeholder="Entrer votre mot de passe actuel">
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nouveau mot de passe</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                               placeholder="Entrer votre nouveau mot de passe">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Confirmer le nouveau mot de passe</label>
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                               placeholder="Confirmer votre nouveau mot de passe">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 text-end">
                                    <a href="{{ route('profil.index') }}" class="btn btn-danger">Annuler</a>
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
