@extends('layouts.app')

@section('content')
<h2>Form Pengembalian</h2>

<form action="{{ route('user.pengembalian.update', $p->id) }}" method="POST">
@csrf
@method('PUT')

<p><strong>Nama Peminjam:</strong> {{ $p->nama_peminjam }}</p>
<p><strong>Barang:</strong> {{ $p->inventaris->nama_perangkat }}</p>

<label>Tanggal Kembali</label><br>
<input type="date" name="tanggal_kembali" required><br><br>

<label>Keterangan</label><br>
<textarea name="keterangan_kembali"></textarea><br><br>

<button type="submit" class="btn">Simpan</button>
<a href="{{ route('user.pengembalian.index') }}" class="btn btn-danger">Batal</a>

</form>
@endsection
