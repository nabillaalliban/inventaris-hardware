<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model {
  protected $fillable = [
  'user_id',
  'status',
  'due_date',
  'tanggal_kembali',
  'approved_by',
];


  public function user(){ return $this->belongsTo(User::class); }
  public function approver(){ return $this->belongsTo(User::class,'approved_by'); }
  public function items(){ return $this->hasMany(LoanRequestItem::class); }
}
