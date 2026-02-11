@extends('layouts.app')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:10px;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Dashboard Admin</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.7);font-size:13px;">
      Ringkasan data inventaris secara cepat.
    </p>
  </div>
</div>

{{-- ✅ Quick Action Button --}}

<div style="display:flex; gap:10px; flex-wrap:wrap; margin: 12px 0 16px;">
  <a href="{{ route('user.inventaris.create') }}" class="btn btn-primary">➕ Tambah Barang</a>
  <a href="{{ route('user.categories.create') }}" class="btn btn-secondary">➕ Tambah Kategori</a>
  <a href="{{ route('user.peminjaman.create') }}" class="btn btn-secondary">➕ Tambah Peminjaman</a>
</div>

<div class="dash-grid">

  <div class="dash-card">
    <div class="top">
      <p class="label">Jumlah Kategori</p>
      <div class="icon">🏷️</div>
    </div>
    <div class="body">
      <p class="value">{{ $jumlahKategori }}</p>
      <p class="hint">Total kategori terdaftar</p>
    </div>
  </div>

  <div class="dash-card">
    <div class="top">
      <p class="label">Jumlah Barang (Data)</p>
      <div class="icon">📦</div>
    </div>
    <div class="body">
      <p class="value">{{ $jumlahBarang }}</p>
      <p class="hint">Total data inventaris</p>
    </div>
  </div>

  <div class="dash-card">
    <div class="top">x
      <p class="label">Kondisi Baik</p>
      <div class="icon">✅</div>
    </div>
    <div class="body">
      <p class="value">{{ $baik }}</p>
      <p class="hint">Perangkat dengan kondisi baik</p>
    </div>
  </div>

  <div class="dash-card">
    <div class="top">
      <p class="label">Kondisi Rusak</p>
      <div class="icon">⚠️</div>
    </div>
    <div class="body">
      <p class="value">{{ $rusak }}</p>
      <p class="hint">Perangkat yang perlu perhatian</p>
    </div>
  </div>

</div>

{{-- ✅ Grafik + Aktivitas Terbaru --}}
<div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-top:16px;">
  {{-- Grafik kondisi --}}
  <div class="form-shell">
    <div class="form-top">
      <div>
        <h2>Grafik Kondisi Barang</h2>
        <p>Perbandingan kondisi baik dan rusak.</p>
      </div>
    </div>
    <div class="form-body">
      <canvas id="chartKondisi" height="110"></canvas>
    </div>
  </div>

  {{-- Peminjaman terbaru --}}
  <div class="form-shell">
    <div class="form-top">
      <div>
        <h2>Peminjaman Terbaru</h2>
        <p>5 aktivitas peminjaman paling terbaru.</p>
      </div>
      <a class="btn-secondary" href="{{ route('user.peminjaman.index') }}">Lihat Semua</a>
    </div>
    <div class="form-body">
      <div class="table-wrap" style="margin-top:0;">
        <table class="table">
          <tr>
            <th>Nama</th>
            <th>Barang</th>
            <th>Status</th>
            <th>Tanggal</th>
          </tr>

          @forelse($peminjamanTerbaru as $p)
            <tr>
              <td>{{ $p->nama_peminjam ?? '-' }}</td>
              <td>{{ $p->inventaris->nama_perangkat ?? '-' }}</td>
              <td>{{ $p->status ?? 'Dipinjam' }}</td>
              <td>{{ $p->tanggal_pinjam ?? optional($p->created_at)->format('Y-m-d') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" style="color: rgba(76,29,149,0.7);">Belum ada data peminjaman.</td>
            </tr>
          @endforelse

        </table>
      </div>
    </div>
  </div>
</div>

{{-- responsive grid --}}
<style>
@media (max-width: 1000px){
  .form-shell{ width:100%; }
  div[style*="grid-template-columns: 1fr 1fr"]{ grid-template-columns: 1fr !important; }
}
</style>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const kondisiLabels = @json($chartKondisi['labels']);
  const kondisiData   = @json($chartKondisi['data']);

  const ctx = document.getElementById('chartKondisi');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: kondisiLabels,
      datasets: [{
        data: kondisiData,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });
</script>
@endsection
