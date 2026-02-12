@extends('layouts.app')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Barang</h2>
    <p style="margin:6px 0 0;color:rgba(76,29,149,.7);font-weight:700;">Kelola data barang untuk peminjaman</p>
  </div>

  <a class="btn" href="{{ route('user.items.create') }}">+ Tambah Barang</a>
</div>

@if(session('success'))
  <p style="color:green;font-weight:800;margin-top:12px;">{{ session('success') }}</p>
@endif

<div class="table-wrap" style="margin-top:14px;">
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      @forelse($items as $it)
        <tr>
          <td style="font-weight:800;color:#2e1065;">{{ $it->nama_barang }}</td>
          <td>{{ $it->category?->nama_kategori ?? '-' }}</td>
          <td>Rp {{ number_format($it->harga,0,',','.') }}</td>
          <td>{{ $it->stok }}</td>
          <td>{{ $it->tanggal }}</td>
        </tr>
      @empty
        <tr><td colspan="5" style="padding:18px;color:rgba(76,29,149,.7);">Belum ada barang.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
