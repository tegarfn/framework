<?php

namespace App\Http\Controllers;

use App\Models\user;
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
        $users = user::latest()->paginate(5);

        return view('user.index', compact('users'))
        ->with('1',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'nama' => 'required',
            'email' => 'required',
            'lokasi' => 'required',
            'model' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'jumlah' => 'required'
        ]);
        user::create($request->all());

        return redirect()->rooute('user.index')->with('success', 'Berhasil Dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'lokasi' => 'required',
            'model' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'jumlah' => 'required'
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success','Berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        return redirect()->route('user.index')->with('success','berhasil dihapus!');
    }
}
