<?php $__env->startSection('content'); ?>
<h2>Data Peminjaman</h2>

<a href="<?php echo e(route('user.peminjaman.create')); ?>" class="btn">+ Tambah Peminjaman</a>

<?php if(session('success')): ?>
    <p style="color:green;margin-top:10px;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<div class="table-wrap">
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Tipe</th>
            <th>Barang</th>
            <th>Kategori</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
            <th>Tanggal Kembali</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($item->nama_peminjam); ?></td>
            <td><?php echo e(ucfirst($item->tipe_peminjam)); ?></td>
            <td><?php echo e($item->inventaris?->nama_perangkat ?? '-'); ?></td>
            <td><?php echo e($item->inventaris?->category?->nama_kategori ?? '-'); ?></td>
            <td><?php echo e($item->tanggal_pinjam); ?></td>
            <td>
                <span class="badge <?php echo e($item->status == 'dipinjam' ? 'badge-warning' : 'badge-success'); ?>">
                    <?php echo e(ucfirst($item->status)); ?>

                </span>
            </td>
            <td><?php echo e($item->tanggal_kembali ?? '-'); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="8" align="center">Belum ada data peminjaman</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/peminjaman/index.blade.php ENDPATH**/ ?>