<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Barang Masuk</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.75);font-weight:700;">
      Riwayat penambahan stok (mutasi masuk)
    </p>
  </div>

  <a class="btn" href="<?php echo e(route('admin.inbounds.create')); ?>">+ Tambah Barang Masuk</a>
</div>

<?php if(session('success')): ?>
  <p style="color:#15803d;font-weight:800;margin-top:10px;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<div class="table-wrap" style="margin-top:14px;">
  <table class="table">
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Qty Masuk</th>
      <th>Tanggal</th>
      <th>Keterangan</th>
    </tr>

    <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td><?php echo e($loop->iteration); ?></td>
        <td><?php echo e($l->item?->nama_barang ?? '-'); ?></td>
        <td style="font-weight:900;color:#2e1065;"><?php echo e($l->qty_masuk); ?></td>
        <td><?php echo e($l->tanggal_masuk); ?></td>
        <td><?php echo e($l->keterangan ?? '-'); ?></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr><td colspan="5">Belum ada data barang masuk.</td></tr>
    <?php endif; ?>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/inventaris-hardware/resources/views/admin/inbounds/index.blade.php ENDPATH**/ ?>