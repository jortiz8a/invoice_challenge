<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Client, Invoice};

class ClientsController extends Controller
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
        $search = $request->get('search');
        $type = $request->get('type');
        $clients = Client::orderBy('id', 'DESC')
            ->search($search, $type)
            ->paginate(10);
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'id_type' => 'required',
            'id_number' => 'required|unique:clients',
            'email' => 'required|unique:clients',
            'address' => 'required',
            'phone' => 'required|min:10',
            'country' => 'required',
            'city' => 'required',
        ]);
        $client = new Client();
        $client->name = $validData['name'];
        $client->last_name = $validData['last_name'];
        $client->id_type = $validData['id_type'];
        $client->id_number = $validData['id_number'];
        $client->email = $validData['email'];
        $client->address = $validData['address'];
        $client->phone = ($validData['phone']);
        $client->country = $validData['country'];
        $client->city = $validData['city'];
        $client->save();
        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Client $client)
    {
        return view('client.show', [
            'invoice' => Invoice::all(),
            'client' => $client
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
        $client = Client::findOrFail($id);
        return view('client.edit', [
            'client' => $client
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required|min:10',
            'country' => 'required',
            'city' => 'required',
        ]);
        $client = Client::findOrFail($id);
        $client->name = $validData['name'];
        $client->last_name = $validData['last_name'];
        $client->id_type = $validData['id_type'];
        $client->id_number = $validData['id_number'];
        $client->email = $validData['email'];
        $client->address = $validData['address'];
        $client->phone = ($validData['phone']);
        $client->country = $validData['country'];
        $client->city = $validData['city'];
        $client->save();
        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect('/clients');
    }

    public function confirmDelete($id)
    {
        $client = Client::findOrFail($id);
        return view('client.confirmDelete', [
            'client' => $client
        ]);
    }
}
