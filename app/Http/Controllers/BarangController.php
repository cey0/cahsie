<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('barang.index', ['items' => Barang::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'namaBarang' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ]);

        $barang = new Barang();

        $barang->nama_barang = strip_tags($request->input('namaBarang'));
        $barang->harga = strip_tags($request->input('harga'));
        $barang->stok = strip_tags($request->input('stok'));
        $barang->created_at = now();
        $barang->updated_at = now();

        $barang->save();

        return redirect()->route('barang.index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($barang)
    {
        
        return view('barang.update', ['barang' => Barang::FindOrFail($barang)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $barang)
{
    // Validate the incoming data
    $request->validate([
        'namaBarang' => 'required',
        'stok' => 'required',
        'harga' => 'required'
    ]);
    
    // Find the model by ID
    $record = Barang::findOrFail($barang);

    // Update the model with the new data
    $record->nama_barang = $request->input('namaBarang');
    $record->harga = $request->input('harga');
    $record->stok = $request->input('stok');
    $record->updated_at = now();
    
    $record->save();

    return redirect()->route('barang.index')->with('success', 'Data updated successfully.');
}

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($barang)
    {
    $model = Barang::findOrFail($barang);
    $model->delete();

    return redirect()->route('barang.index')->with('success', 'Data deleted successfully.');
    }

}
