<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Uid;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class UidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $hariini = Carbon::today()->format('Y-m-d');
            // $uid = $request->uid;
            $uidData = Uid::where('uid', '13c13c')->with('siswa')->first();
            Absensi::create([
                'id_siswa' => $uidData->id_siswa,
                'uid' => null,
                'tanggal' => $hariini,
               'waktu_masuk' => null,
                'waktu_keluar' => null,
                'keterangan' => 'Alpa'
            ]);
            return response()->json([
                'message' => 'Absen pagi berhasil.',
            ]);

       
        
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $uid = $request->uid;
        $uidData = Uid::where('uid', $uid)->with('cji_siswa')->first();
       
        $hariini = Carbon::today()->format('Y-m-d');
        $siswa = Siswa::all();
        $absentSiswa = [];
        
           
    
        if ($uidData) {
            $today = Carbon::now()->format('Y-m-d');
    
            // Cek apakah UID sudah melakukan absen pagi atau sore pada hari yang sama
            $absenPagiKey = 'waktu_masuk_' . $uidData->uid . '_' . $today;
            $absenSoreKey = 'waktu_keluar_' . $uidData->uid . '_' . $today;
    
            if (Session::has($absenPagiKey) && Session::has($absenSoreKey)) {
                return response()->json([
                    'message' => 'UID sudah melakukan absen pagi dan sore pada hari yang sama.',
                ]);
            }
    
            $namaSiswa = $uidData->cji_siswa->name;
            $waktuMasuk = Carbon::now();
            $batasWaktuMasuk = Carbon::create(null, null, null, 6, 00, 0);
            $batasWaktuTelat = Carbon::create(null, null, null, 9, 0, 0);
            $absenPulang = Carbon::create(null, null, null, 10, 0, 0);
            $batasAbsenPulang = Carbon::create(null, null, null, 23, 59, 59);
    
            if ($waktuMasuk->between($batasWaktuMasuk, $batasWaktuTelat)) {
                // Cek apakah sudah absen pagi sebelumnya
                if (Session::has($absenPagiKey)) {
                    return response()->json([
                        'message' => 'Anda sudah melakukan absen pagi pada hari ini.',
                    ]);
                }
    
                Session::put($absenPagiKey, true);
               
                Absensi::create([
                    'id_siswa' => $uidData->id_siswa,
                    'uid' => $uid,
                   'waktu_masuk' => $waktuMasuk,
                   'tanggal' => $today,
                    'waktu_keluar' => null,
                    'keterangan' => null
                ]);
                return response()->json([
                    'message' => 'Absen pagi berhasil.',
                ]);

            // telat
            } elseif ($waktuMasuk->between($batasWaktuTelat, $absenPulang)) {
                if (Session::has($absenPagiKey)) {
                    return response()->json([
                        'message' => 'Anda sudah melakukan absen pagi pada hari iniiii.',
                    ]);
                }
    
                Session::put($absenPagiKey, true);
                Absensi::create([
                    'id_siswa' => $uidData->id_siswa,
                    'uid' => $uid,
                    'tanggal' => $today,
                   'waktu_masuk' => $waktuMasuk,
                    'waktu_keluar' => null,
                    'keterangan' => "Terlambat"
                 ]);
                return response()->json([
                    'message' => 'Anda Terlambat.',
                ]);
            } elseif ($waktuMasuk->between($absenPulang, $batasAbsenPulang)) {
                // Cek apakah sudah absen sore sebelumnya
                if (Session::has($absenSoreKey)) {
                    return response()->json([
                        'message' => 'Anda sudah melakukan absen sore pada hari ini.',
                    ]);
                }
            
                Session::put($absenSoreKey, true);
                
                // Cek apakah data absensi pagi sudah ada
                $absenPagi = Absensi::where('id_siswa', $uidData->id_siswa)
                                ->where('waktu_masuk', '>=', $today)
                                ->where('waktu_masuk', '<=', $today . ' 23:59:59')
                                ->first();
            
                // Jika data absensi pagi sudah ada, update data absen sore
                if ($absenPagi) {
                    // Cek apakah siswa terlambat di absen pagi
                    if ($absenPagi->keterangan === 'Terlambat') {
                        $absenPagi->update([
                            'waktu_keluar' => $waktuMasuk,
                        ]);
                        return response()->json([
                            'message' => 'Anda Terlambat pada absen pagi.',
                        ]);
                    }
        
                    $absenPagi->update([
                        'waktu_keluar' => $waktuMasuk,
                        'keterangan' => "Hadir"
                    ]);
                    return response()->json([
                        'message' => 'Absen sore berhasil.',
                    ]);
                }
            
                // Jika data absensi pagi belum ada, buat record baru
                Absensi::create([
                    'id_siswa' => $uidData->id_siswa,
                    'uid' => $uid,
                    'tanggal' => $today,
                    'waktu_masuk' => $waktuMasuk,
                    'waktu_keluar' => $waktuMasuk,
                    'keterangan' => "Terlambat"
                ]);
            
                return response()->json([
                    'message' => 'Absen sore berhasil.',
                ]);
            
               
             }elseif ($waktuMasuk->between($batasAbsenPulang, $batasWaktuMasuk)) {
                  return response()->json([
                      'message' => 'Absen gagal',
                  ]);
              }
        } else {
            return response()->json([
                'message' => 'Siswa Tidak Ditemukan',
            ], 404);
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