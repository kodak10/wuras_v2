@extends('front-end.layouts.master')

@section('content')
<div class="page-content mt-6 pb-2 mb-10">
    <div class="container">
        <div class="login-popup">
            <div class="form-box">
                <div class="tab tab-nav-simple tab-nav-boxed form-tab">
                    <ul class="nav nav-tabs nav-fill align-items-center border-no justify-content-center mb-5" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active border-no lh-1 ls-normal" href="#signin">Se Connecter</a>
                        </li>
                        <li class="delimiter">Ou</li>
                        <li class="nav-item">
                            <a class="nav-link border-no lh-1 ls-normal" href="#register">S'Inscrire</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="signin">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Adresse Email *" value="{{ old('email') }}" required="">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mot de passe *" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-footer">
                                    {{-- <div class="form-checkbox">
                                        <input type="checkbox" class="custom-checkbox"  id="remember" {{ old('remember') ? 'checked' : '' }} name="remember">
                                        <label class="form-control-label" for="signin-remember">Se Souvenir de moi
                                        </label>
                                    </div> --}}
                                    {{-- <a href="{{ route('password.request') }}" class="lost-link">Mot de passe oublié ?</a> --}}
                                </div>
                                <button class="btn btn-dark btn-block btn-rounded" type="submit">Se Connecter</button>
                            </form>
                            
                        </div>
                        <div class="tab-pane" id="register">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control"  name="email" value="{{ old('email') }}"  placeholder="Adresse Email *" required="">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control"  name="phone" placeholder="Numéro de téléphone *" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mot de passe *" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-footer">
                                    <div class="form-checkbox">
                                        <input type="checkbox" class="custom-checkbox" id="register-agree" name="register-agree" required="">
                                        <label class="form-control-label" for="register-agree">J'accepte la politique de confidentialité</label>
                                    </div>
                                </div>
                                <button class="btn btn-dark btn-block btn-rounded" type="submit">S'Inscrire</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
