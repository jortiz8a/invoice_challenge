@extends ('layouts.app')
@section('content')

<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="card-body p-4">
            <div class="text-center"><h2><b> {{ __('TIENDAS') }} </b></h2></div>
            <a class="btn btn-primary btn-square" href="{{ route('stores.create') }}"> <i class="fas fa-plus"> </i><b> AÑADIR TIENDA </b></a>
            <form action="{{ route('stores.index') }}" method="GET" class="form-inline justify-content-end">
                @if (empty($_GET))
                <div class="form-group">
                    <div class="input-group mb-2">
                        <div>
                            <select name="type" class="form-control mr-sm-2" id="type">
                                <option disabled selected>Buscar por:</option>
                                <option value="name">Nombre</option>
                                <option value="nit">NIT</option>
                                <option value="address">Dirección</option>
                                <option value="phone">Teléfono</option>
                            </select>
                        </div>
                        <input type="text" class="form-control input-group-prepend" name="search" placeholder="Buscar Tienda" required>
                        <div>
                            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                @else
                <a href="{{ route('stores.index') }}" class="btn btn-secondary btn-square"><i class="fas fa-undo"></i> NUEVA BUSQUEDA </a>
                @endif
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">NIT</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $store)
                        <tr>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->nit }}</td>
                            <td>{{ $store->address }}</td>
                            <td>{{ $store->phone }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('stores.edit', $store->id) }}"> Editar </a>
                                    <a class="btn btn-danger" href="{{ route('stores.confirm.delete', $store->id) }}"> Eliminar </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $stores->render()}}
            </div>
        </div>
    </div>
</div>
@endsection
