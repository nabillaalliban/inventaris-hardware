<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:10px;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Dashboard Admin</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.7);font-size:13px;">
      Ringkasan data inventaris secara cepat.
    </p>
  </div>
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
    <div class="top">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\inventaris-hardware\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>