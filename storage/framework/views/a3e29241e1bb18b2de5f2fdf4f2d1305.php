<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Riwayat Peminjaman</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.75);font-weight:700;">
      Kelola approval, jatuh tempo, dan pengembalian
    </p>
  </div>

  <a class="btn" href="<?php echo e(route('admin.loans.dashboard')); ?>">📊 Statistik</a>
</div>


<div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:14px;">
  <a class="btn" href="<?php echo e(route('admin.loans.index',['status'=>'pending'])); ?>">Pending</a>
  <a class="btn" href="<?php echo e(route('admin.loans.index',['status'=>'approved'])); ?>">Aktif</a>
  <a class="btn" href="<?php echo e(route('admin.loans.index',['status'=>'overdue'])); ?>">Jatuh Tempo</a>
  <a class="btn" href="<?php echo e(route('admin.loans.index',['status'=>'returned'])); ?>">Dikembalikan</a>
  <a class="btn" href="<?php echo e(route('admin.loans.index',['status'=>'rejected'])); ?>">Ditolak</a>
</div>

<?php if(session('success')): ?>
  <p style="color:#15803d;font-weight:800;margin-top:10px;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<?php if($errors->any()): ?>
  <div style="margin-top:10px;color:#b91c1c;font-weight:800;">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div>- <?php echo e($e); ?></div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php endif; ?>

<div class="table-wrap" style="margin-top:14px;">
  <table class="table">
    <tr>
      <th>No</th>
      <th>Pengaju</th>
      <th>Nama Peminjam</th>
      <th>Tipe</th>
      <th>Tgl Pinjam</th>
      <th>Jatuh Tempo</th>
      <th>Status</th>
      <th>Barang</th>
      <th>Aksi</th>
    </tr>

    <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <?php
        $isOverdue = ($l->status==='approved' && $l->due_date && $l->due_date < now()->toDateString());
      ?>

      <tr>
        <td><?php echo e($loop->iteration); ?></td>
        <td><?php echo e($l->user?->name ?? '-'); ?></td>
        <td><?php echo e($l->nama_peminjam); ?></td>
        <td><?php echo e(strtoupper($l->tipe_peminjam)); ?></td>
        <td><?php echo e($l->tanggal_pinjam); ?></td>
        <td><?php echo e($l->due_date ?? '-'); ?></td>

        <td>
          <?php if($isOverdue): ?>
            <span class="badge overdue">overdue</span>
          <?php else: ?>
            <span class="badge <?php echo e($l->status); ?>"><?php echo e($l->status); ?></span>
          <?php endif; ?>
        </td>

        <td style="min-width:260px;">
          <?php $__currentLoopData = $l->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="display:flex;justify-content:space-between;gap:10px;">
              <span><?php echo e($it->item?->nama_barang ?? '-'); ?></span>
              <span style="font-weight:900;color:#2e1065;">x<?php echo e($it->qty); ?></span>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>

        <td style="white-space:nowrap;">
          
          <?php if($l->status === 'pending'): ?>
            <form action="<?php echo e(route('admin.loans.approve',$l->id)); ?>" method="POST" style="display:inline;">
              <?php echo csrf_field(); ?>
              <button type="submit" class="btn" onclick="return confirm('Setujui peminjaman ini?')">
                Approve
              </button>
            </form>

            <form action="<?php echo e(route('admin.loans.reject',$l->id)); ?>" method="POST" style="display:inline;">
              <?php echo csrf_field(); ?>
              <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak peminjaman ini?')">
                Reject
              </button>
            </form>
          <?php endif; ?>

          
          <?php if($l->status === 'approved'): ?>
            <form action="<?php echo e(route('admin.loans.returned',$l->id)); ?>" method="POST" style="display:inline;">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PUT'); ?>

              <input type="date" name="tanggal_kembali" required
                style="border:1px solid rgba(167,139,250,0.35);border-radius:10px;padding:6px 8px;">

              <button type="submit" class="btn"
                onclick="return confirm('Tandai transaksi ini sudah dikembalikan?')">
                Mark Returned
              </button>
            </form>
          <?php endif; ?>

          
          <?php if(in_array($l->status, ['returned','rejected'])): ?>
            <span style="color:rgba(76,29,149,0.75);font-weight:900;">-</span>
          <?php endif; ?>
        </td>
      </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr><td colspan="9">Belum ada data.</td></tr>
    <?php endif; ?>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/inventaris-hardware/resources/views/admin/loans/index.blade.php ENDPATH**/ ?>