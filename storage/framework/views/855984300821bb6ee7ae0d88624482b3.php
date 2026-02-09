<?php $__env->startSection('content'); ?>
<h2>Form Pengembalian</h2>

<form action="<?php echo e(route('user.pengembalian.update', $p->id)); ?>" method="POST">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<p><strong>Nama Peminjam:</strong> <?php echo e($p->nama_peminjam); ?></p>
<p><strong>Barang:</strong> <?php echo e($p->inventaris->nama_perangkat); ?></p>

<label>Tanggal Kembali</label><br>
<input type="date" name="tanggal_kembali" required><br><br>

<label>Keterangan</label><br>
<textarea name="keterangan_kembali"></textarea><br><br>

<button type="submit" class="btn">Simpan</button>
<a href="<?php echo e(route('user.pengembalian.index')); ?>" class="btn btn-danger">Batal</a>

</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/pengembalian/kembali.blade.php ENDPATH**/ ?>