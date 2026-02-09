@extends('layouts.app')

@section('content')
<div class="form-wrap">
  <div class="form-shell">

    <div class="form-top">
      <div>
        <h2>Proses Pengembalian</h2>
        <p>Isi tanggal kembali dan keterangan.</p>
      </div>
      <a href="{{ route('user.pengembalian.index') }}" class="btn-secondary">← Kembali</a>
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

      <div style="margin-bottom:12px;color:rgba(76,29,149,0.8);font-size:13px;">
        <strong>Barang:</strong> {{ $p->inventaris?->nama_perangkat }} ({{ $p->inventaris?->kode }})<br>
        <strong>Kategori:</strong> {{ $p->inventaris?->category?->nama_kategori ?? '-' }}<br>
        <strong>Peminjam:</strong> {{ $p->nama_peminjam }} ({{ strtoupper($p->tipe_peminjam) }})<br>
        <strong>Tanggal Pinjam:</strong> {{ $p->tanggal_pinjam }}
      </div>

      <form action="{{ route('user.pengembalian.update', $p->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
          <div class="form-group">
            <label class="label">Tanggal Kembali</label>
            <input class="input" type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required>
          </div>

          <div class="form-group full">
            <label class="label">Keterangan Pengembalian</label>
            <textarea class="input" name="keterangan_kembali" rows="3">{{ old('keterangan_kembali') }}</textarea>
          </div>
        </div>

        <div class="form-actions">
          <a href="{{ route('user.pengembalian.index') }}" class="btn-secondary">Batal</a>
          <button type="submit" class="btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
