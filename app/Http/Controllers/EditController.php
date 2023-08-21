<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Uid;

class EditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $name)
    {
        $student = Siswa::with('uid')
                        ->where('name', $name)
                        ->first();

        $uid = Uid::where('id_siswa', NULL)
                    ->get();
        
        return view('dashboard.form',[
                    'student' => $student,
                    'uid' => $uid,
                    ]);
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
        $idSiswa = $request->input('txtid');
        $siswa = Siswa::where('name', $idSiswa)->select('id')->first();
        $idS = $siswa->id;
        $uid = $request->input('txtuid');
        Uid::where('uid', $uid)->update(['id_siswa' => $idS]);

         return redirect()->route('data.index')->with('success', 'UID siswa berhasil diupdate.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $siswa)
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
