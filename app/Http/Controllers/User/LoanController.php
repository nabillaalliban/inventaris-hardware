<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoanController extends Controller {
  public function index(){
    $loans = LoanRequest::with('items.item.category')
      ->where('user_id',auth()->id())
      ->latest()->get();
    return view('user.loans.index', compact('loans'));
  }

  public function stats(){
    $returned = LoanRequest::where('user_id',auth()->id())->where('status','returned')->count();
    $notReturned = LoanRequest::where('user_id',auth()->id())->whereIn('status',['pending','approved'])->count();
    return view('user.loans.stats', compact('returned','notReturned'));
  }
}

