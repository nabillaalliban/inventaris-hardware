<?php $__env->startSection('content'); ?>

<div style="display:flex;justify-content:space-between;align-items:center;">
  <div>
    <p style="margin:6px 0 0;color:rgba(76,29,149,.7);font-weight:700;">
    </p>
  </div>
</div>

<?php if(session('success')): ?>
  <p style="color:green;font-weight:800;margin-top:12px;">
    <?php echo e(session('success')); ?>

  </p>
<?php endif; ?>

<!-- 🔥 KATALOG GRID -->
<div class="catalog-grid" style="margin-top:20px;">

  <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="catalog-card">


      <div class="catalog-image">
<img src="<?php echo e(asset('storage/' . $it->foto)); ?>">
      </div>

      <!-- 📦 INFO -->
      <div class="catalog-body">
        <h3><?php echo e($it->nama_barang); ?></h3>
        <p><?php echo e($it->category?->nama_kategori ?? '-'); ?></p>

        <span style="font-size:13px;color:#6b21a8;font-weight:700;">
          Stok: <?php echo e($it->stok); ?>

        </span>

        <!-- 🛒 AKSI -->
        <form action="<?php echo e(route('user.cart.add')); ?>" method="POST" class="catalog-action">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="item_id" value="<?php echo e($it->id); ?>">

          <input
            type="number"
            name="qty"
            min="1"
            max="<?php echo e($it->stok); ?>"
            value="1"
            <?php echo e($it->stok < 1 ? 'disabled' : ''); ?>>

          <button
            type="submit"
            <?php echo e($it->stok < 1 ? 'disabled' : ''); ?>>
            + Keranjang
          </button>
        </form>

        
      </div>

    </div>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p style="margin-top:20px;color:rgba(76,29,149,.7);">
      Belum ada barang tersedia.
    </p>
  <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/items/index.blade.php ENDPATH**/ ?>