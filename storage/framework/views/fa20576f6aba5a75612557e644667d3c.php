<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Katalog Barang</h2>
    <p style="margin:6px 0 0;color:rgba(76,29,149,.7);font-weight:700;">Kelola keranjang peminjaman barangmu disini</p>
  </div>
</div>

<?php if(session('success')): ?>
  <p style="color:green;font-weight:800;margin-top:12px;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<div class="table-wrap" style="margin-top:14px;">
  <table class="table">
    <thead>
      <tr>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Stok Tersedia</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td style="font-weight:800;color:#2e1065;"><?php echo e($it->nama_barang); ?></td>
          <td><?php echo e($it->category?->nama_kategori ?? '-'); ?></td>
          <td><?php echo e($it->stok); ?></td>
          <td>
            <form action="<?php echo e(route('user.cart.add')); ?>" method="POST" style="display:flex; gap:8px;">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="item_id" value="<?php echo e($it->id); ?>">
              <input type="number" name="qty" min="1" max="<?php echo e($it->stok); ?>" value="1" style="width: 70px; padding: 6px; border-radius: 8px; border: 1px solid rgba(167,139,250,.35);" <?php echo e($it->stok < 1 ? 'disabled' : ''); ?>>
              <button type="submit" class="btnx btn-primary" style="padding: 6px 12px;" <?php echo e($it->stok < 1 ? 'disabled' : ''); ?>>+ Keranjang</button>
            </form>
          </td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="4" style="padding:18px;color:rgba(76,29,149,.7);">Belum ada barang tersedia.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/items/index.blade.php ENDPATH**/ ?>