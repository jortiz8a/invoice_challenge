@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 ">
                <div class="card o-hidden border border-dark shadow-sm my-5">
                    <div class="card-body p-3">
                        <div class="row">
                        </div>
                        <div class="text-center">
                            <h1 class="h2 text-gray-900 mb-4">{{ __('RETO FACTURACIÓN PLACETOPAY') }}</h1>
                                <h1 class="h4 text-gray-900 mb-4">{{ __('Desarrollado por: Jorge Ortiz') }}</h1>
                        </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="Password" placeholder="Contraseña">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('ENTRAR') }}
                                    </button>

                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}"> {{ __('NUEVO USUARIO') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
