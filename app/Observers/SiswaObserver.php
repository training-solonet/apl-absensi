<?php

namespace App\Observers;

use App\Models\Siswa;
use App\Models\Uid;

class SiswaObserver
{
    /**
     * Handle the Siswa "created" event.
     */
    public function created(Siswa $siswa): void
    {
          // Ambil data id_siswa yang baru saja dibuat
          $idSiswa = $siswa->id;

          // Rekam data ke tabel 'uid' pada database 'absensi'
          Uid::create([
              'id_siswa' => $idSiswa,
          ]);
    }

    /**
     * Handle the Siswa "updated" event.
     */
    public function updated(Siswa $siswa): void
    {
          // Ambil data id_siswa yang baru saja dibuat
          $idSiswa = $siswa->id;

          // Rekam data ke tabel 'uid' pada database 'absensi'
          Uid::updated([
              'id_siswa' => $idSiswa,
          ]);
    }

    /**
     * Handle the Siswa "deleted" event.
     */
    public function deleted(Siswa $siswa): void
    {
          // Ambil data id_siswa yang baru saja dibuat
          $idSiswa = $siswa->id;

          // Rekam data ke tabel 'uid' pada database 'absensi'
          Uid::deleted([
              'id_siswa' => $idSiswa,
          ]);
    }

    /**
     * Handle the Siswa "restored" event.
     */
    public function restored(Siswa $siswa): void
    {
        //
    }

    /**
     * Handle the Siswa "force deleted" event.
     */
    public function forceDeleted(Siswa $siswa): void
    {
        //
    }
}
