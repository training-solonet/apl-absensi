<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        $nama = $request->input('nama');
        $masuk = $request->input('date_in');
        $keluar = $request->input('date_out');

        // Simpan data absensi ke database
        $absensi = new Siswa;
        $absensi->nama = $nama;
        $absensi->date_in = $masuk;
        $absensi->date_out = $keluar;
        $absensi->save();

        // Response jika data berhasil disimpan
        return response()->json(['message' => 'Data siswa berhasil disimpan'], 200);
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
