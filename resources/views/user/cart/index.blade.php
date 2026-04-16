@extends('layouts.app')
@section('content')

<style>
  .cart-page{
    display:flex;
    flex-direction:column;
    gap:20px;
    margin-top:24px;
  }

  .cart-hero{
    position:relative;
    overflow:hidden;
    border-radius:26px;
    padding:24px;
    border:1px solid rgba(167,139,250,.22);
    background:
      radial-gradient(circle at top right, rgba(196,181,253,.42), transparent 34%),
      linear-gradient(135deg, rgba(255,255,255,.98), rgba(243,232,255,.92));
    box-shadow:0 16px 34px rgba(17,24,39,.08);
  }

  .cart-hero::after{
    content:"";
    position:absolute;
    right:-36px;
    bottom:-60px;
    width:200px;
    height:200px;
    border-radius:999px;
    background:radial-gradient(circle, rgba(167,139,250,.18), rgba(167,139,250,0));
    pointer-events:none;
  }

  .cart-hero__inner{
    position:relative;
    z-index:1;
    display:grid;
    grid-template-columns:minmax(0,1.3fr) minmax(220px,.7fr);
    gap:18px;
    align-items:center;
  }

  .cart-hero__eyebrow{
    display:inline-flex;
    align-items:center;
    padding:8px 14px;
    border-radius:999px;
    border:1px solid rgba(167,139,250,.22);
    background:rgba(255,255,255,.75);
    color:#4c1d95;
    font-size:12px;
    font-weight:800;
    text-transform:uppercase;
    letter-spacing:.3px;
  }

  .cart-hero__title{
    margin:14px 0 0 0;
    color:#2e1065;
    font-size:clamp(28px,3.8vw,38px);
    font-weight:900;
    line-height:1.08;
  }

  .cart-hero__subtitle{
    margin:10px 0 0 0;
    color:rgba(76,29,149,.74);
    font-size:14px;
    line-height:1.8;
    max-width:560px;
  }

  .cart-count-card{
    padding:18px 20px;
    border-radius:22px;
    border:1px solid rgba(167,139,250,.22);
    background:rgba(255,255,255,.82);
    box-shadow:0 14px 26px rgba(76,29,149,.08);
  }

  .cart-count-card__label{
    margin:0;
    color:#4c1d95;
    font-size:13px;
    font-weight:800;
  }

  .cart-count-card__value{
    margin:8px 0 0 0;
    color:#2e1065;
    font-size:44px;
    font-weight:900;
    line-height:1;
  }

  .cart-grid{
    display:grid;
    grid-template-columns:minmax(0,1.15fr) minmax(320px,.85fr);
    gap:20px;
    align-items:start;
  }

  .cart-panel{
    background:#fff;
    border-radius:24px;
    border:1px solid rgba(167,139,250,.22);
    box-shadow:0 16px 34px rgba(17,24,39,.07);
    overflow:hidden;
  }

  .cart-panel__head{
    padding:18px 20px;
    background:linear-gradient(90deg, rgba(167,139,250,.18), rgba(196,181,253,.24));
    border-bottom:1px solid rgba(167,139,250,.14);
  }

  .cart-panel__head h3{
    margin:0;
    color:#2e1065;
    font-size:18px;
    font-weight:900;
  }

  .cart-panel__head p{
    margin:6px 0 0 0;
    color:rgba(76,29,149,.72);
    font-size:13px;
    line-height:1.6;
  }

  .cart-panel__body{
    padding:18px;
  }

  .cart-item{
    border:1px solid rgba(167,139,250,.18);
    border-radius:18px;
    padding:16px;
    background:linear-gradient(180deg, rgba(255,255,255,1), rgba(250,245,255,.92));
    box-shadow:0 10px 22px rgba(17,24,39,.04);
  }

  .cart-item + .cart-item{ margin-top:12px; }

  .cart-item__top{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:12px;
  }

  .ci-title{
    font-weight:900;
    color:#2e1065;
    font-size:16px;
  }

  .ci-sub{
    font-size:12px;
    color:rgba(76,29,149,.7);
    margin:6px 0 0 0;
    line-height:1.6;
  }

  .cart-item__qty-badge{
    padding:7px 12px;
    border-radius:999px;
    background:rgba(243,232,255,.95);
    border:1px solid rgba(167,139,250,.18);
    color:#2e1065;
    font-weight:900;
    white-space:nowrap;
  }

  .cart-item__actions{
    display:flex;
    gap:8px;
    flex-wrap:wrap;
    margin-top:14px;
  }

  .cart-item__actions form{
    display:flex;
    gap:8px;
    align-items:center;
    margin:0;
  }

  .qty{
    width:84px;
    border-radius:10px;
    border:1px solid rgba(167,139,250,.35);
    padding:8px;
    background:#fff;
  }

  .btnx{
    padding:9px 12px;
    border-radius:10px;
    background:#ede9fe;
    border:1px solid rgba(167,139,250,.4);
    font-weight:800;
    cursor:pointer;
    color:#4c1d95;
  }

  .btn-danger{
    background:rgba(239,68,68,.1);
    color:#b91c1c;
  }

  .cart-empty{
    text-align:center;
    color:rgba(76,29,149,.72);
    padding:16px 6px;
  }

  .form-box{
    border:1px solid rgba(167,139,250,.18);
    border-radius:18px;
    padding:16px;
    background:#faf5ff;
  }

  .form-box__tips{
    margin:0 0 14px 0;
    padding:12px 14px;
    border-radius:14px;
    background:rgba(255,255,255,.72);
    border:1px solid rgba(167,139,250,.16);
    color:rgba(76,29,149,.76);
    font-size:13px;
    line-height:1.6;
  }

  .form-group{
    display:flex;
    flex-direction:column;
    gap:6px;
  }

  .form-group + .form-group{
    margin-top:12px;
  }

  .form-label{
    font-size:12px;
    font-weight:800;
    color:#2e1065;
  }

  .input{
    width:100%;
    border:1px solid rgba(167,139,250,.35);
    border-radius:12px;
    padding:11px 12px;
    background:white;
    outline:none;
  }

  .input:focus{
    box-shadow:0 0 0 4px rgba(167,139,250,.18);
  }

  .drawer-foot{
    padding-top:16px;
    margin-top:16px;
    border-top:1px solid rgba(167,139,250,.16);
  }

  .btn-primary{
    width:100%;
    border:none;
    border-radius:14px;
    padding:12px;
    background:linear-gradient(90deg,#a78bfa,#c4b5fd);
    color:white;
    font-weight:900;
    cursor:pointer;
  }

  @media (max-width: 900px){
    .cart-hero__inner,
    .cart-grid{
      grid-template-columns:1fr;
    }
  }

  @media (max-width: 640px){
    .cart-item__top{
      flex-direction:column;
    }

    .cart-item__actions form{
      width:100%;
      flex-wrap:wrap;
    }
  }
</style>

<div class="cart-page">
  <section class="cart-hero">
    <div class="cart-hero__inner">
      <div>
        <div class="cart-hero__eyebrow">Keranjang Peminjaman</div>
        <h2 class="cart-hero__title">Keranjang</h2>
        <p class="cart-hero__subtitle">
          Tinjau barang yang sudah kamu pilih, atur jumlahnya, lalu lanjutkan pengajuan peminjaman dengan form yang lebih rapi.
        </p>
      </div>

      <div class="cart-count-card">
        <p class="cart-count-card__label">Total Item</p>
        <p class="cart-count-card__value">{{ $cart->items->count() }}</p>
      </div>
    </div>
  </section>

  <div class="cart-grid">
    <section class="cart-panel">
      <div class="cart-panel__head">
        <h3>Daftar Barang</h3>
        <p>Periksa item yang akan kamu ajukan sebelum melanjutkan ke form peminjaman.</p>
      </div>

      <div class="cart-panel__body">
      @forelse($cart->items as $row)
        <div class="cart-item">
          <div class="cart-item__top">
            <div>
              <div class="ci-title">{{ $row->item->nama_barang }}</div>
              <div class="ci-sub">
                Kategori: {{ $row->item->category?->nama_kategori ?? '-' }} •
                Stok: {{ $row->item->stok }}
              </div>
            </div>
            <div class="cart-item__qty-badge">Qty {{ $row->qty }}</div>
          </div>

          <div class="cart-item__actions">
            <form action="{{ route('user.cart.update',$row->id) }}" method="POST">
              @csrf @method('PUT')
              <input class="qty" type="number" name="qty" value="{{ $row->qty }}">
              <button class="btnx">Update</button>
            </form>

            <form action="{{ route('user.cart.remove',$row->id) }}" method="POST">
              @csrf @method('DELETE')
              <button class="btnx btn-danger">Hapus</button>
            </form>
          </div>
        </div>
      @empty
        <p class="cart-empty">Keranjang kosong</p>
      @endforelse
      </div>
    </section>

    <section class="cart-panel">
      <div class="cart-panel__head">
        <h3>Form Pengajuan</h3>
        <p>Lengkapi data peminjaman agar pengajuan kamu bisa diproses dengan baik.</p>
      </div>

      <div class="cart-panel__body">
        <div class="form-box">
          <p class="form-box__tips">
            Isi nama peminjam, tipe, tanggal pinjam, dan tanggal pengembalian dengan benar sebelum mengajukan.
          </p>

        <form action="{{ route('user.cart.checkout') }}" method="POST">
          @csrf

          <div class="form-group">
            <label class="form-label">Nama Peminjam</label>
            <input class="input" type="text" name="nama_peminjam" placeholder="Nama Peminjam" required>
          </div>

          <div class="form-group">
            <label class="form-label">Tipe Peminjam</label>
            <select class="input" name="tipe_peminjam" required>
              <option value="">-- Pilih Tipe --</option>
              <option value="mahasiswa">Mahasiswa</option>
              <option value="dosen">Dosen</option>
              <option value="bidang1">Bidang 1</option>
              <option value="bidang2">Bidang 2</option>
              <option value="bidang3">Bidang 3</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Tanggal Peminjaman</label>
            <input class="input" type="date" name="tanggal_pinjam" required>
          </div>

          <div class="form-group">
            <label class="form-label">Tanggal Pengembalian</label>
            <input class="input" type="date" name="due_date" required>
          </div>

          <div class="drawer-foot">
            <button class="btn-primary">Ajukan</button>
          </div>

        </form>
        </div>
      </div>
    </section>
  </div>
</div>

@endsection
