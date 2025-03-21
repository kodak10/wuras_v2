@extends('front-end.layouts.master')

@section('content')
<div class="page-content mt-6 pb-2 mb-10">
    <div class="container">
        <div class="login-popup">
            <div class="form-box">
                <div class="tab tab-nav-simple tab-nav-boxed form-tab">
                    
                    <div class="tab-content">
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-dark btn-block btn-rounded w-100">
                                        {{ __('Confirmer le mot de passe') }}
                                    </button>
    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Mot de passe oublié ?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
