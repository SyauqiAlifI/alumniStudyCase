<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswas;
use App\Models\jenis_kelamin;
use App\Http\Requests\siswaValidate;
use Illuminate\Support\Facades\Storage;
use File;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // query builder fucntion
        $siswas = Siswas::orderBy('created_at', 'desc')->paginate(15);

        $jenkel = jenis_kelamin::get();
        // orm eloquent function
        // $siswas2 = Siswas::all();
        // native query function
        // $siswas3 = DB::select('select * from siswas');
        return view('siswa', compact('siswas', 'jenkel'));
        // compact() is a function that can be used to parse multiple variables into a view
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
    public function store(siswaValidate $request)
    {
        // make a validation for the backend
        /* $this->validate(
            $request,
            [
                // custom error message
                'nama.required' => 'Fill up the name bruh 🗿',
                'id_jenkel.required' => 'Choose your gender or you are gay 🗿',
                'nik.required' => 'Seriously you don\'t have NIK? 🗿',
                'nik.unique' => 'This NIK is used bro... use yours 🗿',
                'jurusan.required' => 'Just fill this thing k? 🗿',
                'angkatan.required' => 'What is your graduation, 0? 🗿',
                'alamat.required' => 'Your place so i can say hi to you 🗿',
            ]
        ); */

        // to store data, using eloquent method
        $siswas = new Siswas();
        // storing data to database
        // based on database | based on html form
        $siswas->nama = $request->nama;
        $siswas->id_jenkel = $request->id_jenkel;
        $siswas->nik = $request->nik;
        $siswas->tgl_lahir = $request->tgl_lahir;
        $siswas->jurusan = $request->jurusan;
        $siswas->angkatan = $request->angkatan;
        $siswas->alamat = $request->alamat;
        // Defining the folder where the file will be stored
        $path = 'uploads/';
        // a Condition when the file is uploading
        if (File::isDirectory($path)) {
            // another condition when the file is already exist in the folder
            // Defining a variable to store the request file
            $file = $request->file('photo');
            // defining a variable for a format file name
            $fileName = time().'_'.$file->getClientOriginalName();
            // moving/storing the file to the folder
            $file->move($path, $fileName);
            // storing the file name to the database
            $siswas->photo = $fileName;
        }
        $siswas->save();
        
        // if the data has been stored successfully, create an alert
        if ($siswas) {
            return redirect()->route('siswa')->with([
                'success' => 'Data berhasil disimpan'
            ]);
        } else {
            return redirect('/siswa')->with([
                'error' => 'Data gagal disimpan'
            ]);
        }
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
    public function update(siswaValidate $request, string $id)
    {
        // edit data
        $siswas = Siswas::find($id);
        $siswas->nama = $request->nama;
        $siswas->id_jenkel = $request->id_jenkel;
        $siswas->nik = $request->nik;
        $siswas->tgl_lahir = $request->tgl_lahir;
        $siswas->jurusan = $request->jurusan;
        $siswas->angkatan = $request->angkatan;
        $siswas->alamat = $request->alamat;
        $path = 'uploads/'.$siswas->photo;
        if ($request->hasFile('photo')) {
            if (File::exists($path)) {
                File::delete($path);
            }
            // another condition when the file is already exist in the folder
            // Defining a variable to store the request file
            $file = $request->file('photo');
            // defining a variable for a format file name
            $fileName = time().'_'.$file->getClientOriginalName();
            // moving/storing the file to the folder
            $file->move('uploads/', $fileName);
            // storing the file name to the database
            $siswas->photo = $fileName;
        }
        $siswas->save();

        // if the data has been stored successfully, create an alert
        if ($siswas) {
            return redirect()->route('siswa')->with([
                'success' => 'Data berhasil diupdate'
            ]);
        } else {
            return redirect('/siswa')->with([
                'error' => 'Data gagal diupdate'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete data
        $siswas = Siswas::find($id);
        // Defining path
        $path = 'uploads/'.$siswas->photo;
        // a condition when there's file then it will also delete it
        if (File::exists($path)) {
            File::delete($path);
        }
        $siswas->delete();

        if ($siswas) {
            return redirect()->route('siswa')->with([
                'success' => 'Data berhasil dihapus'
            ]);
        } else {
            return redirect('/siswa')->with([
                'error' => 'Data gagal dihapus'
            ]);
        }
    }
    
}
