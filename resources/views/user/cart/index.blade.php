@extends('layouts.app')
@section('content')
<h2 style="margin:0;color:#2e1065;font-weight:900;">Keranjang</h2>

@if ($errors->any())
  <div style="color:#b91c1c;font-weight:700;margin-top:10px;">
    @foreach($errors->all() as $e) <div>- {{ $e }}</div> @endforeach
  </div>
@endif
@if(session('success')) <p style="color:#15803d;font-weight:700">{{ session('success') }}</p> @endif

<div class="table-wrap">
  <table class="table">
    <tr><th>Barang</th><th>Kategori</th><th>Qty</th><th>Aksi</th></tr>
    @forelse($cart->items as $row)
      <tr>
        <td>{{ $row->item->nama_barang }}</td>
        <td>{{ $row->item->category?->nama_kategori }}</td>
        <td>
          <form action="{{ route('user.cart.update',$row->id) }}" method="POST" style="display:flex;gap:8px;align-items:center;">
            @csrf @method('PUT')
            <input type="number" name="qty" min="1" value="{{ $row->qty }}" style="width:80px;border:1px solid #ddd;border-radius:10px;padding:6px 8px;">
            <button class="btn" type="submit">Update</button>
          </form>
        </td>
        <td>
          <form action="{{ route('user.cart.remove',$row->id) }}" method="POST" onsubmit="return confirm('Hapus item?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger" type="submit">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="4">Keranjang kosong.</td></tr>
    @endforelse
  </table>
</div>

<br>

<h3 style="color:#2e1065;margin:0 0 10px 0;">Ajukan Peminjaman</h3>
<form action="{{ route('user.cart.checkout') }}" method="POST">
@csrf
<div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;max-width:820px;">
  <div>
    <label>Tipe Peminjam</label>
    <select name="tipe_peminjam" required style="width:100%;border:1px solid #ddd;border-radius:12px;padding:10px;">
      <option value="">-- Pilih --</option>
      <option value="mahasiswa">Mahasiswa</option>
      <option value="dosen">Dosen</option>
      <option value="bidang1">Bidang 1</option>
      <option value="bidang2">Bidang 2</option>
      <option value="bidang3">Bidang 3</option>
    </select>
  </div>
  <div>
    <label>Nama Peminjam</label>
    <input name="nama_peminjam" required style="width:100%;border:1px solid #ddd;border-radius:12px;padding:10px;">
  </div>
  <div>
    <label>Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" required style="width:100%;border:1px solid #ddd;border-radius:12px;padding:10px;">
  </div>
  <div>
    <label>Jatuh Tempo</label>
    <input type="date" name="due_date" style="width:100%;border:1px solid #ddd;border-radius:12px;padding:10px;">
  </div>
  <div style="grid-column:1/-1;">
    <label>Catatan</label>
    <textarea name="catatan" rows="3" style="width:100%;border:1px solid #ddd;border-radius:12px;padding:10px;"></textarea>
  </div>
</div>
<br>
<button class="btn" type="submit">Kirim Pengajuan</button>
</form>
@endsection
