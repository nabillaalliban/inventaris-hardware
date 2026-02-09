<?php $__env->startSection('content'); ?>
<h2>Pengembalian Barang</h2>

<?php if(session('success')): ?>
    <p style="color:green;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<div class="table-wrap">
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Barang</th>
            <th>Tanggal Pinjam</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($item->nama_peminjam); ?></td>
            <td><?php echo e($item->inventaris->nama_perangkat); ?></td>
            <td><?php echo e($item->tanggal_pinjam); ?></td>
            <td>
                <a href="<?php echo e(route('user.pengembalian.form', $item->id)); ?>" class="btn">
                    Kembalikan
                </a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="5" align="center">Tidak ada barang yang sedang dipinjam</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/pengembalian/index.blade.php ENDPATH**/ ?>