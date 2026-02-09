@extends('layouts.app')

@section('content')
<div class="form-wrap">

  <div class="form-shell">

    <div class="form-top">
      <div>
        <h2>Edit Data Inventaris</h2>
        <p>Perbarui data perangkat dan kategori jika diperlukan.</p>
      </div>

      <a href="{{ route('user.inventaris.index') }}" class="btn-secondary">← Kembali</a>
    </div>

    <div class="form-body">

      @if ($errors->any())
        <div class="alert">
          <strong>Gagal menyimpan:</strong>
          <ul style="margin:8px 0 0 18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('user.inventaris.update', $inventaris->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
          <div class="form-group">
            <label class="label">Kode</label>
            <input class="input" type="text" name="kode"
                   value="{{ old('kode', $inventaris->kode) }}"
                   placeholder="Contoh: 01" required>
          </div>

          <div class="form-group">
            <label class="label">Tanggal Masuk</label>
            <input class="input" type="date" name="tanggal_masuk"
                   value="{{ old('tanggal_masuk', $inventaris->tanggal_masuk) }}"
                   required>
          </div>

          <div class="form-group full">
            <label class="label">Nama Perangkat</label>
            <input class="input" type="text" name="nama_perangkat"
                   value="{{ old('nama_perangkat', $inventaris->nama_perangkat) }}"
                   placeholder="Contoh: Komputer" required>
          </div>

          <div class="form-group">
            <label class="label">Lokasi</label>
            <input class="input" type="text" name="lokasi"
                   value="{{ old('lokasi', $inventaris->lokasi) }}"
                   placeholder="Contoh: Lab 201" required>
          </div>

          <div class="form-group">
            <label class="label">Kondisi</label>
            <select class="select" name="kondisi" required>
              <option value="">-- Pilih Kondisi --</option>
              <option value="Baik" {{ old('kondisi', $inventaris->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
              <option value="Rusak" {{ old('kondisi', $inventaris->kondisi) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
          </div>

          <div class="form-group full">
            <label class="label">Kategori</label>
            <select class="select" name="category_id" required>
              <option value="">-- Pilih Kategori --</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                  {{ old('category_id', $inventaris->category_id) == $cat->id ? 'selected' : '' }}>
                  {{ $cat->nama_kategori }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-actions">
          <a href="{{ route('user.inventaris.index') }}" class="btn-secondary">Batal</a>
          <button type="submit" class="btn-primary">Update</button>
        </div>

      </form>

    </div>
  </div>

</div>
@endsection
