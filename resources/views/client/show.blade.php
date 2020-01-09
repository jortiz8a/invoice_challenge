@extends ('layouts.app')
@section('content')

<div class="container">
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-3">
                <div class="col my-2">
                <a class="btn btn-secondary btn-square" href="{{ route('clients.index') }}"><i class="fas fa-undo"></i> VOLVER </a>
                </div>
                <div class="card-header text-center">
                    <h3><b> INFORMACIÓN SOBRE EL CLIENTE </b></h3>
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <h5><b>Nombre </b> {{ $client->name .' '. $client->last_name }}</h5>
                                    <h5><b>Tipo de Documento </b> {{ $client->id_type }}</h5>
                                        <h5><b>ID </b> {{ $client->id_number }}</h5>
                                            <h5><b>Correo Electrónico </b> {{ $client->email }} </h5>
                                                <h5><b>Teléfono </b> {{ $client->phone }} </h5>
                                                    <h5><b>Dirección </b> {{ $client->address }} </h5>
                                                        <h5><b>Ubicación </b>{{ $client->country .', '. $client->city }}</h5>
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card o-hidden border-1 my-3">
                <div class="card-header text-center">
                    <h3><b> FACTURAS A NOMBRE DEL CLIENTE </b></h3>
                </div>
                <div class="card-body p-0">
                    <div class="col col-md-12 table-responsive-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#Consecutivo</th>
                                    <th scope="col">Fecha de Creación</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Tienda</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($client->invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->code }}</td>
                                    <td>{{ $invoice->created_at }}</td>
                                    <td>{{ $invoice->description }}</td>
                                    <td>{{ $invoice->client->name . ' ' .$invoice->client->last_name }}</td>
                                    <td>{{ $invoice->store->name }}</td>
                                    <td>
                                        @if (isset($invoice->state))
                                        <button type="button" class="btn btn-success btn-sm"> PAGADA </button>
                                        @else
                                        <button type="button" class="btn btn-warning btn-sm"> SIN PAGAR </button>
                                        @endif
                                    </td>
                                    <td>{{ '$'. $invoice->total }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a class="btn btn-warning" href="{{ route('invoices.edit', $invoice->id) }}"> Editar </a>
                                            <a class="btn btn-danger" href="/invoices/{{ $invoice->id }}/confirmDelete"> Eliminar </a>
                                            <a class="btn btn-success" href="{{ route('invoices.show', $invoice->id) }}"> Ver Detalles </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
