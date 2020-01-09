
@extends ('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow my-5">
                <div class="card-body p-0">
                    <div class="col-lg">
                        <div class="p-5">
                            <a class="btn btn-secondary btn-square" href="{{ route('stores.index') }}"><i class="fas fa-undo"></i> NO QUIERO ELIMINAR NADA </a>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><b>{{ __('¡CUIDADO!') }}</b></h1>
                                <span class="text-gray-900 mb-4"><h3>Podrías perder los datos ingresados definitivamente</h3>
                            </div>
                            <div class="col text-center my-3">
                                <form action="/stores/{{ $Store->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"> ELIMINAR TIENDA </button>
                                </form>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
