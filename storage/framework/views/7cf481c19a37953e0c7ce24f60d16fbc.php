<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div>
        <h2>Statistik Peminjaman</h2>
        <p>Ringkasan status peminjaman barang</p>
    </div>
</div>

<div class="stats-grid">

    <div class="stat-card">
        <span>Menunggu Persetujuan</span>
        <h1><?php echo e($pending); ?></h1>
    </div>

    <div class="stat-card">
        <span>Sedang Dipinjam</span>
        <h1><?php echo e($active); ?></h1>
    </div>

    <div class="stat-card">
        <span>Jatuh Tempo</span>
        <h1><?php echo e($overdue); ?></h1>
    </div>

    <div class="stat-card">
        <span>Sudah Dikembalikan</span>
        <h1><?php echo e($returned); ?></h1>
    </div>

</div>


<div class="top-items">
    <h3>Top Barang Paling Sering Dipinjam</h3>

    <?php $__empty_1 = true; $__currentLoopData = $topItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="item-row">
            <span><?php echo e($t->item?->nama_barang ?? '-'); ?></span>
            <span class="badge"><?php echo e($t->total); ?> pcs</span>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="empty">Belum ada data.</p>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/admin/loans/dashboard.blade.php ENDPATH**/ ?>