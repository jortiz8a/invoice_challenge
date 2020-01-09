@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="card-body p-4">
                <div class="text-center"><h2><b> {{ __('CLIENTES') }} </b></h2></div>
                <div><a class="btn btn-primary btn-square" href="{{ route('clients.create') }}"><i class="fas fa-plus"></i><b> AÑADIR CLIENTE </b></a>
                </div>
                <div class="justify-content-end">
                    <form action="{{ route('clients.index') }}" method="GET" class="form-inline justify-content-end">
                        @if (empty($_GET))
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div>
                                    <select name="type" class="form-control mr-sm-2" id="type">
                                        <option disabled selected>Buscar por:</option>
                                        <option value="id_number">ID</option>
                                        <option value="name">Nombre</option>
                                        <option value="last_name">Apellido</option>
                                        <option value="id_type">Tipo de Documento</option>
                                        <option value="email">Correo Electrónico</option>
                                        <option value="country">País</option>
                                        <option value="city">Ciudad</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control input-group-prepend" name="search" placeholder="Buscar Cliente" required>
                                <div>
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-search"></i> </button>
                                </div>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-square"><i class="fas fa-undo"></i> NUEVA BUSQUEDA </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">ID</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Ubicación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->name . ' ' . $client->last_name }}</td>
                            <td>{{ $client->id_type . ' ' . $client->id_number }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->city . ', ' . $client->country }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('clients.edit', $client->id) }}"> Editar </a>
                                    <a class="btn btn-danger" href="{{ route('clients.confirm.delete', $client->id) }}"> Eliminar </a>
                                    <a class="btn btn-success" href="{{ route('clients.show', $client->id) }}"> Ver Detalles </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $clients->render() }}
            </div>
        </div>
    </div>
</div>
@endsection
