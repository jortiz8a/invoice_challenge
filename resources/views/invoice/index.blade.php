@extends ('layouts.app')
@section('content')
<?php
$now = new \DateTime();
$now = $now->format('Y-m-d H:i:s');
?>

<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="card-body p-4">
                <div class="text-center"><h2><b> {{ __('FACTURAS') }} </b></h2></div>
            <div>
                <div>
                    <div class="card-body p-2">
                    <a class="btn btn-primary btn-square" href="/invoices/create"><i class="fas fa-plus"> </i><b> AÑADIR FACTURA </b></a>
                    <a class="btn btn-success btn-square" href="{{ route('invoices.import.view') }}"><b> IMPORTAR </b></a>
                    <a class="btn btn-warning btn-square" href="{{ route('export') }}"><b> EXPORTAR </b></a>
                </div>
                <div>
                    <form action="{{ route('invoices.index') }}" method="GET" class="form-inline justify-content-end">
                        @if (empty($_GET))
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div>
                                    <select name="type" class="form-control mr-sm-2" id="type">
                                        <option disabled selected>Buscar por:</option>
                                        <option value="code">#Consecutivo</option>
                                        <option value="description">Descripción</option>
                                        <option value="Store">Tienda</option>
                                        <option value="client">Cliente</option>

                                    </select>
                                </div>
                                <input type="text" class="form-control input-group-prepend" name="search" placeholder="Buscar Factura" required>
                                <div>
                                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> </button>
                                </div>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('invoices.index') }}" class="btn btn-secondary btn-square"><i class="fas fa-undo"></i> NUEVA BUSQUEDA </a>
                        @endif
                    </form>
                </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table col-md-12 table-hover table-striped">
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
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->code }}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td>{{ $invoice->description }}</td>
                            <td> {{$invoice->client->name . ' ' .$invoice->client->last_name }}</td>
                            <td> {{ $invoice->store->name }}</td>
                            <td>
                                @if(isset($invoice->state))
                                <button type="button" class="btn btn-success btn-sm"> PAGADA </button>
                                @elseif($invoice->expires_at <= $now) <button type="button" class="btn btn-danger btn-sm"> VENCIDA </button>
                                    @else
                                    <button type="button" class="btn btn-warning btn-sm"> SIN PAGAR </button>
                                    @endif
                            </td>
                            <td>{{ '$'. $invoice->total }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('invoices.edit', $invoice->id) }}"> Editar </a>
                                    <a class="btn btn-danger" href="{{ route('invoices.confirm.delete', $invoice->id) }}"> Eliminar </a>
                                    <a class="btn btn-success" href="{{ route('invoices.show', $invoice->id) }}"> Ver Detalles </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $invoices->render() }}
            </div>
        </div>
    </div>
</div>
@endsection
