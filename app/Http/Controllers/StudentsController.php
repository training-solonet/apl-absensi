<?php

namespace App\Http\Controllers;
// use App\Models\Siswa;
use App\Models\Students;
use App\Models\Uid;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Siswa::with('uid')
                        ->where('status', 'Aktif')
                        ->get(['id', 'name']);

        return view('dashboard.data',[
            'student' => $students,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $uid = Uid::all(); // Mengambil semua record dari tabel uid
        // $siswaAktif = Students::where('status', 'Aktif')->get();
        // // return view('students.create', compact('uids')); // Mengirim data uids ke view
        // return view('students.form',['uidList'=>$uid,'stdAktif'=>$siswaAktif]);

        $uidList = Uid::all();
        $siswaAktif = Siswa::where('status', 'Aktif')->get();
        return view('students.form', ['uidList' => $uidList, 'stdAktif' => $siswaAktif]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //     $idSiswa = $request->input('txtid');
    //     $siswa = Students::where('name', $idSiswa)
    //                     ->select('id')->first();
    //     $idS = $siswa->id;
    //     $uid = $request->input('txtuid');
    //     // Lakukan update data pada tabel uid
    //     Uid::where('uid', $uid)->update(['id_siswa' => $idS]);
    // return redirect()->route('students.index');

        $idSiswa = $request->input('txtid');
        $siswa = Siswa::where('name', $idSiswa)->select('id')->first();
        
        if ($siswa) {
            $idS = $siswa->id;
            $uid = $request->input('txtuid');
            Uid::where('uid', $uid)->update(['id_siswa' => $idS]);
            return redirect()->route('students.index')->with('success', 'UID siswa berhasil diupdate.');
        }
        
        return redirect()->route('students.index')->with('error', 'Siswa dengan nama yang diberikan tidak ditemukan.');
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
        Uid::create([
                 'name' => $request->name,
             	'uid' => $request->uid,
             ]);
             return redirect()->route('students.index')->with('success', 'Data UID Siswa berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}