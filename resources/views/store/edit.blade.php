@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-5">
                <div class="card-body p-0">
                    <div class="col-lg">
                        <div class="p-5">
                            <a class="btn btn-secondary btn-square" href="{{ route('stores.index') }}"><i class="fas fa-undo"></i> VOLVER </a>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><b>{{ __('EDITAR TIENDA') }}</b></h1>
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
                            <form action="/stores/{{ $Store->id }}" method="POST">
                                @csrf
                                @method('put')
                                <b>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name"> Nombre</label>
                                        <input type="text" value="{{ $Store->name }}" class="form-control" id="name" name="name" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nit"> NIT</label>
                                        <input type="text" value="{{ $Store->nit }}" class="form-control" id="nit" name="nit" placeholder="NIT">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name"> Dirección</label>
                                        <input type="text" value="{{ $Store->address }}" class="form-control" id="address" name="address" placeholder="Dirección">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name"> Teléfono</label>
                                        <input type="text" value="{{ $Store->phone }}" class="form-control" id="phone" name="phone" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary"> GUARDAR </button>
                                </b>
                                </div>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
