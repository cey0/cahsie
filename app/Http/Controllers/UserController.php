<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', ['akun' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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

            'username' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'role' => 'required',

        ]);

        $akun = new User();

        $akun->username = strip_tags($request->input('username'));
        $akun->password = strip_tags($request->input('password'));
        $akun->nama = strip_tags($request->input('nama'));
        $akun->role = strip_tags($request->input('role'));
        $akun->created_at = now();
        $akun->updated_at = now();
         // Hash the password using bcrypt before saving
        $akun->password = bcrypt($request->input('password'));

        $akun->save();

        return redirect()->route('user.index');
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
    public function edit($akun)
    {
        return view('users.update', ['akun' => User::FindOrFail($akun)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $akun)
    {
        // Validate the incoming data
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
            'nama' => 'required'
        ]);
        
        // Find the model by ID
        $record = User::findOrFail($akun);
    
        // Update the model with the new data
        $record->username = $request->input('username');
        $record->password = $request->input('password');
        $record->role = $request->input('role');
        $record->nama = $request->input('nama');
        $record->updated_at = now();
        
        
            // Update the password only if it's provided in the request
        if ($request->has('password')) {
            $record->password = bcrypt($request->input('password'));
        }

        $record->save();
    
        return redirect()->route('user.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($akun)
    {
        $data = User::FindOrFail($akun);
        $data->delete();
        return redirect()->route('user.index')->with('success', 'Data deleted successfully.');
    }
}
