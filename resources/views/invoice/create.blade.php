@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-5">
                <div class="card-body p-0">
                    <div class="col-lg">
                        <div class="p-5">
                            <a class="btn btn-secondary btn-square" href="{{ route('invoices.index') }}"><i class="fas fa-undo"></i> VOLVER </a>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><b>{{ __('NUEVA FACTURA') }}</b></h1>
                            </div>
                            <div class="col">
                                <br>
                                @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <form action="{{ route('invoices.index') }}" method="POST">
                                @csrf
                                <b>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="description">Descripción </label>
                                        <input type="text" class="form-control" id="description" name="description" placeholder="Descripción del Producto" value="{{ old('description') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">#Consecutivo </label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Ingrese el Consecutivo" value="{{ old('code') }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Tienda </label>
                                        <select name="Store_id" id="Store_id" class="form-control @error('Store') is-invalid @enderror">
                                            @foreach($stores as $store)
                                            <option value='{{ $store->id }}'> {{ 'NIT ' . $store->nit . ' ' . $store->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cliente </label>
                                        <select name="client_id" id="client_id" class="form-control @error('client') is-invalid @enderror">
                                            @foreach($clients as $client)
                                            <option value='{{ $client->id }}'> {{ $client->id_type . ' ' . $client->id_number . ' ' . $client->name . ' ' . $client->last_name  }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" name="btnGuardar" class="btn btn-primary"> GUARDAR </button>
                                </b>
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
