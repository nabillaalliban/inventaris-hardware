@extends('layouts.app')

@section('content')
<h2>Data Peminjaman</h2>

<a href="{{ route('user.peminjaman.create') }}" class="btn">+ Tambah Peminjaman</a>

@if(session('success'))
    <p style="color:green;margin-top:10px;">{{ session('success') }}</p>
@endif

<div class="table-wrap">
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Tipe</th>
            <th>Barang</th>
            <th>Kategori</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
            <th>Tanggal Kembali</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_peminjam }}</td>
            <td>{{ ucfirst($item->tipe_peminjam) }}</td>
            <td>{{ $item->inventaris?->nama_perangkat ?? '-' }}</td>
            <td>{{ $item->inventaris?->category?->nama_kategori ?? '-' }}</td>
            <td>{{ $item->tanggal_pinjam }}</td>
            <td>
                <span class="badge {{ $item->status == 'dipinjam' ? 'badge-warning' : 'badge-success' }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>
            <td>{{ $item->tanggal_kembali ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" align="center">Belum ada data peminjaman</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
