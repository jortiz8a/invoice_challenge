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
                                <h1 class="h4 text-gray-900 mb-4"><b>{{ __('IMPORTAR DESDE EXCEL') }}</b></h1>
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
                                </div> <span class="text-gray-900 mb-4"><h4><b>Seleccione un archvio de Excel por favor</b></h4>
                            </div>
                            <div class="col text-center my-3">
                                <form action="{{ route('invoices.import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" id="file">
                                    <button type="submit" class="btn btn-primary"> IMPORTAR </button>
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
