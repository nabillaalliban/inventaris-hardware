@extends('layouts.app')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:16px;">
  <h2 style="margin:0;color:#2e1065;font-weight:900;">Peminjaman</h2>
  <a class="btn" href="{{ route('user.peminjaman.create') }}">+ Tambah Peminjaman</a>
</div>

@if(session('success'))
  <p style="color:#15803d;font-weight:700;margin:0 0 10px 0;">{{ session('success') }}</p>
@endif

<div class="table-wrap">
  <table class="table">
    <tr>
      <th>No</th>
      <th>Tipe</th>
      <th>Nama Peminjam</th>
      <th>Barang</th>
      <th>Kategori</th>
      <th>Tgl Pinjam</th>
      <th>Status</th>
      <th>Tgl Kembali</th>
    </tr>

    @forelse($data as $p)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ strtoupper($p->tipe_peminjam) }}</td>
        <td>{{ $p->nama_peminjam }}</td>
        <td>{{ $p->inventaris?->nama_perangkat ?? '-' }}</td>
        <td>{{ $p->inventaris?->category?->nama_kategori ?? '-' }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td style="font-weight:800;color:#2e1065;">
          {{ $p->status }}
        </td>
        <td>{{ $p->tanggal_kembali ?? '-' }}</td>
      </tr>
    @empty
      <tr><td colspan="8">Belum ada data peminjaman.</td></tr>
    @endforelse
  </table>
</div>
@endsection
