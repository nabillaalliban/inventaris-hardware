@extends('layouts.app')

@section('content')
<h2 style="margin:0;color:#2e1065;font-weight:900;">Statistik Peminjaman Saya</h2>
<p style="margin:6px 0 0 0;color:rgba(76,29,149,0.75);font-weight:700;">
Ringkasan pengembalian berdasarkan transaksi
</p>

<div class="cards" style="grid-template-columns:repeat(2,minmax(0,1fr));">
  <div class="card-stat">
    <p>Sudah Dikembalikan</p>
    <h1>{{ $returned }}</h1>
    <div style="margin-top:10px;">
      <span class="badge returned">returned</span>
    </div>
  </div>

  <div class="card-stat">
    <p>Belum Dikembalikan</p>
    <h1>{{ $notReturned }}</h1>
    <div style="margin-top:10px;display:flex;gap:8px;flex-wrap:wrap;">
      <span class="badge pending">pending</span>
      <span class="badge approved">approved</span>
    </div>
  </div>
</div>
@endsection
