<?php $__env->startSection('content'); ?>

<style>
.form-wrap {
    margin-top: 40px; /* turun sedikit */
}
</style>

<div class="form-wrap">

  <div class="form-shell">

    <div class="form-top">
      <div>
        <h2>Tambah Kategori</h2>
      </div>

      <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn-secondary">← Kembali</a>
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

      <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-grid">
          <div class="form-group full">
            <label class="label">Nama Kategori</label>
            <input class="input"
                   type="text"
                   name="nama_kategori"
                   value="<?php echo e(old('nama_kategori')); ?>"
                   placeholder="Contoh: Kabel, Komputer, Aksesoris"
                   required>
          </div>
        </div>

        <div class="form-actions">
          <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn-secondary">Batal</a>
          <button type="submit" class="btn-primary">Simpan</button>
        </div>

      </form>

    </div>
  </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventaris-hardware\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>