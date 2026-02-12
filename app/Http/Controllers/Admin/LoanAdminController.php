<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class LoanAdminController extends Controller
{
  public function dashboard()
  {
    $pending = LoanRequest::where('status','pending')->count();
    $active  = LoanRequest::where('status','approved')->count();
    $returned= LoanRequest::where('status','returned')->count();
    $overdue = LoanRequest::where('status','approved')
      ->whereNotNull('due_date')
      ->where('due_date','<',now()->toDateString())
      ->count();

    // top item sering dipinjam
    $topItems = LoanRequestItem::select('item_id', DB::raw('SUM(qty) as total'))
      ->groupBy('item_id')->orderByDesc('total')->with('item')->limit(5)->get();

    return view('admin.loans.dashboard', compact('pending','active','returned','overdue','topItems'));
  }

  public function index(Request $r)
  {
    $status = $r->get('status','pending'); // pending/approved/returned/rejected/overdue
    $q = LoanRequest::with('items.item.category','user')->latest();

    if($status === 'overdue'){
      $q->where('status','approved')
        ->whereNotNull('due_date')
        ->where('due_date','<',now()->toDateString());
    } else {
      $q->where('status',$status);
    }

    $loans = $q->get();
    return view('admin.loans.index', compact('loans','status'));
  }

  public function approve($id)
  {
    DB::transaction(function() use ($id){
      $loan = LoanRequest::with('items.item')->lockForUpdate()->findOrFail($id);
      if($loan->status !== 'pending') return;

      // cek stok cukup
      foreach($loan->items as $li){
        if($li->qty > $li->item->stok){
          throw new \Exception("Stok {$li->item->nama_barang} tidak cukup");
        }
      }

      // kurangi stok
      foreach($loan->items as $li){
        $li->item->decrement('stok', $li->qty);
      }

      $loan->update([
        'status'=>'approved',
        'approved_by'=>auth()->id(),
        'approved_at'=>now(),
      ]);
    });

    return back()->with('success','Peminjaman disetujui');
  }

  public function reject(Request $r, $id)
  {
    $loan = LoanRequest::findOrFail($id);
    if($loan->status !== 'pending') return back();
    $loan->update(['status'=>'rejected']);
    return back()->with('success','Peminjaman ditolak');
  }

  public function markReturned(Request $r, $id)
  {
    $r->validate(['tanggal_kembali'=>'required|date']);
    DB::transaction(function() use ($r,$id){
      $loan = LoanRequest::with('items.item')->lockForUpdate()->findOrFail($id);
      if($loan->status !== 'approved') return;

      // tambah stok kembali
      foreach($loan->items as $li){
        $li->item->increment('stok', $li->qty);
      }

      $loan->update([
        'status'=>'returned',
        'tanggal_kembali'=>$r->tanggal_kembali,
      ]);
    });

    return back()->with('success','Barang ditandai sudah dikembalikan');
  }
}

