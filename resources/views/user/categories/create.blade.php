@extends('layouts.app')

@section('content')
<div class="form-wrap">

  <div class="form-shell">

    <div class="form-top">
      <div>
        <h2>Tambah Kategori</h2>
        <p>Buat kategori baru untuk pengelompokan inventaris.</p>
      </div>

      <a href="{{ route('user.categories.index') }}" class="btn-secondary">← Kembali</a>
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

      <form action="{{ route('user.categories.store') }}" method="POST">
        @csrf

        <div class="form-grid">
          <div class="form-group full">
            <label class="label">Nama Kategori</label>
            <input class="input"
                   type="text"
                   name="nama_kategori"
                   value="{{ old('nama_kategori') }}"
                   placeholder="Contoh: Kabel, Komputer, Aksesoris"
                   required>
          </div>
        </div>

        <div class="form-actions">
          <a href="{{ route('user.categories.index') }}" class="btn-secondary">Batal</a>
          <button type="submit" class="btn-primary">Simpan</button>
        </div>

      </form>

    </div>
  </div>

</div>
@endsection
