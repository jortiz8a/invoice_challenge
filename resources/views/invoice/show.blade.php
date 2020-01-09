@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now = $now->format('Y-m-d H:i:s');
?>
<div class="container">
    <br>
    <br>
    <div class="col my-2">
        <a class="btn btn-secondary btn-square" href="{{ route('invoices.index') }}"><i class="fas fa-undo"></i> VOLVER </a>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-3">
                <div class="card-header">
                    <div class="col-xs-6">
                        <h1><b> {{ $invoice->store->name }} </b></h1>
                        <h3><small><b> NIT </b> {{ $invoice->store->nit }}</small></h3>
                    </div>
                    <div class="col-xs-6 text-right">
                        <h2><b> FACTURACIÓN PLACETOPAY </b></h2>
                        <h3><small> FACTURA {{ $invoice->code }}</small></h3>
                        <h5>
                            @if (isset($invoice->state))
                            <button type="button" class="btn btn-success btn-sm"> PAGADA </button>
                            @elseif($invoice->expires_at <= $now) <button type="button" class="btn btn-danger btn-sm"> VENCIDA </button>
                                @else
                                <button type="button" class="btn btn-warning btn-sm"> SIN PAGAR </button>
                                @endif
                        </h5>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="row">
                <div class="col col-lg-6">
                    <div class="card o-hidden border-0 shadow my-3">
                        <div class="card-header"> <b> INFORMACIÓN DEL CLIENTE </b> </div>
                        <div class="card-body p-4">
                            <h5><b>Nombre </b>{{ $invoice->client->name .' '. $invoice->client->last_name }} </h5>
                            <h5><b>Tipo de Documento </b> {{ $invoice->client->id_type }}</h5>
                            <h5><b>ID </b> {{ $invoice->client->id_number }}</h5>
                            <h5><b>Teléfono </b> {{ $invoice->client->phone }} </h5>
                            <h5><b>Correo Electrónico </b> {{ $invoice->client->email }} </h5>
                            <h5><b>Dirección </b> {{ $invoice->client->address }} </h5>
                            <h5><b>Ubicación </b>{{ $invoice->client->country .'-'.  $invoice->client->city}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-6">
                    <div class="card o-hidden border-0 shadow my-3">
                        <div class="card-header"> <b> DETALLE DE LA FACTURA </b> </div>
                        <div class="card-body p-4">
                            <h5><b>Fecha de Creación </b>{{ $invoice->created_at }} </h5>
                            <h5><b>Fecha de Vencimiento </b> {{ $invoice->expires_at }} </h5>
                            @if (isset($invoice->state))
                            <h5><b>Fecha de Recibo </b> {{ $invoice->received_at }} </h5>
                            @endif
                            <h5><b>Subtotal </b>{{ '$'. $invoice->subtotal }}</h5>
                            <h5><b>IVA (19%) </b> {{'$'. $invoice->vat}} </h5>
                            <h5><b>Total </b>{{ '$'.$invoice->total}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card o-hidden border-1 my-3">
                <div class="card-body p-0">
                    <div class="col col-md-12 table-responsive-sm">

                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col">Código</th>
                                    <th scope="col">Nombre del Producto</th>
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
                                <p> <b> Total </b></p>
                            </div>
                            <div class="col-sm-2 col-sm-offset-9">
                                <p> {{'$'.$invoice->subtotal }}</p>
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

@endsection
