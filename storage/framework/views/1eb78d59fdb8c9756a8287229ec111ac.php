<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Tambah Barang Masuk</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.75);font-weight:700;">
      Pilih barang dari daftar, lalu masukkan jumlah stok yang masuk
    </p>
  </div>
  <a class="btn" href="<?php echo e(route('user.inbounds.index')); ?>">← Kembali</a>
</div>

<?php if($errors->any()): ?>
  <div style="margin-top:10px;color:#b91c1c;font-weight:900;">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div>- <?php echo e($e); ?></div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php endif; ?>

<form action="<?php echo e(route('user.inbounds.store')); ?>" method="POST"
      style="max-width:780px;margin-top:16px;">
  <?php echo csrf_field(); ?>

  <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;">
    <div style="grid-column:1/-1;">
      <label style="font-weight:900;color:#2e1065;">Nama Barang</label>
      <select name="item_id" required
              style="width:100%;border:1px solid rgba(167,139,250,0.35);border-radius:14px;padding:12px;margin-top:6px;">
        <option value="">-- Pilih Barang --</option>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($it->id); ?>"><?php echo e($it->nama_barang); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>

    <div>
      <label style="font-weight:900;color:#2e1065;">Jumlah Masuk</label>
      <input type="number" name="qty_masuk" min="1" required
             style="width:100%;border:1px solid rgba(167,139,250,0.35);border-radius:14px;padding:12px;margin-top:6px;">
    </div>

    <div>
      <label style="font-weight:900;color:#2e1065;">Tanggal Masuk</label>
      <input type="date" name="tanggal_masuk" required
             style="width:100%;border:1px solid rgba(167,139,250,0.35);border-radius:14px;padding:12px;margin-top:6px;">
    </div>

    <div style="grid-column:1/-1;">
      <label style="font-weight:900;color:#2e1065;">Keterangan</label>
      <textarea name="keterangan" rows="3"
                style="width:100%;border:1px solid rgba(167,139,250,0.35);border-radius:14px;padding:12px;margin-top:6px;"></textarea>
    </div>
  </div>

  <div style="margin-top:14px;display:flex;gap:10px;align-items:center;">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn" href="<?php echo e(route('user.inbounds.index')); ?>">Batal</a>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/inbounds/create.blade.php ENDPATH**/ ?>