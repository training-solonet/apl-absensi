<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Uid;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get tanggal hari ini
        $tanggalHariIni = date('Y-m-d');

        //menghitung jumlah siswa PKL aktif
        $jumlahsiswa = Siswa::where('status', '=', 'Aktif')->count();
        //menghitung siswa PKL aktif yg hadir
        $jumlahhadir = Absensi::where('waktu_masuk', 'LIKE', $tanggalHariIni . '%')
                                                            ->whereNotNull('waktu_masuk')
                                                            ->count();
        //menghitung siswa PKL yg belum hadir
        $tidakhadir = Siswa::where('status', '=', 'Aktif')->count() -
                       Absensi::where('waktu_masuk', 'LIKE', $tanggalHariIni . '%')
                                                           ->whereNotNull('waktu_masuk')
                                                           ->count();
        //get siswa terlambat/alfa
        $siswaTerlambat = Absensi::with('siswa')
                                ->where('absen.keterangan', 'Terlambat' ,'alfa')
                                ->whereDate('absen.waktu_masuk', $tanggalHariIni)
                                ->get();
                                
        return view('dashboard.dashboard',[
                    'jumlahsiswa' => $jumlahsiswa,
                    'jumlahhadir' => $jumlahhadir,
                    'tidakhadir' => $tidakhadir,
                    'siswaTerlambat' => $siswaTerlambat
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
