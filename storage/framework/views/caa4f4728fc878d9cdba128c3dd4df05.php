<?php $__env->startSection('content'); ?>

<div style="max-width:820px;margin:40px auto;">

  <div style="background:white;border-radius:22px;border:1px solid rgba(167,139,250,.25);box-shadow:0 18px 34px rgba(76,29,149,.10);overflow:hidden;">

    <!-- HEADER -->
    <div style="background:linear-gradient(90deg, rgba(167,139,250,.25), rgba(196,181,253,.45));padding:18px 22px;display:flex;justify-content:space-between;align-items:center;">

      <div>
        <div style="font-weight:900;color:#2e1065;font-size:18px;">
          Tambah Barang Masuk
        </div>
        <div style="margin-top:4px;color:rgba(76,29,149,.75);font-weight:700;font-size:13px;">
          Pilih barang dan masukkan stok masuk
        </div>
      </div>

      <a class="btn" href="<?php echo e(route('admin.inbounds.index')); ?>">← Kembali</a>
    </div>

    <!-- BODY -->
    <div style="padding:22px;">

      <?php if($errors->any()): ?>
        <div style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.25);padding:12px 14px;border-radius:14px;margin-bottom:16px;color:#b91c1c;font-weight:700;">
          <ul style="margin:0;padding-left:18px;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?php echo e(route('admin.inbounds.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;">

          <!-- NAMA BARANG -->
          <div style="grid-column:1/-1;">
            <label style="font-weight:800;color:#2e1065;font-size:13px;">Nama Barang</label>
            <select name="item_id" required
                    style="width:100%;border:1px solid rgba(167,139,250,.35);border-radius:14px;padding:12px;margin-top:6px;background:#faf5ff;">
              <option value="">-- Pilih Barang --</option>
              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($it->id); ?>"><?php echo e($it->nama_barang); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <!-- JUMLAH -->
          <div>
            <label style="font-weight:800;color:#2e1065;font-size:13px;">Jumlah Masuk</label>
            <input type="number" name="qty_masuk" min="1" required
                   style="width:100%;border:1px solid rgba(167,139,250,.35);border-radius:14px;padding:12px;margin-top:6px;background:#faf5ff;">
          </div>

          <!-- TANGGAL -->
          <div>
            <label style="font-weight:800;color:#2e1065;font-size:13px;">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" required
                   style="width:100%;border:1px solid rgba(167,139,250,.35);border-radius:14px;padding:12px;margin-top:6px;background:#faf5ff;">
          </div>

          <!-- KETERANGAN -->
          <div style="grid-column:1/-1;">
            <label style="font-weight:800;color:#2e1065;font-size:13px;">Keterangan</label>
            <textarea name="keterangan" rows="3"
                      style="width:100%;border:1px solid rgba(167,139,250,.35);border-radius:14px;padding:12px;margin-top:6px;background:#faf5ff;"></textarea>
          </div>

        </div>

        <!-- ACTION -->
        <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:18px;">
          <a class="btn" href="<?php echo e(route('admin.inbounds.index')); ?>">Batal</a>
          <button class="btn" type="submit" style="background:linear-gradient(90deg,#a78bfa,#c4b5fd);color:white;border:none;">
            Simpan
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/admin/inbounds/create.blade.php ENDPATH**/ ?>