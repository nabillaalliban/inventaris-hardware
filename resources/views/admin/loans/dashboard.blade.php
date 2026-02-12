@extends('layouts.app')

@section('content')
<h2 style="margin:0;color:#2e1065;font-weight:900;">Statistik Peminjaman</h2>
<p style="margin:6px 0 0 0;color:rgba(76,29,149,0.75);font-weight:700;">
Ringkasan status peminjaman barang
</p>

<div class="cards">
  <div class="card-stat">
    <p>Menunggu Persetujuan</p>
    <h1>{{ $pending }}</h1>
  </div>

  <div class="card-stat">
    <p>Sedang Dipinjam (Aktif)</p>
    <h1>{{ $active }}</h1>
  </div>

  <div class="card-stat">
    <p>Jatuh Tempo</p>
    <h1>{{ $overdue }}</h1>
  </div>

  <div class="card-stat">
    <p>Sudah Dikembalikan</p>
    <h1>{{ $returned }}</h1>
  </div>
</div>

<div class="mini-list">
  <h3>Top Barang Paling Sering Dipinjam</h3>

  @forelse($topItems as $t)
    <div class="row">
      <div style="font-weight:800;color:#2e1065;">
        {{ $t->item?->nama_barang ?? '-' }}
      </div>
      <div class="badge">{{ $t->total }} pcs</div>
    </div>
  @empty
    <div style="color:rgba(76,29,149,0.75);font-weight:700;">Belum ada data.</div>
  @endforelse
</div>
@endsection
