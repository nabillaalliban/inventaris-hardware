<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:10px;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Dashboard Admin</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.7);font-size:13px;">
      Ringkasan data inventaris secara cepat.
    </p>
  </div>
</div>



<div style="display:flex; gap:10px; flex-wrap:wrap; margin: 12px 0 16px;">
  <a href="<?php echo e(route('user.inventaris.create')); ?>" class="btn btn-primary">➕ Tambah Barang</a>
  <a href="<?php echo e(route('user.categories.create')); ?>" class="btn btn-secondary">➕ Tambah Kategori</a>
  <a href="<?php echo e(route('user.peminjaman.create')); ?>" class="btn btn-secondary">➕ Tambah Peminjaman</a>
</div>

<div class="dash-grid">

  <div class="dash-card">
    <div class="top">
      <p class="label">Jumlah Kategori</p>
      <div class="icon">🏷️</div>
    </div>
    <div class="body">
      <p class="value"><?php echo e($jumlahKategori); ?></p>
      <p class="hint">Total kategori terdaftar</p>
    </div>
  </div>

  <div class="dash-card">
    <div class="top">
      <p class="label">Jumlah Barang (Data)</p>
      <div class="icon">📦</div>
    </div>
    <div class="body">
      <p class="value"><?php echo e($jumlahBarang); ?></p>
      <p class="hint">Total data inventaris</p>
    </div>
  </div>

  <div class="dash-card">
    <div class="top">x
      <p class="label">Kondisi Baik</p>
      <div class="icon">✅</div>
    </div>
    <div class="body">
      <p class="value"><?php echo e($baik); ?></p>
      <p class="hint">Perangkat dengan kondisi baik</p>
    </div>
  </div>

  <div class="dash-card">
    <div class="top">
      <p class="label">Kondisi Rusak</p>
      <div class="icon">⚠️</div>
    </div>
    <div class="body">
      <p class="value"><?php echo e($rusak); ?></p>
      <p class="hint">Perangkat yang perlu perhatian</p>
    </div>
  </div>

</div>


<div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-top:16px;">
  
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

  
  <div class="form-shell">
    <div class="form-top">
      <div>
        <h2>Peminjaman Terbaru</h2>
        <p>5 aktivitas peminjaman paling terbaru.</p>
      </div>
      <a class="btn-secondary" href="<?php echo e(route('user.peminjaman.index')); ?>">Lihat Semua</a>
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

          <?php $__empty_1 = true; $__currentLoopData = $peminjamanTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><?php echo e($p->nama_peminjam ?? '-'); ?></td>
              <td><?php echo e($p->inventaris->nama_perangkat ?? '-'); ?></td>
              <td><?php echo e($p->status ?? 'Dipinjam'); ?></td>
              <td><?php echo e($p->tanggal_pinjam ?? optional($p->created_at)->format('Y-m-d')); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="4" style="color: rgba(76,29,149,0.7);">Belum ada data peminjaman.</td>
            </tr>
          <?php endif; ?>

        </table>
      </div>
    </div>
  </div>
</div>


<style>
@media (max-width: 1000px){
  .form-shell{ width:100%; }
  div[style*="grid-template-columns: 1fr 1fr"]{ grid-template-columns: 1fr !important; }
}
</style>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const kondisiLabels = <?php echo json_encode($chartKondisi['labels'], 15, 512) ?>;
  const kondisiData   = <?php echo json_encode($chartKondisi['data'], 15, 512) ?>;

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>