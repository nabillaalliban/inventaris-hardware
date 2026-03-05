@extends('layouts.app')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Barang Masuk</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.75);font-weight:700;">
      Riwayat penambahan stok (mutasi masuk)
    </p>
  </div>

  <a class="btn" href="{{ route('user.inbounds.create') }}">+ Tambah Barang Masuk</a>
</div>

@if(session('success'))
  <p style="color:#15803d;font-weight:800;margin-top:10px;">{{ session('success') }}</p>
@endif

<div class="table-wrap" style="margin-top:14px;">
  <table class="table">
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Qty Masuk</th>
      <th>Tanggal</th>
      <th>Keterangan</th>
    </tr>

    @forelse($logs as $l)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $l->item?->nama_barang ?? '-' }}</td>
        <td style="font-weight:900;color:#2e1065;">{{ $l->qty_masuk }}</td>
        <td>{{ $l->tanggal_masuk }}</td>
        <td>{{ $l->keterangan ?? '-' }}</td>
      </tr>
    @empty
      <tr><td colspan="5">Belum ada data barang masuk.</td></tr>
    @endforelse
  </table>
</div>
@endsection
