<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
protected $fillable = [
  'nama_barang','category_id','harga','stok','tanggal','foto','user_id'
];

public function category()
{
  return $this->belongsTo(Category::class);
}

}
