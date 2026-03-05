@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/statistik.css') }}">

<div class="page-header">
    <h2>Statistik Peminjaman Saya</h2>
    <p>Ringkasan pengembalian berdasarkan transaksi</p>
</div>

<div class="stats-grid">

    <div class="stat-card">
        <span>Sudah Dikembalikan</span>
        <h1>{{ $returned }}</h1>
    </div>

    <div class="stat-card">
        <span>Belum Dikembalikan</span>
        <h1>{{ $notReturned }}</h1>
    </div>

</div>

@endsection
