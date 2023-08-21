<?php

namespace App\Console\Commands\commands;

use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Console\Command;

class croncekabsensi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:cekabsensi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (Carbon::now()->isSunday()) {
            $this->info('Hari ini adalah hari Minggu. Tidak ada absensi yang perlu dicek.');
            return;
        }
        
        $hariini = Carbon::today()->format('Y-m-d');
        $totalsiswa = 0;
        //cek data siswa yab=ng absensi
        $absensi = Absensi::whereDate('tanggal', $hariini)
            ->select('id_siswa')
            ->pluck('id_siswa')
            ->toArray();
        // return $absensi;
        $totalsiswa++;
        //cek data siswa yang belum absensi
        $siswa = Siswa::select('id')->whereNotIn('id', $absensi)->pluck('id')->toArray();

        //    $uid = Uid::whereIn('id_siswa', $siswa)
        //         ->select('uid')
        //         ->pluck('uid')
        //         ->toArray();
        foreach ($siswa as $siswa) {

            $array = [
                'id_siswa' => $siswa,
                'uid' => null,
                'tanggal' =>  $hariini,
                'waktu_masuk' => null,
                'waktu_keluar' => null,
                'keterangan' => 'alfa'
            ];

            $result[] = $array;
        }


        Absensi::insert($result);
    }
}
