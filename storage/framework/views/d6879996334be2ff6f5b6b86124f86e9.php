<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header p {
            margin: 2px;
            font-size: 12px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 13px;
        }

        th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #eaf6ff;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        .footer {
            margin-top: 20px;
            font-size: 11px;
            text-align: right;
            color: #777;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            color: white;
            font-size: 11px;
        }

        .baik { background-color: #2ecc71; }
        .rusak { background-color: #e74c3c; }
        .perbaikan { background-color: #f39c12; }

    </style>
</head>
<body>

<div class="header">
    <h2>Laporan Inventaris Hardware</h2>
    <p>Dicetak pada: <?php echo e(date('d M Y')); ?></p>
</div>

<table>
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Perangkat</th>
            <th>Kondisi</th>
            <th>Lokasi</th>
            <th>Tanggal Masuk</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $inventaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->kode); ?></td>
            <td><?php echo e($item->nama_perangkat); ?></td>
            <td>
                <span class="badge
                    <?php if($item->kondisi == 'Baik'): ?> baik
                    <?php elseif($item->kondisi == 'Rusak'): ?> rusak
                    <?php else: ?> perbaikan
                    <?php endif; ?>
                ">
                    <?php echo e($item->kondisi); ?>

                </span>
            </td>
            <td><?php echo e($item->lokasi); ?></td>
            <td><?php echo e(date('d-m-Y', strtotime($item->tanggal_masuk))); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<div class="footer">
    <p>© <?php echo e(date('Y')); ?> Sistem Inventaris</p>
</div>

</body>
</html>
<?php /**PATH C:\laragon\www\inventaris-hardware\resources\views/admin/pdf/inventaris.blade.php ENDPATH**/ ?>