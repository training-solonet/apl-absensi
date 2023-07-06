<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    
    protected $table = 'siswa.siswa';

    protected $connection = 'mysql';

    protected $fillable = [
        'nama',
        'uid',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
