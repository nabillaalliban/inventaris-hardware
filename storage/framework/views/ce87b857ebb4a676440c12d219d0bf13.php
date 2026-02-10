<?php $__env->startSection('content'); ?>


<a href="<?php echo e(route('user.inventaris.create')); ?>" class="btn">+ Tambah Data</a>

  <form method="GET" action="<?php echo e(route('user.inventaris.index')); ?>" style="display:flex; gap:10px; align-items:center;">
    <input
      type="text"
      name="q"
      value="<?php echo e(request('q')); ?>"
      placeholder="Cari lokasi / perangkat / kode (contoh: lab 201 kode 1)"
      class="input"
      style="min-width:320px;"
    >
    <button class="btn btn-primary" type="submit">Search</button>

    <?php if(request('q')): ?>
      <a href="<?php echo e(route('user.inventaris.index')); ?>" class="btn btn-secondary">Reset</a>
    <?php endif; ?>
  </form>
</div>


<div class="table-wrap">
  <table class="table">
    <tr>
      <th>No</th>
      <th>Kode</th>
      <th>Nama Perangkat</th>
      <th>Lokasi</th>
      <th>Kondisi</th>
      <th>Tanggal Masuk</th>
      <th>Kategori</th>
      <th>Aksi</th>
    </tr>

    <?php $__currentLoopData = $inventaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($loop->iteration); ?></td>
      <td><?php echo e($item->kode); ?></td>
      <td><?php echo e($item->nama_perangkat); ?></td>
      <td><?php echo e($item->lokasi); ?></td>
      <td><?php echo e($item->kondisi); ?></td>
      <td><?php echo e($item->tanggal_masuk); ?></td>
      <td><?php echo e($item->category?->nama_kategori ?? '-'); ?></td>
      <td style="white-space:nowrap;">
        <a class="btn" href="<?php echo e(route('user.inventaris.edit', $item->id)); ?>">Edit</a>

        <form action="<?php echo e(route('user.inventaris.destroy', $item->id)); ?>"
              method="POST"
              style="display:inline;"
              onsubmit="return confirm('Yakin hapus data ini?')">
          <?php echo csrf_field(); ?>
          <?php echo method_field('DELETE'); ?>
          <button type="submit" class="btn btn-danger" style="cursor:pointer;">Hapus</button>
        </form>
      </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </table>
</div>


</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/inventaris/index.blade.php ENDPATH**/ ?>