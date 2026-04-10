<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/statistik.css')); ?>">

<div class="page-header">
    <h2>Statistik Peminjaman Saya</h2>
    <p>Ringkasan pengembalian berdasarkan transaksi</p>
</div>

<div class="stats-grid">

    <div class="stat-card">
        <span>Sudah Dikembalikan</span>
        <h1><?php echo e($returned); ?></h1>
    </div>

    <div class="stat-card">
        <span>Belum Dikembalikan</span>
        <h1><?php echo e($notReturned); ?></h1>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/loans/stats.blade.php ENDPATH**/ ?>