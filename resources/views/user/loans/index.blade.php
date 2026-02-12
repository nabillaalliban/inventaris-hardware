@extends('layouts.app')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Riwayat Peminjaman</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.75);font-weight:700;">
      Semua transaksi peminjaman yang kamu ajukan
    </p>
  </div>

  <a class="btn" href="{{ route('user.loans.stats') }}">📊 Statistik</a>
</div>

@if(session('success'))
  <p style="color:#15803d;font-weight:800;margin-top:10px;">{{ session('success') }}</p>
@endif

<div class="table-wrap" style="margin-top:14px;">
  <table class="table">
    <tr>
      <th>No</th>
      <th>Nama Peminjam</th>
      <th>Tipe</th>
      <th>Tgl Pinjam</th>
      <th>Jatuh Tempo</th>
      <th>Status</th>
      <th>Barang</th>
    </tr>

    @forelse($loans as $l)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $l->nama_peminjam }}</td>
        <td>{{ strtoupper($l->tipe_peminjam) }}</td>
        <td>{{ $l->tanggal_pinjam }}</td>
        <td>{{ $l->due_date ?? '-' }}</td>
        <td><span class="badge {{ $l->status }}">{{ $l->status }}</span></td>

        <td style="min-width:260px;">
          @foreach($l->items as $it)
            <div style="display:flex;justify-content:space-between;gap:10px;">
              <span>{{ $it->item?->nama_barang ?? '-' }}</span>
              <span style="font-weight:900;color:#2e1065;">x{{ $it->qty }}</span>
            </div>
          @endforeach
        </td>
      </tr>
    @empty
      <tr><td colspan="7">Belum ada data.</td></tr>
    @endforelse
  </table>
</div>
@endsection
