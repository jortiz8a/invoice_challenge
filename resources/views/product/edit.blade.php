@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-5">
                <div class="card-body p-0">
                    <div class="col-lg">
                        <div class="p-5">
                            <a class="btn btn-secondary btn-square" href="{{ route('products.index') }}"><i class="fas fa-undo"></i> VOLVER </a>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><b>{{ __('EDITAR PRODUCTO') }}<b/></h1>
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
                            <form action="/products/{{ $product->id }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label> Nombre: </label>
                                        <input type="text" value="{{ $product->name }}" class="form-control" id="name" name="name" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">Código:</label>
                                        <input type="text" value="{{ $product->code }}" class="form-control" id="code" name="code" placeholder="Código">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Precio:</label>
                                    <input type="text" value="{{ $product->price }}" class="form-control" id="price" name="price" placeholder="Introducir Valor">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary"> GUARDAR </button>
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
