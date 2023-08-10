<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Uid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'students';
    protected $fillable = ['name', 'date_in', 'date_out', 'status'];

    public function absensi(){
        return $this->hasMany(Absensi::class, 'id_siswa', 'id');
    }

    public function getStatusAttribute()
    {
        $today = Carbon::now()->format('Y-m-d');

        if ($today >= $this->date_in && $today <= $this->date_out) {
            return 'aktif';
        } else {
            return 'tidak aktif';
        }
    }

    public function uidsiswa()
    {
        parent::boot();

        static::created(function ($siswa) {
            Absensi::create([
                'id_siswa' => $siswa->id,
                // Isi kolom-kolom lainnya sesuai kebutuhan
            ]);
        });
    }

    public function uid(): HasOne
    {
        return $this->hasOne(Uid::class, 'id_siswa', 'id');
    }
}
