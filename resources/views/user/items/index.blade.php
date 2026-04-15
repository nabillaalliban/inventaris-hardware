@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;">
  <div>
    <p style="margin:6px 0 0;color:rgba(76,29,149,.7);font-weight:700;">
    </p>
  </div>
</div>

@if(session('success'))
  <p style="color:green;font-weight:800;margin-top:12px;">
    {{ session('success') }}
  </p>
@endif

<!-- 🔥 KATALOG GRID -->
<div class="catalog-grid" style="margin-top:20px;">

  @forelse($items as $it)
    <div class="catalog-card">


      <div class="catalog-image">
<img src="{{ asset('storage/' . $it->foto) }}">
      </div>

      <!-- 📦 INFO -->
      <div class="catalog-body">
        <h3>{{ $it->nama_barang }}</h3>
        <p>{{ $it->category?->nama_kategori ?? '-' }}</p>

        <span style="font-size:13px;color:#6b21a8;font-weight:700;">
          Stok: {{ $it->stok }}
        </span>

        <!-- 🛒 AKSI -->
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
    <p style="margin-top:20px;color:rgba(76,29,149,.7);">
      Belum ada barang tersedia.
    </p>
  @endforelse

</div>

@endsection
