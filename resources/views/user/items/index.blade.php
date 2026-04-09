@extends('layouts.app')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Katalog Barang</h2>
    <p style="margin:6px 0 0;color:rgba(76,29,149,.7);font-weight:700;">Kelola keranjang peminjaman barangmu disini</p>
  </div>
</div>

@if(session('success'))
  <p style="color:green;font-weight:800;margin-top:12px;">{{ session('success') }}</p>
@endif

<div class="table-wrap" style="margin-top:14px;">
  <table class="table">
    <thead>
      <tr>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Stok Tersedia</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($items as $it)
        <tr>
          <td style="font-weight:800;color:#2e1065;">{{ $it->nama_barang }}</td>
          <td>{{ $it->category?->nama_kategori ?? '-' }}</td>
          <td>{{ $it->stok }}</td>
          <td>
            <form action="{{ route('user.cart.add') }}" method="POST" style="display:flex; gap:8px;">
              @csrf
              <input type="hidden" name="item_id" value="{{ $it->id }}">
              <input type="number" name="qty" min="1" max="{{ $it->stok }}" value="1" style="width: 70px; padding: 6px; border-radius: 8px; border: 1px solid rgba(167,139,250,.35);" {{ $it->stok < 1 ? 'disabled' : '' }}>
              <button type="submit" class="btnx btn-primary" style="padding: 6px 12px;" {{ $it->stok < 1 ? 'disabled' : '' }}>+ Keranjang</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="4" style="padding:18px;color:rgba(76,29,149,.7);">Belum ada barang tersedia.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
