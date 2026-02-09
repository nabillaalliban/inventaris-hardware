<?php $__env->startSection('content'); ?>
<div class="form-wrap">

  <div class="form-shell">

    <div class="form-top">
      <div>
        <h2>Edit Data Inventaris</h2>
        <p>Perbarui data perangkat dan kategori jika diperlukan.</p>
      </div>

      <a href="<?php echo e(route('user.inventaris.index')); ?>" class="btn-secondary">← Kembali</a>
    </div>

    <div class="form-body">

      <?php if($errors->any()): ?>
        <div class="alert">
          <strong>Gagal menyimpan:</strong>
          <ul style="margin:8px 0 0 18px;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?php echo e(route('user.inventaris.update', $inventaris->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-grid">
          <div class="form-group">
            <label class="label">Kode</label>
            <input class="input" type="text" name="kode"
                   value="<?php echo e(old('kode', $inventaris->kode)); ?>"
                   placeholder="Contoh: 01" required>
          </div>

          <div class="form-group">
            <label class="label">Tanggal Masuk</label>
            <input class="input" type="date" name="tanggal_masuk"
                   value="<?php echo e(old('tanggal_masuk', $inventaris->tanggal_masuk)); ?>"
                   required>
          </div>

          <div class="form-group full">
            <label class="label">Nama Perangkat</label>
            <input class="input" type="text" name="nama_perangkat"
                   value="<?php echo e(old('nama_perangkat', $inventaris->nama_perangkat)); ?>"
                   placeholder="Contoh: Komputer" required>
          </div>

          <div class="form-group">
            <label class="label">Lokasi</label>
            <input class="input" type="text" name="lokasi"
                   value="<?php echo e(old('lokasi', $inventaris->lokasi)); ?>"
                   placeholder="Contoh: Lab 201" required>
          </div>

          <div class="form-group">
            <label class="label">Kondisi</label>
            <select class="select" name="kondisi" required>
              <option value="">-- Pilih Kondisi --</option>
              <option value="Baik" <?php echo e(old('kondisi', $inventaris->kondisi) == 'Baik' ? 'selected' : ''); ?>>Baik</option>
              <option value="Rusak" <?php echo e(old('kondisi', $inventaris->kondisi) == 'Rusak' ? 'selected' : ''); ?>>Rusak</option>
            </select>
          </div>

          <div class="form-group full">
            <label class="label">Kategori</label>
            <select class="select" name="category_id" required>
              <option value="">-- Pilih Kategori --</option>
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>"
                  <?php echo e(old('category_id', $inventaris->category_id) == $cat->id ? 'selected' : ''); ?>>
                  <?php echo e($cat->nama_kategori); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>

        <div class="form-actions">
          <a href="<?php echo e(route('user.inventaris.index')); ?>" class="btn-secondary">Batal</a>
          <button type="submit" class="btn-primary">Update</button>
        </div>

      </form>

    </div>
  </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/inventaris/edit.blade.php ENDPATH**/ ?>