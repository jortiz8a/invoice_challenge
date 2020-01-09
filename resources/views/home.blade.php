@extends('layouts.app')
@section('content')
    <div class="container">
        <br>
        <br>
        <br>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card o-hidden border-0 shadow my-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <p class="h3"> <br> <b> TIENDAS </b> </p>
                                        <a class="btn btn-primary" href="{{ route('stores.index') }}"> ENTRAR </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card o-hidden border-0 shadow my-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <p class="h3"> <br> <b> PRODUCTOS </b></p>
                                        <a class="btn btn-primary" href="{{ route('products.index') }}"> ENTRAR </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card o-hidden border-0 shadow my-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <p class="h3"> <br> <b> CLIENTES </b></p>
                                        <a class="btn btn-primary" href="{{ route('clients.index') }}"> ENTRAR </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card o-hidden border-0 shadow my-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <p class="h3"> <br> <b> FACTURAS </b> </p>
                                        <a class="btn btn-primary" href="{{ route('invoices.index') }}"> ENTRAR </a>
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
    </div>
@endsection
