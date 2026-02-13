<?php $__env->startSection('content'); ?>

<style>
  .cart-wrap{ display:flex; justify-content:flex-end; }
  .drawer{
    width: 420px;
    max-width: 92vw;
    background:#fff;
    border-radius: 18px;
    border: 1px solid rgba(167,139,250,.25);
    box-shadow: 0 18px 40px rgba(17,24,39,.18);
    overflow:hidden;
  }
  .drawer-head{
    padding: 16px 16px;
    background: linear-gradient(90deg, rgba(167,139,250,.35), rgba(196,181,253,.55));
    display:flex; align-items:center; justify-content:space-between;
  }
  .drawer-head h2{ margin:0; font-weight:900; color:#2e1065; font-size:16px; }
  .badge{
    min-width: 34px;height:28px;padding:0 10px;border-radius:999px;
    background: rgba(167,139,250,.25);
    border:1px solid rgba(167,139,250,.35);
    display:flex;align-items:center;justify-content:center;
    font-weight:900;color:#2e1065;
  }
  .drawer-body{ padding: 14px; }
  .alert-err{
    border:1px solid rgba(239,68,68,.25);
    background: rgba(239,68,68,.08);
    color:#b91c1c;
    border-radius: 14px;
    padding:10px 12px;
    font-weight:800;
    margin-bottom:10px;
  }
  .alert-ok{
    border:1px solid rgba(34,197,94,.25);
    background: rgba(34,197,94,.08);
    color:#166534;
    border-radius: 14px;
    padding:10px 12px;
    font-weight:800;
    margin-bottom:10px;
  }

  .cart-item{
    border: 1px solid rgba(167,139,250,.22);
    border-radius: 14px;
    padding: 12px;
    background:#fff;
  }
  .cart-item + .cart-item{ margin-top:10px; }
  .ci-title{ margin:0; font-weight:900; color:#2e1065; }
  .ci-sub{ margin:4px 0 10px; font-size:12px; color:rgba(76,29,149,.7); font-weight:700; }

  .ci-actions{ display:flex; gap:8px; align-items:center; flex-wrap:wrap; }
  .qty{
    width: 86px;
    padding: 8px 10px;
    border-radius: 12px;
    border: 1px solid rgba(167,139,250,.35);
    background: #faf5ff;
    outline: none;
    font-weight:800;
    color:#2e1065;
  }

  .btnx{
    padding: 8px 12px;
    border-radius: 12px;
    border: 1px solid rgba(167,139,250,.35);
    background: rgba(167,139,250,.18);
    color:#2e1065;
    font-weight:900;
    cursor:pointer;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:8px;
  }
  .btnx:hover{ background: rgba(167,139,250,.25); }

  .btn-danger{
    border-color: rgba(239,68,68,.35);
    background: rgba(239,68,68,.10);
    color:#b91c1c;
  }
  .btn-danger:hover{ background: rgba(239,68,68,.14); }

  .drawer-foot{
    padding: 12px 14px 14px;
    border-top: 1px solid rgba(167,139,250,.18);
    display:flex;
    gap:10px;
    justify-content:space-between;
  }
  .btn-primary{
    flex:1;
    border:none;
    background: linear-gradient(90deg,#a78bfa,#c4b5fd);
    color:white;
    box-shadow: 0 12px 26px rgba(167,139,250,.35);
    justify-content:center;
  }
</style>

<div class="cart-wrap">
  <div class="drawer">
    <div class="drawer-head">
      <h2>Keranjang</h2>
      <div class="badge"><?php echo e($cart->items->count()); ?></div>
    </div>

    <div class="drawer-body">
      <?php if($errors->any()): ?>
        <div class="alert-err">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div>- <?php echo e($e); ?></div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>

      <?php if(session('success')): ?>
        <div class="alert-ok"><?php echo e(session('success')); ?></div>
      <?php endif; ?>

      <?php $__empty_1 = true; $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="cart-item">
          <p class="ci-title"><?php echo e($row->item->nama_barang); ?></p>
          <p class="ci-sub">
            Kategori: <b><?php echo e($row->item->category?->nama_kategori ?? '-'); ?></b> •
            Stok: <b><?php echo e($row->item->stok); ?></b>
          </p>

          <div class="ci-actions">
            <form action="<?php echo e(route('admin.cart.update',$row->id)); ?>" method="POST" style="display:flex;gap:8px;align-items:center;">
              <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
              <input class="qty" type="number" name="qty" min="1" max="<?php echo e($row->item->stok); ?>" value="<?php echo e($row->qty); ?>">
              <button class="btnx" type="submit">Update</button>
            </form>

            <form action="<?php echo e(route('admin.cart.remove',$row->id)); ?>" method="POST" onsubmit="return confirm('Hapus item?')">
              <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
              <button class="btnx btn-danger" type="submit">Hapus</button>
            </form>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="padding:18px;border:1px dashed rgba(167,139,250,.35);border-radius:14px;color:rgba(76,29,149,.75);font-weight:800;">
          Keranjang kosong.
        </div>
      <?php endif; ?>
    </div>

    <div class="drawer-foot">
      <a class="btnx" href="<?php echo e(route('admin.items.index')); ?>">Lanjut pilih barang</a>

      <?php if($cart->items->count()): ?>
        <form action="<?php echo e(route('admin.cart.checkout')); ?>" method="POST" style="flex:1;">
          <?php echo csrf_field(); ?>
          <button class="btnx btn-primary" type="submit">Ajukan</button>
        </form>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/admin/cart/index.blade.php ENDPATH**/ ?>