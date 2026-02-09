<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:16px;">
  <h2 style="margin:0;color:#2e1065;font-weight:900;">Daftar Kategori</h2>
  <a href="<?php echo e(route('user.categories.create')); ?>" class="btn">+ Tambah Kategori</a>
</div>

<?php if(session('success')): ?>
  <p style="color:#15803d;font-weight:700;margin:0 0 10px 0;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<div class="table-wrap">
  <table class="table">
    <tr>
      <th style="width:70px;">No</th>
      <th>Nama Kategori</th>
      <th style="width:160px;">Aksi</th>
    </tr>

    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($loop->iteration); ?></td>
      <td><?php echo e($category->nama_kategori); ?></td>
      <td style="white-space:nowrap;">
        <a class="btn" href="<?php echo e(route('user.categories.edit', $category->id)); ?>">Edit</a>

        <form action="<?php echo e(route('user.categories.destroy', $category->id)); ?>"
              method="POST"
              style="display:inline;"
              onsubmit="return confirm('Yakin hapus kategori?')">
          <?php echo csrf_field(); ?>
          <?php echo method_field('DELETE'); ?>
          <button type="submit" class="btn btn-danger" style="cursor:pointer;">Hapus</button>
        </form>
      </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/categories/index.blade.php ENDPATH**/ ?>