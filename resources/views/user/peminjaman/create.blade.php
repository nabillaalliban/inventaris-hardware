@extends('layouts.app')

@section('content')
<h2>Tambah Peminjaman</h2>

@if ($errors->any())
  <div style="color:red;">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('user.peminjaman.store') }}" method="POST">
@csrf

<label>Tipe Peminjam</label><br>
<select name="tipe_peminjam" required>
    <option value="">-- Pilih --</option>
    <option value="mahasiswa">Mahasiswa</option>
    <option value="dosen">Dosen</option>
    <option value="bidang1">Bidang 1</option>
    <option value="bidang2">Bidang 2</option>
    <option value="bidang3">Bidang 3</option>
</select><br><br>

<label>Nama Peminjam</label><br>
<input type="text" name="nama_peminjam" required><br><br>

<label>Nama Barang</label><br>
<input type="text"
       id="nama_barang"
       placeholder="Klik pilih barang"
       readonly
       required>
<input type="hidden" name="inventaris_id" id="inventaris_id">
<br><br>

<!-- daftar barang -->
<div style="border:1px solid #ddd;padding:10px;border-radius:8px;">
    <strong>Pilih Barang:</strong>
    <ul style="list-style:none;padding-left:0;">
        @foreach($inventaris as $i)
            <li style="margin:6px 0;">
                <button type="button"
                    onclick="
                      document.getElementById('nama_barang').value='{{ $i->nama_perangkat }}';
                      document.getElementById('inventaris_id').value='{{ $i->id }}';
                    "
                    class="btn">
                    {{ $i->nama_perangkat }}
                    ({{ $i->category->nama_kategori ?? '-' }})
                </button>
            </li>
        @endforeach
    </ul>
</div>

<br>

<label>Tanggal Pinjam</label><br>
<input type="date" name="tanggal_pinjam" required><br><br>

<label>Keterangan</label><br>
<textarea name="keterangan"></textarea><br><br>

<button type="submit" class="btn">Simpan</button>
<a href="{{ route('user.peminjaman.index') }}" class="btn btn-danger">Batal</a>

</form>
@endsection
