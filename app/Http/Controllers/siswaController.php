<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswas;
use App\Models\jenis_kelamin;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // query builder fucntion
        $siswas = Siswas::get();

        $jenkel = jenis_kelamin::get();
        // orm eloquent function
        // $siswas2 = Siswas::all();
        // native query function
        // $siswas3 = DB::select('select * from siswas');
        return view('siswa', compact('siswas', 'jenkel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // to store data, using eloquent method
        $siswas = new Siswas();
        // storing data to database
        // based on database | based on html form
        $siswas->id_jenkel = $request->id_jenkel;
        $siswas->nama = $request->nama;
        $siswas->tgl_lahir = $request->tgl_lahir;
        $siswas->nik = $request->nik;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
