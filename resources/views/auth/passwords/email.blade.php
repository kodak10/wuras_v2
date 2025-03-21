@extends('front-end.layouts.master')

@section('content')



<div class="page-content mt-6 pb-2 mb-10">
    <div class="container">
        <div class="login-popup">
            <div class="form-box">
                @if (session('status'))
                    <div class="alert alert-success text-white" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end mb-2">{{ __('Email') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-dark btn-block btn-rounded w-100">
                                {{ __('Envoyer le lien de réinitialisation du mot de passe') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
