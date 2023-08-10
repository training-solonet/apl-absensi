<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Uid;
use App\Models\Siswa;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today(); //get hari ini
        $dayOfWeek = $today->format('N'); // Mendapatkan hari dalam bentuk angka (1 untuk Senin, 2 untuk Selasa, dan seterusnya)
        // Jika hari ini bukan hari Senin (1), maka geser tanggal ke hari Senin terdekat
        if ($dayOfWeek != 1) {
            $daysUntilMonday = 1 - $dayOfWeek;
            $today->modify("$daysUntilMonday days");
        }

        $tanggal = $today->format('Y-m-d');  // Mendapatkan tanggal hari ini format Y-m-d

        // Mengisi tanggal untuk kolom header pada tabel
        $dates = array();
        for ($i = 0; $i < 6; $i++) {
            $dates[] = $today->format('Y-m-d');
            $today->modify('+1 day');
        }

        $namaSiswaList = Siswa::all(); //mengambil semua data siswa
        //mengambil data absen selama 1 minggu senin-sabtu
        $datasenin = Siswa::where('status', 'Aktif')
                            ->with(['absensi' => function ($query) use ($dates){
                        $query->where('tanggal', '>=',$dates[0])
                            ->where('tanggal', '<=',$dates[5]);
        }])->get();
        return view('dashboard.laporan',[
            'date' => $dates,
            'absen' => $datasenin,
            'siswaList' =>$namaSiswaList
        ]);

                                                                               
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|not_in:' . implode(',', (array) $request->old('nama'))
        ]);
        $nama = $request->session()->get('nama', $request->input('nama'));
        $idsiswa = Siswa::where('nama', $nama)
                        ->select('id')        
                        ->first();   
        $idA = $idsiswa->id;             
        $tanggalDari = $request->session()->get('tanggal_dari', $request->input('tanggal_dari'));
        $tanggalSampai = $request->session()->get('tanggal_sampai', $request->input('tanggal_sampai'));
        $daynow = Carbon::today()->format('Y-m-d');

        if($tanggalDari && $tanggalSampai != null){
            $filter = Absensi::where('id_siswa', $idA)
            ->whereDate('tanggal', '>=',$tanggalDari)
            ->whereDate('tanggal', '<=',$tanggalSampai)
            ->get();
        } elseif($tanggalDari == null && $tanggalSampai == null) {
            $filter = Absensi::where('id_siswa', $idA)
            ->get();
        } elseif($tanggalSampai == null) {
            $filter = Absensi::where('id_siswa', $idA)
            ->whereDate('tanggal', '>=',$tanggalDari)
            ->whereDate('tanggal', '<=',$daynow)
            ->get();
        } elseif($tanggalDari == null) {
            $filter = Absensi::where('id_siswa', $idA)
            ->whereDate('tanggal', '<=', $tanggalSampai)
            ->orderBy('tanggal', 'asc')
            ->get();
        };
        $namaSiswaList = Siswa::all();

        return view('dashboard.laporan-rekap',[
            'absensis' => $filter,
            'siswa' =>$namaSiswaList,
            'dari' =>$tanggalDari,
            'sampai' =>$tanggalSampai,
            'nama' =>$nama,
        ]);
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
