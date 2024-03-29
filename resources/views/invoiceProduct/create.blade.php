@extends ('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow my-5">
                    <div class="card-body p-0">
                        <div class="col-lg">
                            <div class="p-5">
                                <a class="btn btn-secondary btn-square" href="/invoices/{{ $invoice->id }}"><i class="fas fa-undo"> VOLVER </i></a>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><b>{{ __('AÑADIR PRODUCTOS') }}</b></h1>
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
                                <form action="/invoices/{{ $invoice->id }}/invoice_product" method="POST">
                                    @csrf
                                    <b>
                                    <div class="form-group col-4">
                                        <input type="hidden" readonly="readonly" class="form-control hidden" id="invoice_id" name="invoice_id" placeholder="0" value="{{ $invoice->id }}">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="quantity">Cantidad </label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Agregue la Cantidad" value="{{ old('quantity') }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="product">Producto </label>
                                            <select name="product_id" id="product_id" class="form-control @error('product') is-invalid @enderror">
                                                @foreach($products as $product)
                                                    <option value='{{ $product->id }}'> {{'CÓDIGO ' . $product->code . ' - ' . $product->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="unit_value" name="unit_value" value="0">
                                    <input type="hidden" class="form-control" id="subtotal" name="subtotal" value="{{ $invoice->subtotal }}">
                                    <input type="hidden" class="form-control" id="total" name="total" value="{{ $invoice->total }}">
                                    <input type="hidden" class="form-control" id="vat" name="vat" value="{{ $invoice->vat }}">

                                    <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary"> GUARDAR </button>
                                    </b>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
