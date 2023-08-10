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
        
        $jumlahhadir = DB::connection('mysql')->table('absen')->whereDate('waktu_masuk', '=', now())
                                                                                                    ->whereNotNull('waktu_masuk')
                                                                                                    ->get();
                                                                                                    // ->count();
                                                                                                    return response()->json($jumlahhadir);
        $today = now()->toDateString();
        $siswaTerlambat = Absensi::join('students', 'absen.id_siswa', '=', 'students.id')
                                ->select('students.name', 'absen.waktu_masuk')
                                ->where('absen.keterangan', 'Terlambat')
                                ->whereDate('absen.waktu_masuk', $today)
                                ->get();
        return $siswaTerlambat;
                                                                                            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Hellow";
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

    public function tes(){
        return "hallo";
    }
    public function store2(Request $request)
    {
        $uid = $request->uid;
        $siswa= DB::connection('mysql','mysql2')->table('uid') ->where('uid', $uid)->pluck('id_siswa');

        // return response()->json($siswa);
        return $siswa;
    }

    public function laporan(){
        $today = Carbon::today();
        $dayOfWeek = $today->format('N'); // Mendapatkan hari dalam bentuk angka (1 untuk Senin, 2 untuk Selasa, dan seterusnya)

        // Jika hari ini bukan hari Senin (1), maka geser tanggal ke hari Senin terdekat
        if ($dayOfWeek != 1) {
            $daysUntilMonday = 1 - $dayOfWeek;
            $today->modify("$daysUntilMonday days");
        }

        // Mendapatkan tanggal hari Senin
        $tanggal = $today->format('Y-m-d');

        // Mengisi tanggal untuk kolom header pada tabel
        $dates = array();
        for ($i = 0; $i < 6; $i++) {
            $dates[] = $today->format('Y-m-d');
            $today->modify('+1 day');
        }
        // return $dates;
        // $dates2 = array();
        // for ($i = 0; $i < 7; $i++) {
        //     $dates[] = $today->format('Y-m-d');
        //     $today->modify('+1 day');
        // }

        // $dates2 = array();
        // for ($i = 0; $i < 7; $i++) {
        //     $dates[] = $today->format('Y-m-d');
        //     $today->modify('+1 day');
        // }

        // return count($dates);

        // Ambil data absensi siswa dari tabel 'absensi' berdasarkan tanggal tertentu
        // $absensi = DB::connection('mysql')
        //     ->table('absen')
        //     ->select('id_siswa', 'waktu_masuk', 'waktu_keluar')
        //     ->whereDate('waktu_masuk', $tanggal)
        //     ->get();

        $namaSiswaList = Siswa::all();
                                // return $namaSiswaList;

        $today = Carbon::today()->format('Y-m-d');
        $data = Siswa::with(['absensi' => function ($query) use ($today){
            $query->where(function ($query) use ($today) {
                $query->whereDate('waktu_masuk', $today)
                    ->orWhereNull('waktu_masuk');
            })->where(function ($query) use ($today) {
                $query->whereDate('waktu_keluar', $today)
                    ->orWhereNull('waktu_keluar');
            });
        }])->get();
        // return $data;

        $senin = Carbon::now()->startOfWeek();

        $datasenin = Siswa::with(['absensi' => function ($query) use ($dates){
            $query->where('tanggal', '>=',$dates[0])
                    ->where('tanggal', '<=',$dates[5]);
        }])->get();

        

        // return $datasenin;

        return view('dashboard.laporan',[
            'date' => $dates,
            // 'date2' => $dates2,
            'absen' => $datasenin,
            // 'senin' => $datasenin,

            // 'waktu_masuk' => $absensi->waktu_masuk,
            // 'waktu_keluar' =>$absensi->pluck('waktu_keluar')->toArray(),
            'siswaList' =>$namaSiswaList,
            // 'keterangan'=>$absensi->pluck('keterangan')->toArray(),

        ]);

    }
    public function rekap(Request $request)
    {
        // $idSiswa = 101; // Ganti dengan ID siswa yang ingin difilter
        // $tanggalDari = '2023-08-02'; // Ganti dengan tanggal yang ingin difilter
        // $tanggalSampai = '2023-08-04'; // Ganti dengan tanggal yang ingin difilter
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
}
