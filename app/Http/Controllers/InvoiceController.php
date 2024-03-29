<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Invoice, Client, Product, Store};
use App\Exports\InvoiceExport;
use App\Imports\InvoiceImport;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $typeDate = $request->get('typeDate');
        $firstCreationDate = $request->get('firstCreationDate');
        $finalCreationDate = $request->get('finalCreationDate');
        $state = $request->get('state');
        $search = $request->get('search');
        $type = $request->get('type');
        $invoices = Invoice::orderBy('id', 'DESC')
            ->search($search, $type)
            ->paginate(10);
        return view('invoice.index', [
            'clients' => Client::all(),
            'stores' => Store::all()
        ], compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('invoice.create', [
            'invoice' => new invoice,
            'clients' => Client::all(),
            'stores' => Store::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'description' => 'required',
            'code' => 'required|unique:invoices',
            'client_id' => 'required',
            'Store_id' => 'required',
        ]);

        $invoice = new Invoice();
        $invoice->description = $validData['description'];
        $invoice->code = $validData['code'];
        $invoice->client_id = $validData['client_id'];
        $invoice->store_id = $validData['Store_id'];
        $invoice->expires_at = date("Y-m-d H:i:s", strtotime($invoice->created_at . "+ 30 days"));
        $invoice->save();
        return redirect()->route('invoices.edit', $invoice->id);
    }


    /**
     * Display the specified resource.
     *
     * @param  Invoice $invoice
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Invoice $invoice)
    {
        return view('invoice.show', [
            'invoice' => $invoice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        return view('invoice.edit', [
            'invoice' => $invoice,
            'clients' => Client::all(),
            'stores' => Store::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validData = $request->validate([
            'description' => 'required',
            'code' => 'required',
            'client_id' => 'required',
            'Store_id' => 'required',
            'state' => 'required',
            'subtotal' => 'required',
            'total' => 'required',
            'vat' => 'required',
        ]);
        $invoice = Invoice::find($id);
        $invoice->description = $validData['description'];
        $invoice->code = $validData['code'];
        $invoice->client_id = $validData['client_id'];
        $invoice->store_id = $validData['Store_id'];
        $invoice->expires_at = date("Y-m-d H:i:s", strtotime($invoice->created_at . "+ 30 days"));
        if ($validData['state'] == '1') {
            $now = new \DateTime();
            $invoice->state = $now->format('Y-m-d H:i:s');
        } else {
            $invoice->state = NULL;
        }
        $invoice->subtotal = $validData['subtotal'];
        $invoice->total = $validData['total'];
        $invoice->vat = $validData['vat'];
        $invoice->save();
        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();

        return redirect('/invoices');
    }

    public function confirmDelete($id)
    {
        $invoice = Invoice::find($id);
        return view('invoice.confirmDelete', [
            'invoice' => $invoice
        ]);
    }
    public function createInvoiceProduct($id)
    {
        $invoice = Invoice::find($id);
        return view('invoiceProduct.create', [
            'invoice' => $invoice,
            'products' => Product::all(),
            'clients' => Client::all(),
            'stores' => Store::all()
        ]);
    }
    public function invoiceProductStore(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $validData = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'unit_value' => 'required',
            'subtotal' => 'required',
            'total' => 'required',
            'vat' => 'required',
        ]);
        $product = Product::find($validData['product_id']);
        $validData['unit_value'] = $product->price;
        $invoice->products()->attach($validData['product_id'], [
            'quantity' => $validData['quantity'],
            'unit_value' => $validData['unit_value'],
            'total_value' => $validData['quantity'] * $validData['unit_value']
        ]);
        $invoice->subtotal = $validData['subtotal'];
        $invoice->total = $validData['total'];
        $invoice->vat = $validData['vat'];
        $invoice->save();
        return redirect()->route('invoices.edit', $invoice->id);
    }
    public function indexImport()
    {
        return view('invoice.importInvoice');
    }

    public function importExcel(Request $request)
    {
        if ($request->file('file')) {
            $path = $request->file('file')->getRealPath();
            Excel::import(new InvoiceImport, $path);
            return redirect()->route('invoices.index')->with('message', 'Importanción de facturas exítosa');
        } else {
            return back()->withErrors("ERROR, importación fallída");
        }
    }

    public function exportExcel()
    {
        return Excel::download(new InvoiceExport, "BDfacturas.xlsx");
    }
}
