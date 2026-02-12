@extends('layouts.app')

@section('content')
<div style="max-width:920px;margin:0 auto;">
  <div style="background:white;border-radius:22px;border:1px solid rgba(167,139,250,.25);box-shadow:0 18px 34px rgba(76,29,149,.10);overflow:hidden;">
    <div style="background:linear-gradient(90deg, rgba(167,139,250,.25), rgba(196,181,253,.45));padding:18px 22px;display:flex;justify-content:space-between;align-items:center;">
      <div>
        <div style="font-weight:900;color:#2e1065;font-size:18px;">Tambah Barang</div>
        <div style="margin-top:4px;color:rgba(76,29,149,.75);font-weight:700;font-size:13px;">Isi data barang untuk peminjaman</div>
      </div>
      <a class="btn" href="{{ route('user.items.index') }}">← Kembali</a>
    </div>

    <div style="padding:22px;">
      @if ($errors->any())
        <div style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.25);padding:12px 14px;border-radius:14px;margin-bottom:16px;color:#b91c1c;font-weight:700;">
          <ul style="margin:0;padding-left:18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('user.items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;">
          <div>
            <label style="font-weight:800;color:#2e1065;font-size:13px;">Nama Barang</label>
            <input name="nama_barang" value="{{ old('nama_barang') }}" class="input" placeholder="Contoh: HDMI" required>
          </div>

          <div>
            <label style="font-weight:800;color:#2e1065;font-size:13px;">Kategori</label>
            <select name="category_id" class="input" required>
              <option value="">-- Pilih Kategori --</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ? 'selected' : '' }}>
                  {{ $cat->nama_kategori }}
                </option>
              @endforeach
            </select>
          </div>

          <div>
            <label style="font-weight:800;color:#2e1065;font-size:13px;">Harga</label>
            <input type="number" min="0" name="harga" value="{{ old('harga',0) }}" class="input" required>
          </div>

          <div>
            <label style="font-weight:800;color:#2e1065;font-size:13px;">Stok</label>
            <input type="number" min="0" name="stok" value="{{ old('stok',0) }}" class="input" required>
          </div>

          <div>
            <label style="font-weight:800;color:#2e1065;font-size:13px;">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="input" required>
          </div>

          <div>
            <label style="font-weight:800;color:#2e1065;font-size:13px;">Foto (optional)</label>
            <input type="file" name="foto" class="input">
          </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:18px;">
          <a class="btn" href="{{ route('user.items.index') }}">Batal</a>
          <button class="btn" type="submit" style="background:linear-gradient(90deg,#a78bfa,#c4b5fd);color:white;border:none;">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .input{
    width:100%;
    border:1px solid rgba(167,139,250,.35);
    background:#faf5ff;
    border-radius:14px;
    padding:11px 12px;
    outline:none;
  }
  .input:focus{ box-shadow:0 0 0 4px rgba(167,139,250,.18); }
</style>
@endsection
