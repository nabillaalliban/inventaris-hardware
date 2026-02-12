<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRequestItem extends Model {
  protected $fillable = ['loan_request_id','item_id','qty'];

  public function loan(){ return $this->belongsTo(LoanRequest::class,'loan_request_id'); }
  public function item(){ return $this->belongsTo(Item::class); }
}

