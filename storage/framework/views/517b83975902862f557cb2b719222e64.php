<?php $__env->startSection('content'); ?>

<style>
.cart-wrap{
  display:flex;
  justify-content:center; /* tengah horizontal */
  margin-top:40px;        /* turun sedikit */
}

.drawer{
  width:100%;
  max-width:820px;
  background:#fff;
  border-radius:20px;
  border:1px solid rgba(167,139,250,.25);
  box-shadow:0 18px 40px rgba(17,24,39,.18);
  overflow:hidden;
}

.drawer-head{
  padding:16px 18px;
  background:linear-gradient(90deg, rgba(167,139,250,.35), rgba(196,181,253,.55));
  display:flex; justify-content:space-between; align-items:center;
}

.drawer-head h2{
  margin:0;
  font-weight:900;
  color:#2e1065;
}

.badge{
  padding:6px 12px;
  border-radius:999px;
  background:rgba(167,139,250,.25);
  font-weight:900;
  color:#2e1065;
}

.drawer-body{ padding:16px; }

.cart-item{
  border:1px solid rgba(167,139,250,.22);
  border-radius:16px;
  padding:14px;
  background:#fff;
}

.cart-item + .cart-item{ margin-top:10px; }

.ci-title{
  font-weight:900;
  color:#2e1065;
}

.ci-sub{
  font-size:12px;
  color:rgba(76,29,149,.7);
  margin:4px 0 10px;
}

.qty{
  width:80px;
  border-radius:10px;
  border:1px solid rgba(167,139,250,.35);
  padding:6px;
}

.btnx{
  padding:8px 12px;
  border-radius:10px;
  background:#ede9fe;
  border:1px solid rgba(167,139,250,.4);
  font-weight:800;
  cursor:pointer;
}

.btn-danger{
  background:rgba(239,68,68,.1);
  color:#b91c1c;
}

.form-box{
  border:1px solid rgba(167,139,250,.25);
  border-radius:16px;
  padding:14px;
  background:#faf5ff;
}

.input{
  width:100%;
  border:1px solid rgba(167,139,250,.35);
  border-radius:12px;
  padding:10px;
  margin-top:6px;
  background:white;
}

.drawer-foot{
  padding:16px;
  border-top:1px solid rgba(167,139,250,.2);
}

.btn-primary{
  width:100%;
  border:none;
  border-radius:14px;
  padding:12px;
  background:linear-gradient(90deg,#a78bfa,#c4b5fd);
  color:white;
  font-weight:900;
}
</style>

<div class="cart-wrap">
  <div class="drawer">

    <!-- HEADER -->
    <div class="drawer-head">
      <h2>Keranjang</h2>
      <div class="badge"><?php echo e($cart->items->count()); ?></div>
    </div>

    <!-- BODY -->
    <div class="drawer-body">

      <?php $__empty_1 = true; $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="cart-item">
          <div class="ci-title"><?php echo e($row->item->nama_barang); ?></div>
          <div class="ci-sub">
            Kategori: <?php echo e($row->item->category?->nama_kategori ?? '-'); ?> •
            Stok: <?php echo e($row->item->stok); ?>

          </div>

          <div style="display:flex;gap:8px;">
            <form action="<?php echo e(route('user.cart.update',$row->id)); ?>" method="POST">
              <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
              <input class="qty" type="number" name="qty" value="<?php echo e($row->qty); ?>">
              <button class="btnx">Update</button>
            </form>

            <form action="<?php echo e(route('user.cart.remove',$row->id)); ?>" method="POST">
              <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
              <button class="btnx btn-danger">Hapus</button>
            </form>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>Keranjang kosong</p>
      <?php endif; ?>

      <!-- FORM PINJAM -->
      <div class="form-box" style="margin-top:16px;">
        <form action="<?php echo e(route('user.cart.checkout')); ?>" method="POST">
          <?php echo csrf_field(); ?>

          <input class="input" type="text" name="nama_peminjam" placeholder="Nama Peminjam" required>

          <select class="input" name="tipe_peminjam" required>
            <option value="">-- Pilih Tipe --</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="dosen">Dosen</option>
            <option value="bidang1">Bidang 1</option>
            <option value="bidang2">Bidang 2</option>
            <option value="bidang3">Bidang 3</option>
          </select>

          <label style="font-size:12px;font-weight:700;margin-top:10px;display:block;">Tanggal Peminjaman</label>
          <input class="input" type="date" name="tanggal_pinjam" required>

          <label style="font-size:12px;font-weight:700;margin-top:10px;display:block;">Tanggal Pengembalian</label>
          <input class="input" type="date" name="due_date" required>

          <div class="drawer-foot">
            <button class="btn-primary">Ajukan</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/cart/index.blade.php ENDPATH**/ ?>