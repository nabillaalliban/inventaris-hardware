<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Riwayat Peminjaman</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.75);font-weight:700;">
      Semua transaksi peminjaman yang kamu ajukan
    </p>
  </div>

  <a class="btn" href="<?php echo e(route('user.loans.stats')); ?>">📊 Statistik</a>
</div>

<?php if(session('success')): ?>
  <p style="color:#15803d;font-weight:800;margin-top:10px;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<div class="table-wrap" style="margin-top:14px;">
  <table class="table">
    <tr>
      <th>No</th>
      <th>Nama Peminjam</th>
      <th>Tipe</th>
      <th>Tgl Pinjam</th>
      <th>Jatuh Tempo</th>
      <th>Status</th>
      <th>Barang</th>
    </tr>

    <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td><?php echo e($loop->iteration); ?></td>
        <td><?php echo e($l->nama_peminjam); ?></td>
        <td><?php echo e(strtoupper($l->tipe_peminjam)); ?></td>
        <td><?php echo e($l->tanggal_pinjam); ?></td>
        <td><?php echo e($l->due_date ?? '-'); ?></td>
        <td><span class="badge <?php echo e($l->status); ?>"><?php echo e($l->status); ?></span></td>

        <td style="min-width:260px;">
          <?php $__currentLoopData = $l->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="display:flex;justify-content:space-between;gap:10px;">
              <span><?php echo e($it->item?->nama_barang ?? '-'); ?></span>
              <span style="font-weight:900;color:#2e1065;">x<?php echo e($it->qty); ?></span>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr><td colspan="7">Belum ada data.</td></tr>
    <?php endif; ?>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/inventaris-hardware/resources/views/user/loans/index.blade.php ENDPATH**/ ?>