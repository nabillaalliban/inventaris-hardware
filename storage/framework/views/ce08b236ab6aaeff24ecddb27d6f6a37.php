<?php $__env->startSection('content'); ?>
<style>
  .loans-page {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .loans-hero {
    position: relative;
    overflow: hidden;
    border-radius: 26px;
    padding: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background:
      radial-gradient(circle at top right, rgba(196,181,253,0.42), transparent 34%),
      linear-gradient(135deg, rgba(255,255,255,0.98), rgba(243,232,255,0.92));
    box-shadow: 0 16px 34px rgba(17,24,39,0.08);
  }

  .loans-hero::after {
    content: "";
    position: absolute;
    right: -36px;
    bottom: -60px;
    width: 200px;
    height: 200px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(167,139,250,0.18), rgba(167,139,250,0));
    pointer-events: none;
  }

  .loans-hero__inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: minmax(0, 1.3fr) minmax(220px, 0.7fr);
    gap: 18px;
    align-items: center;
  }

  .loans-hero__eyebrow {
    display: inline-flex;
    align-items: center;
    padding: 8px 14px;
    border-radius: 999px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.75);
    color: #4c1d95;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }

  .loans-hero__title {
    margin: 14px 0 0 0;
    color: #2e1065;
    font-size: clamp(28px, 3.8vw, 38px);
    font-weight: 900;
    line-height: 1.08;
  }

  .loans-hero__subtitle {
    margin: 10px 0 0 0;
    color: rgba(76,29,149,0.74);
    font-size: 14px;
    line-height: 1.8;
    max-width: 560px;
  }

  .loans-hero__actions {
    display: flex;
    justify-content: flex-end;
    align-items: stretch;
  }

  .loans-stat-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 100%;
    padding: 14px 18px;
    border-radius: 18px;
    border: 1px solid rgba(167,139,250,0.38);
    background: linear-gradient(90deg, rgba(167,139,250,0.55), rgba(196,181,253,0.82));
    color: #2e1065;
    text-decoration: none;
    font-weight: 900;
    box-shadow: 0 12px 24px rgba(76,29,149,0.08);
  }

  .loans-filters {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .loans-filter {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 14px;
    border-radius: 999px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.92);
    color: #4c1d95;
    text-decoration: none;
    font-weight: 800;
    box-shadow: 0 10px 20px rgba(17,24,39,0.04);
  }

  .loans-filter.is-active {
    background: linear-gradient(90deg, rgba(167,139,250,0.5), rgba(196,181,253,0.82));
    color: #2e1065;
  }

  .loans-alert {
    padding: 14px 16px;
    border-radius: 16px;
    font-weight: 800;
    box-shadow: 0 10px 20px rgba(17,24,39,0.05);
  }

  .loans-alert--success {
    border: 1px solid rgba(34,197,94,0.18);
    background: rgba(240,253,244,0.95);
    color: #15803d;
  }

  .loans-alert--error {
    border: 1px solid rgba(239,68,68,0.18);
    background: rgba(254,242,242,0.95);
    color: #b91c1c;
  }

  .loans-alert--error div + div {
    margin-top: 6px;
  }

  .loans-table-shell {
    border-radius: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.94);
    box-shadow: 0 16px 34px rgba(17,24,39,0.07);
    overflow: hidden;
  }

  .loans-table-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 20px 22px;
    border-bottom: 1px solid rgba(167,139,250,0.16);
    background: linear-gradient(90deg, rgba(167,139,250,0.16), rgba(196,181,253,0.18));
  }

  .loans-table-head h3 {
    margin: 0;
    color: #2e1065;
    font-size: 18px;
    font-weight: 900;
  }

  .loans-table-head p {
    margin: 6px 0 0 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
  }

  .loans-table-count {
    padding: 8px 14px;
    border-radius: 999px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.82);
    color: #4c1d95;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
  }

  .loans-table-shell .table-wrap {
    margin-top: 0;
    border: none;
    border-radius: 0;
  }

  .loans-table-shell .table th {
    padding: 14px 16px;
    white-space: nowrap;
  }

  .loans-table-shell .table td {
    padding: 16px;
    vertical-align: top;
  }

  .loans-index {
    width: 42px;
    height: 42px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(243,232,255,0.95);
    border: 1px solid rgba(167,139,250,0.2);
    color: #4c1d95;
    font-weight: 900;
  }

  .loans-person {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .loans-person strong {
    color: #2e1065;
    font-size: 14px;
  }

  .loans-person span,
  .loans-date,
  .loans-type {
    color: rgba(76,29,149,0.75);
  }

  .loans-type {
    font-weight: 800;
  }

  .loans-items {
    display: flex;
    flex-direction: column;
    gap: 8px;
    min-width: 240px;
  }

  .loans-item-row {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 8px 10px;
    border-radius: 12px;
    background: rgba(250,245,255,0.95);
    border: 1px solid rgba(167,139,250,0.12);
  }

  .loans-item-row strong {
    color: #2e1065;
  }

  .loans-qty {
    font-weight: 900;
    color: #2e1065;
  }

  .loans-status {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 7px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }

  .loans-status.pending {
    background: rgba(254,249,195,0.95);
    color: #854d0e;
  }

  .loans-status.approved {
    background: rgba(219,234,254,0.95);
    color: #1d4ed8;
  }

  .loans-status.returned {
    background: rgba(220,252,231,0.95);
    color: #15803d;
  }

  .loans-status.rejected {
    background: rgba(254,226,226,0.95);
    color: #b91c1c;
  }

  .loans-status.overdue {
    background: rgba(254,226,226,0.98);
    color: #991b1b;
  }

  .loans-actions {
    min-width: 220px;
  }

  .loans-actions__group {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .loans-actions__inline {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }

  .loans-actions form {
    margin: 0;
  }

  .loans-return-form {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .loans-return-input {
    border: 1px solid rgba(167,139,250,0.35);
    border-radius: 10px;
    padding: 8px 10px;
    background: #faf5ff;
    outline: none;
  }

  .loans-return-input:focus {
    box-shadow: 0 0 0 4px rgba(167,139,250,0.18);
  }

  .loans-empty {
    text-align: center;
    color: rgba(76,29,149,0.72);
    padding: 28px 18px;
  }

  .loans-muted {
    color: rgba(76,29,149,0.75);
    font-weight: 900;
  }

  @media (max-width: 900px) {
    .loans-hero__inner {
      grid-template-columns: 1fr;
    }

    .loans-hero__actions {
      justify-content: flex-start;
    }

    .loans-table-head {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  @media (max-width: 640px) {
    .loans-stat-btn {
      min-width: 0;
      width: 100%;
    }
  }
</style>

<div class="loans-page">
  <section class="loans-hero">
    <div class="loans-hero__inner">
      <div>
        <div class="loans-hero__eyebrow">Manajemen Peminjaman</div>
        <h2 class="loans-hero__title">Riwayat Peminjaman</h2>

      </div>

      <div class="loans-hero__actions">
        <a class="loans-stat-btn" href="<?php echo e(route('admin.loans.dashboard')); ?>">📊 Statistik</a>
      </div>
    </div>
  </section>

  <div class="loans-filters">
    <a class="loans-filter <?php echo e(request('status') === 'pending' ? 'is-active' : ''); ?>" href="<?php echo e(route('admin.loans.index',['status'=>'pending'])); ?>">Pending</a>
    <a class="loans-filter <?php echo e(request('status') === 'approved' ? 'is-active' : ''); ?>" href="<?php echo e(route('admin.loans.index',['status'=>'approved'])); ?>">Aktif</a>
    <a class="loans-filter <?php echo e(request('status') === 'overdue' ? 'is-active' : ''); ?>" href="<?php echo e(route('admin.loans.index',['status'=>'overdue'])); ?>">Jatuh Tempo</a>
    <a class="loans-filter <?php echo e(request('status') === 'returned' ? 'is-active' : ''); ?>" href="<?php echo e(route('admin.loans.index',['status'=>'returned'])); ?>">Dikembalikan</a>
    <a class="loans-filter <?php echo e(request('status') === 'rejected' ? 'is-active' : ''); ?>" href="<?php echo e(route('admin.loans.index',['status'=>'rejected'])); ?>">Ditolak</a>
  </div>

  <?php if(session('success')): ?>
    <div class="loans-alert loans-alert--success"><?php echo e(session('success')); ?></div>
  <?php endif; ?>

  <?php if($errors->any()): ?>
    <div class="loans-alert loans-alert--error">
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div>- <?php echo e($e); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  <?php endif; ?>

  <section class="loans-table-shell">
    <div class="loans-table-head">
      <div>
        <h3>Data Peminjaman</h3>
      </div>
      <div class="loans-table-count"><?php echo e($loans->count()); ?> Data</div>
    </div>

    <div class="table-wrap">
      <table class="table">
        <tr>
          <th style="width:80px;">No</th>
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
            <td><span class="loans-index"><?php echo e($loop->iteration); ?></span></td>
            <td>
              <div class="loans-person">
                <strong><?php echo e($l->user?->name ?? '-'); ?></strong>
                <span>Akun pengaju</span>
              </div>
            </td>
            <td>
              <div class="loans-person">
                <strong><?php echo e($l->nama_peminjam); ?></strong>
                <span>Peminjam</span>
              </div>
            </td>
            <td class="loans-type"><?php echo e(strtoupper($l->tipe_peminjam)); ?></td>
            <td class="loans-date"><?php echo e($l->tanggal_pinjam); ?></td>
            <td class="loans-date"><?php echo e($l->due_date ?? '-'); ?></td>

            <td>
              <?php if($isOverdue): ?>
                <span class="loans-status overdue">overdue</span>
              <?php else: ?>
                <span class="loans-status <?php echo e($l->status); ?>"><?php echo e($l->status); ?></span>
              <?php endif; ?>
            </td>

            <td>
              <div class="loans-items">
                <?php $__currentLoopData = $l->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="loans-item-row">
                    <strong><?php echo e($it->item?->nama_barang ?? '-'); ?></strong>
                    <span class="loans-qty">x<?php echo e($it->qty); ?></span>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </td>

            <td class="loans-actions">
              <div class="loans-actions__group">
                <?php if($l->status === 'pending'): ?>
                  <div class="loans-actions__inline">
                    <form action="<?php echo e(route('admin.loans.approve',$l->id)); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                      <button type="submit" class="btn" onclick="return confirm('Setujui peminjaman ini?')">
                        Approve
                      </button>
                    </form>

                    <form action="<?php echo e(route('admin.loans.reject',$l->id)); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak peminjaman ini?')">
                        Reject
                      </button>
                    </form>
                  </div>
                <?php endif; ?>

                <?php if($l->status === 'approved'): ?>
                  <form action="<?php echo e(route('admin.loans.returned',$l->id)); ?>" method="POST" class="loans-return-form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <input type="date" name="tanggal_kembali" required class="loans-return-input">

                    <button type="submit" class="btn"
                      onclick="return confirm('Tandai transaksi ini sudah dikembalikan?')">
                      Mark Returned
                    </button>
                  </form>
                <?php endif; ?>

                <?php if(in_array($l->status, ['returned','rejected'])): ?>
                  <span class="loans-muted">-</span>
                <?php endif; ?>
              </div>
            </td>
          </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="9" class="loans-empty">Belum ada data.</td></tr>
        <?php endif; ?>
      </table>
    </div>
  </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventaris-hardware\resources\views/admin/loans/index.blade.php ENDPATH**/ ?>