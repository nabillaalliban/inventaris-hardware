<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Daftar Barang</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.7);font-weight:700;">Admin memilih barang untuk peminjaman</p>
  </div>

  <a class="btn" href="<?php echo e(route('admin.cart.index')); ?>">🛒 Keranjang</a>
</div>

<?php if(session('success')): ?> <p style="color:green;font-weight:800;margin-top:10px;"><?php echo e(session('success')); ?></p> <?php endif; ?>
<?php if(session('error')): ?> <p style="color:#b91c1c;font-weight:800;margin-top:10px;"><?php echo e(session('error')); ?></p> <?php endif; ?>

<div style="margin-top:16px;display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;">
  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="background:white;border:1px solid rgba(167,139,250,0.25);border-radius:18px;box-shadow:0 12px 26px rgba(76,29,149,0.08);overflow:hidden;">
      <div style="height:150px;background:#f5f3ff;display:flex;align-items:center;justify-content:center;">
        <?php if($it->foto): ?>
          <img src="<?php echo e(asset('storage/'.$it->foto)); ?>" style="width:100%;height:100%;object-fit:cover;">
        <?php else: ?>
          <div style="color:rgba(76,29,149,0.6);font-weight:800;">(Tanpa Foto)</div>
        <?php endif; ?>
      </div>

      <div style="padding:14px;">
        <div style="font-weight:900;color:#2e1065;"><?php echo e($it->nama_barang); ?></div>
        <div style="margin-top:6px;color:rgba(76,29,149,0.8);font-weight:700;font-size:13px;">
          Kategori: <b><?php echo e($it->category?->nama_kategori ?? '-'); ?></b>
        </div>
        <div style="margin-top:6px;font-weight:900;color:#2e1065;">
          Stok: <span style="color:#16a34a;"><?php echo e($it->stok); ?></span>
        </div>

        <form action="<?php echo e(route('admin.cart.add')); ?>" method="POST" style="margin-top:10px;display:flex;gap:10px;">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="item_id" value="<?php echo e($it->id); ?>">
          <input type="number" name="qty" min="1" max="<?php echo e($it->stok); ?>" value="1"
                 style="width:90px;border:1px solid rgba(167,139,250,0.35);border-radius:12px;padding:10px;">
          <button class="btn" type="submit">Tambah</button>
        </form>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/admin/items/index.blade.php ENDPATH**/ ?>