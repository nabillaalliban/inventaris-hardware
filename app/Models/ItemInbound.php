<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInbound extends Model {
  protected $fillable = ['item_id','qty_masuk','tanggal_masuk','keterangan','user_id'];

  public function item(){ return $this->belongsTo(Item::class); }
  public function user(){ return $this->belongsTo(User::class); }
}

