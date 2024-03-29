@extends ('layouts.app')
@section('content')

<div class="container">
    <div class="card shadow mb-4 my-5">
        <div class="card-header py-3">
            <div class="card-body p-4">
            <div class="text-center"><h2><b> {{ __('PRODUCTOS') }} </b></h2></div>
            <div><a class="btn btn-primary btn-square" href="{{ route('products.create') }}"><i class="fas fa-plus"> </i><b> AÑADIR PRODUCTO </b></a>
            <div class="justify-content-end">
                <form action="{{ route('products.index') }}" method="GET" class="form-inline justify-content-end">
                    @if (empty($_GET))
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div>
                                <select name="type" class="form-control mr-sm-2" id="type">
                                    <option disabled selected>Buscar por:</option>
                                    <option value="code">Código</option>
                                    <option value="name">Nombre</option>
                                    <option value="price">Precio</option>
                                </select>
                            </div>
                            <input type="text" class="form-control input-group-prepend" name="search" placeholder="Buscar Producto" required>
                            <div>
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-search"></i> </button>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-square"><i class="fas fa-undo"></i> NUEVA BUSQUEDA </a>
                    @endif
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio de Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ '$'.$product->price }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('products.edit', $product->id) }}"> Editar </a>
                                    <a class="btn btn-danger" href="{{ route('products.confirm.delete', $product->id) }}"> Eliminar </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->render() }}
            </div>
        </div>
    </div>
</div>
@endsection
