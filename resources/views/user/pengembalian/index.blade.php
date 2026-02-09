@extends('layouts.app')

@section('content')
<h2>Pengembalian Barang</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<div class="table-wrap">
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Barang</th>
            <th>Tanggal Pinjam</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_peminjam }}</td>
            <td>{{ $item->inventaris->nama_perangkat }}</td>
            <td>{{ $item->tanggal_pinjam }}</td>
            <td>
                <a href="{{ route('user.pengembalian.form', $item->id) }}" class="btn">
                    Kembalikan
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" align="center">Tidak ada barang yang sedang dipinjam</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
