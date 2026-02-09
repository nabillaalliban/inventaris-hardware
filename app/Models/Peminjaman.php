<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'tipe_peminjam',
        'nama_peminjam',
        'inventaris_id',
        'tanggal_pinjam',
        'keterangan',
        'status',
        'tanggal_kembali',
        'keterangan_kembali',
        'user_id',
    ];

    public function inventaris()
    {
        return $this->belongsTo(\App\Models\Inventaris::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
