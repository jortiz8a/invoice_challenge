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
                                <h1 class="h4 text-red-500 mb-4"><b>{{ __('EDITAR FACTURA') }}</b></h1>
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
                            <form action="/invoices/{{ $invoice->id }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="code">#Consecutivo </label>
                                        <div class="form-control disabled">{{ $invoice->code }}</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tienda </label>
                                        <select name="store_id" id="store_id" class="form-control @error('store_id') is-invalid @enderror" required>
                                            <option value="">{{ __('Por favor seleccione un valor de la lista') }}</option>
                                            @foreach($stores as $store)
                                                <option value='{{ $store->id }}' {{ $store->id == old('store_id', $invoice->store_id) ? 'selected' : '' }}> {{ 'NIT ' . $store->nit . ' ' . $store->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cliente </label>
                                        <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror" required>
                                            <option value="">{{ __('Por favor seleccione un valor de la lista') }}</option>
                                            @foreach($clients as $client)
                                                <option value='{{ $client->id }}' {{ $client->id == old('client_id', $invoice->client_id) ? 'selected' : '' }}> {{ $client->id_type . ' ' . $client->id_number . ' ' . $client->name . ' ' . $client->last_name  }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Estado: </label>
                                        <select name="state" id="state" class="custom-select">
                                            @if (isset($invoice->state))
                                                <option value='1' selected> PAGADA </option>
                                                <option value='2'> SIN PAGAR </option>
                                            @else
                                                <option value='2' selected> SIN PAGAR </option>
                                                <option value='1'> PAGADA </option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Descripción </label>
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $invoice->description) }}</textarea>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" id="subtotal" name="subtotal" value="{{ $invoice->subtotal }}">
                                <input type="hidden" class="form-control" id="total" name="total" value="{{ $invoice->total }}">
                                <input type="hidden" class="form-control" id="vat" name="vat" value="{{ $invoice->vat }}">

                                <br>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary"> GUARDAR </button>
                                </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-12 col-lg-12 col-md-9">
                                <div class="card o-hidden border-1 my-3">
                                    <div class="card-header text-right">
                                        <a class="btn btn-primary" href="/invoices/{{ $invoice->id }}/invoice_product/create"> <b> AGREGAR PRODUCTOS </b> </a>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="col col-md-12 table-responsive-sm">

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Código</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Cantidad</th>
                                                        <th scope="col">Precio Unitario</th>
                                                        <th scope="col">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($invoice->products as $product)
                                                    <tr>
                                                        <td>{{ $product->code }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->pivot->quantity }}</td>
                                                        <td>{{ '$'.$product->pivot->unit_value }}</td>
                                                        <td>{{ '$'.$product->pivot->total_value }}</td>
                                                    </tr>
                                                    @endforeach
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row text-right">
                                                <div class="col-sm-9 col-sm-offset-9">
                                                    <p> <b> Subtotal </b></p>
                                                    <p> <b> IVA (19%) </b></p>
                                                    <p> <b>Total </b></p>
                                                </div>
                                                <div class="col-sm-2 col-sm-offset-9">
                                                    <p> {{ '$'.$invoice->subtotal }}</p>
                                                    <p> {{'$'.$invoice->vat }}</p>
                                                    <p> {{'$'.$invoice->total }}</p>
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
    </div>
</div>
@endsection
