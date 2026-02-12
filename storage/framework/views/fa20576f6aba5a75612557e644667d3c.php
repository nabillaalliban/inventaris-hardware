<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Barang</h2>
    <p style="margin:6px 0 0;color:rgba(76,29,149,.7);font-weight:700;">Kelola data barang untuk peminjaman</p>
  </div>

  <a class="btn" href="<?php echo e(route('user.items.create')); ?>">+ Tambah Barang</a>
</div>

<?php if(session('success')): ?>
  <p style="color:green;font-weight:800;margin-top:12px;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<div class="table-wrap" style="margin-top:14px;">
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td style="font-weight:800;color:#2e1065;"><?php echo e($it->nama_barang); ?></td>
          <td><?php echo e($it->category?->nama_kategori ?? '-'); ?></td>
          <td>Rp <?php echo e(number_format($it->harga,0,',','.')); ?></td>
          <td><?php echo e($it->stok); ?></td>
          <td><?php echo e($it->tanggal); ?></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="5" style="padding:18px;color:rgba(76,29,149,.7);">Belum ada barang.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/items/index.blade.php ENDPATH**/ ?>