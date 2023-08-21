<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Uid extends Model
{
    use HasFactory;
    
    protected $table = 'absensi.uid';

    protected $connection = 'mysql';

    public function cji_siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }

    protected $fillable = [
        'uid',
        'id_siswa',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
