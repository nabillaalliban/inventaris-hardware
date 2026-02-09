@extends('layouts.app')

@section('content')
<div class="form-wrap">
  <div class="form-shell">
    <div class="form-top">
      <div>
        <h2>Tambah Peminjaman</h2>
        <p>Isi data peminjam dan pilih barang yang dipinjam.</p>
      </div>
      <a href="{{ route('user.peminjaman.index') }}" class="btn-secondary">← Kembali</a>
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

      <form action="{{ route('user.peminjaman.store') }}" method="POST">
        @csrf

        <div class="form-grid">
          <div class="form-group">
            <label class="label">Tipe Peminjam</label>
            <select class="select" name="tipe_peminjam" required>
              <option value="">-- Pilih --</option>
              <option value="mahasiswa" {{ old('tipe_peminjam')=='mahasiswa'?'selected':'' }}>Mahasiswa</option>
              <option value="dosen" {{ old('tipe_peminjam')=='dosen'?'selected':'' }}>Dosen</option>
              <option value="bidang1" {{ old('tipe_peminjam')=='bidang1'?'selected':'' }}>Bidang 1</option>
              <option value="bidang2" {{ old('tipe_peminjam')=='bidang2'?'selected':'' }}>Bidang 2</option>
              <option value="bidang3" {{ old('tipe_peminjam')=='bidang3'?'selected':'' }}>Bidang 3</option>
            </select>
          </div>

          <div class="form-group">
            <label class="label">Tanggal Pinjam</label>
            <input class="input" type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}" required>
          </div>

          <div class="form-group full">
            <label class="label">Nama Peminjam</label>
            <input class="input" type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}" required>
          </div>

          <div class="form-group full">
            <label class="label">Barang yang Dipinjam</label>
            <select class="select" name="inventaris_id" required>
              <option value="">-- Pilih Barang (yang belum dipinjam) --</option>
              @foreach($inventaris as $b)
                <option value="{{ $b->id }}" {{ old('inventaris_id')==$b->id?'selected':'' }}>
                  {{ $b->nama_perangkat }} ({{ $b->kode }}) - {{ $b->category?->nama_kategori ?? '-' }}
                </option>
              @endforeach
            </select>

            @if($inventaris->count() == 0)
              <p style="margin:8px 0 0 0;font-size:12px;color:rgba(76,29,149,0.7);">
                Tidak ada barang tersedia (semua sedang dipinjam).
              </p>
            @endif
          </div>

          <div class="form-group full">
            <label class="label">Keterangan</label>
            <textarea class="input" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
          </div>
        </div>

        <div class="form-actions">
          <a href="{{ route('user.peminjaman.index') }}" class="btn-secondary">Batal</a>
          <button type="submit" class="btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
