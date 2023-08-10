<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absen';

    protected $connection = 'mysql';
    

    protected $fillable = [
        'id',
        'id_siswa',
        'uid',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'keterangan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
}
