@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h2>Statistik Peminjaman</h2>
        <p>Ringkasan status peminjaman barang</p>
    </div>
</div>

<div class="stats-grid">

    <div class="stat-card">
        <span>Menunggu Persetujuan</span>
        <h1>{{ $pending }}</h1>
    </div>

    <div class="stat-card">
        <span>Sedang Dipinjam</span>
        <h1>{{ $active }}</h1>
    </div>

    <div class="stat-card">
        <span>Jatuh Tempo</span>
        <h1>{{ $overdue }}</h1>
    </div>

    <div class="stat-card">
        <span>Sudah Dikembalikan</span>
        <h1>{{ $returned }}</h1>
    </div>

</div>


<div class="top-items">
    <h3>Top Barang Paling Sering Dipinjam</h3>

    @forelse($topItems as $t)
        <div class="item-row">
            <span>{{ $t->item?->nama_barang ?? '-' }}</span>
            <span class="badge">{{ $t->total }} pcs</span>
        </div>
    @empty
        <p class="empty">Belum ada data.</p>
    @endforelse

</div>

@endsection
