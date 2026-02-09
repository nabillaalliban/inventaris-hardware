<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $fillable = [
        'kode',
        'nama_perangkat',
        'kondisi',
        'lokasi',
        'tanggal_masuk',
        'category_id',
        'user_id',
    ]; 


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
