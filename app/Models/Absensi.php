<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';
    
    protected $guarded = ['id'];

    protected $fillable = [
        'tgl',
        'user_id',
        'masuk',
        'keluar',
        'status',
        'cuti',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function izin()
    {
        return $this->belongsTo(JenisIzin::class);
    }
}
