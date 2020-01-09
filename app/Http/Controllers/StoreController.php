<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $type = $request->get('type');
        $stores = Store::orderBy('id', 'DESC')
            ->search($search, $type)
            ->paginate(10);
        return view('Store.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('Store.create');
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
            'name' => 'required',
            'nit' => 'required|unique:stores',
            'address' => 'required',
            'phone' => 'required',
        ]);
        $store = new Store();
        $store->name = $validData['name'];
        $store->nit = $validData['nit'];
        $store->address = $validData['address'];
        $store->phone = $validData['phone'];
        $store->save();
        return redirect()->route('stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('Store.edit', [
            'Store' => $store
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
            'name' => 'required',
            'nit' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $store = Store::findOrFail($id);
        $store->name = $validData['name'];
        $store->nit = $validData['nit'];
        $store->address = $validData['address'];
        $store->phone = $validData['phone'];
        $store->save();
        return redirect()->route('stores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return redirect()->route('stores.index');
    }

    public function confirmDelete($id)
    {
        $store = Store::findOrFail($id);
        return view('Store.confirmDelete', [
            'Store' => $store
        ]);
    }
}
