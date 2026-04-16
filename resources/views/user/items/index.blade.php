@extends('layouts.app')

@section('content')
<style>
  .user-items-page {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .user-items-hero {
    position: relative;
    overflow: hidden;
    border-radius: 26px;
    padding: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background:
      radial-gradient(circle at top right, rgba(196,181,253,0.42), transparent 34%),
      linear-gradient(135deg, rgba(255,255,255,0.98), rgba(243,232,255,0.92));
    box-shadow: 0 16px 34px rgba(17,24,39,0.08);
  }

  .user-items-hero::after {
    content: "";
    position: absolute;
    right: -36px;
    bottom: -60px;
    width: 200px;
    height: 200px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(167,139,250,0.18), rgba(167,139,250,0));
    pointer-events: none;
  }

  .user-items-hero__inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: minmax(0, 1.3fr) minmax(220px, 0.7fr);
    gap: 18px;
    align-items: center;
  }

  .user-items-hero__eyebrow {
    display: inline-flex;
    align-items: center;
    padding: 8px 14px;
    border-radius: 999px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.75);
    color: #4c1d95;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }

  .user-items-hero__title {
    margin: 14px 0 0 0;
    color: #2e1065;
    font-size: clamp(28px, 3.8vw, 38px);
    font-weight: 900;
    line-height: 1.08;
  }

  .user-items-hero__subtitle {
    margin: 10px 0 0 0;
    color: rgba(76,29,149,0.74);
    font-size: 14px;
    line-height: 1.8;
    max-width: 560px;
  }

  .user-items-count {
    padding: 18px 20px;
    border-radius: 22px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.82);
    box-shadow: 0 14px 26px rgba(76,29,149,0.08);
  }

  .user-items-count__label {
    margin: 0;
    color: #4c1d95;
    font-size: 13px;
    font-weight: 800;
  }

  .user-items-count__value {
    margin: 8px 0 0 0;
    color: #2e1065;
    font-size: 44px;
    font-weight: 900;
    line-height: 1;
  }

  .user-items-alert {
    padding: 14px 16px;
    border-radius: 16px;
    border: 1px solid rgba(34,197,94,0.18);
    background: rgba(240,253,244,0.95);
    color: #15803d;
    font-weight: 800;
    box-shadow: 0 10px 20px rgba(21,128,61,0.06);
  }

  .user-items-search {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    padding: 16px;
    border-radius: 20px;
    border: 1px solid rgba(167,139,250,0.18);
    background: rgba(255,255,255,0.94);
    box-shadow: 0 12px 28px rgba(17,24,39,0.05);
  }

  .user-items-search__field {
    flex: 1;
    min-width: 240px;
    border: 1px solid rgba(167,139,250,0.3);
    border-radius: 14px;
    padding: 12px 14px;
    background: #fff;
    color: #2e1065;
    outline: none;
  }

  .user-items-search__field:focus {
    border-color: rgba(167,139,250,0.75);
    box-shadow: 0 0 0 4px rgba(167,139,250,0.18);
  }

  .user-items-search__btn,
  .user-items-search__reset {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 16px;
    border-radius: 14px;
    font-weight: 800;
    text-decoration: none;
    cursor: pointer;
  }

  .user-items-search__btn {
    border: 1px solid rgba(167,139,250,0.25);
    background: linear-gradient(90deg,#a78bfa,#c4b5fd);
    color: #2e1065;
    box-shadow: 0 10px 18px rgba(167,139,250,0.12);
  }

  .user-items-search__reset {
    border: 1px solid rgba(167,139,250,0.18);
    background: rgba(243,232,255,0.95);
    color: #4c1d95;
  }

  .user-items-page .catalog-grid {
    margin-top: 0;
    gap: 22px;
  }

  .user-items-page .catalog-card {
    border-radius: 22px;
    border: 1px solid rgba(167,139,250,0.18);
    background: linear-gradient(180deg, rgba(255,255,255,1), rgba(250,245,255,0.96));
    box-shadow: 0 14px 30px rgba(17,24,39,0.07);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    overflow: hidden;
  }

  .user-items-page .catalog-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 38px rgba(17,24,39,0.1);
  }

  .user-items-page .catalog-image {
    position: relative;
    height: 190px;
    background: linear-gradient(180deg, rgba(243,232,255,0.95), rgba(255,255,255,1));
  }

  .user-items-page .catalog-image::after {
    content: "";
    position: absolute;
    inset: auto 18px 12px 18px;
    height: 12px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(167,139,250,0.18), rgba(167,139,250,0));
    filter: blur(8px);
  }

  .user-items-page .catalog-image img {
    max-height: 145px;
    max-width: 82%;
    object-fit: contain;
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 10px 18px rgba(17,24,39,0.12));
  }

  .user-items-page .catalog-body {
    padding: 16px;
  }

  .user-items-page .catalog-body h3 {
    font-size: 17px;
    margin: 0;
    color: #2e1065;
    line-height: 1.3;
  }

  .user-items-page .catalog-body p {
    font-size: 13px;
    color: rgba(76,29,149,0.72);
    margin: 6px 0 0 0;
  }

  .user-item-stock {
    display: inline-flex;
    align-items: center;
    margin-top: 12px;
    padding: 7px 12px;
    border-radius: 999px;
    background: rgba(243,232,255,0.95);
    border: 1px solid rgba(167,139,250,0.18);
    font-size: 12px;
    color: #5b21b6;
    font-weight: 800;
  }

  .user-items-page .catalog-action {
    margin-top: 14px;
    align-items: stretch;
  }

  .user-items-page .catalog-action input {
    width: 72px;
    padding: 10px 8px;
    border-radius: 12px;
    border: 1px solid rgba(167,139,250,.3);
    background: #fff;
    text-align: center;
    font-weight: 700;
  }

  .user-items-page .catalog-action button {
    border-radius: 12px;
    font-weight: 800;
    background: linear-gradient(90deg,#a78bfa,#c4b5fd);
    color: #2e1065;
    border: 1px solid rgba(167,139,250,0.25);
    box-shadow: 0 10px 18px rgba(167,139,250,0.12);
  }

  .user-items-page .catalog-action button:disabled,
  .user-items-page .catalog-action input:disabled {
    background: #e5e7eb;
    color: #6b7280;
    box-shadow: none;
  }

  .user-items-empty {
    padding: 18px 0 4px 0;
    color: rgba(76,29,149,0.72);
  }

  @media (max-width: 900px) {
    .user-items-hero__inner {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="user-items-page">
  <section class="user-items-hero">
    <div class="user-items-hero__inner">
      <div>
        <div class="user-items-hero__eyebrow">Katalog Inventaris</div>
        <h2 class="user-items-hero__title">Daftar Barang</h2>
        <p class="user-items-hero__subtitle">
          Pilih barang yang tersedia, tentukan jumlah yang dibutuhkan, lalu tambahkan ke keranjang untuk diajukan.
        </p>
      </div>

      <div class="user-items-count">
        <p class="user-items-count__label">Total Barang</p>
        <p class="user-items-count__value">{{ $items->count() }}</p>
      </div>
    </div>
  </section>

  @if(session('success'))
    <div class="user-items-alert">{{ session('success') }}</div>
  @endif

  <form action="{{ route('user.items.index') }}" method="GET" class="user-items-search">
    <input
      type="text"
      name="search"
      value="{{ request('search') }}"
      class="user-items-search__field"
      placeholder="Cari nama barang...">

    <button type="submit" class="user-items-search__btn">Cari</button>

    @if(request('search'))
      <a href="{{ route('user.items.index') }}" class="user-items-search__reset">Reset</a>
    @endif
  </form>

  <div class="catalog-grid">
    @forelse($items as $it)
      <div class="catalog-card">
        <div class="catalog-image">
          <img src="{{ asset('storage/' . $it->foto) }}" alt="{{ $it->nama_barang }}">
        </div>

        <div class="catalog-body">
          <h3>{{ $it->nama_barang }}</h3>
          <p>{{ $it->category?->nama_kategori ?? '-' }}</p>

          <span class="user-item-stock">Stok: {{ $it->stok }}</span>

          <form action="{{ route('user.cart.add') }}" method="POST" class="catalog-action">
            @csrf
            <input type="hidden" name="item_id" value="{{ $it->id }}">

            <input
              type="number"
              name="qty"
              min="1"
              max="{{ $it->stok }}"
              value="1"
              {{ $it->stok < 1 ? 'disabled' : '' }}>

            <button
              type="submit"
              {{ $it->stok < 1 ? 'disabled' : '' }}>
              + Keranjang
            </button>
          </form>
        </div>
      </div>
    @empty
      <p class="user-items-empty">Belum ada barang tersedia.</p>
    @endforelse
  </div>
</div>

@endsection
