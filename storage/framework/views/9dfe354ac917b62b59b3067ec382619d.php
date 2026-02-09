<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:6px; text-align:center; }
    </style>
</head>
<body>
<h2>Laporan Inventaris Hardware</h2>

<table>
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kondisi</th>
            <th>Lokasi</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $inventaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->kode); ?></td>
            <td><?php echo e($item->nama_perangkat); ?></td>
            <td><?php echo e($item->kondisi); ?></td>
            <td><?php echo e($item->lokasi); ?></td>
            <td><?php echo e($item->tanggal_masuk); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</body>
</html>
<?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/pdf/inventaris.blade.php ENDPATH**/ ?>