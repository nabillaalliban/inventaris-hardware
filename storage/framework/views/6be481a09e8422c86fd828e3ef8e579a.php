<?php $__env->startSection('content'); ?>
<style>
  .loan-stats-page {
    display: flex;
    flex-direction: column;
    gap: 22px;
  }

  .loan-stats-hero {
    position: relative;
    overflow: hidden;
    border-radius: 28px;
    border: 1px solid rgba(167,139,250,0.22);
    background:
      radial-gradient(circle at top right, rgba(196,181,253,0.45), transparent 34%),
      linear-gradient(135deg, rgba(255,255,255,0.98), rgba(243,232,255,0.92));
    box-shadow: 0 18px 38px rgba(17,24,39,0.08);
    padding: 28px;
  }

  .loan-stats-hero::before {
    content: "";
    position: absolute;
    inset: auto -60px -90px auto;
    width: 240px;
    height: 240px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(167,139,250,0.22), rgba(167,139,250,0));
    pointer-events: none;
  }

  .loan-stats-hero__inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: minmax(0, 1.35fr) minmax(240px, 0.75fr);
    gap: 20px;
    align-items: stretch;
  }

  .loan-stats-hero__eyebrow {
    display: inline-flex;
    align-items: center;
    padding: 8px 14px;
    border-radius: 999px;
    border: 1px solid rgba(167,139,250,0.24);
    background: rgba(255,255,255,0.78);
    color: #4c1d95;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }

  .loan-stats-hero__title {
    margin: 16px 0 0 0;
    color: #2e1065;
    font-weight: 900;
    font-size: clamp(28px, 4vw, 40px);
    line-height: 1.08;
    max-width: 620px;
  }

  .loan-stats-hero__subtitle {
    margin: 12px 0 0 0;
    color: rgba(76,29,149,0.76);
    font-size: 14px;
    line-height: 1.8;
    max-width: 560px;
  }

  .loan-stats-hero__panel {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 16px;
    padding: 20px;
    border-radius: 22px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.8);
    box-shadow: 0 14px 26px rgba(76,29,149,0.08);
  }

  .loan-stats-hero__panel-label {
    margin: 0;
    color: #4c1d95;
    font-size: 13px;
    font-weight: 800;
  }

  .loan-stats-hero__panel-number {
    margin: 6px 0 0 0;
    color: #2e1065;
    font-size: clamp(42px, 5vw, 54px);
    font-weight: 900;
    line-height: 1;
  }

  .loan-stats-hero__panel-copy {
    margin: 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
    line-height: 1.7;
  }

  .loan-stats-hero__track {
    width: 100%;
    height: 10px;
    border-radius: 999px;
    background: rgba(167,139,250,0.16);
    overflow: hidden;
  }

  .loan-stats-hero__fill {
    width: 78%;
    height: 100%;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(167,139,250,0.8), rgba(196,181,253,0.95));
  }

  .loan-stats-hero__footer {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    color: rgba(76,29,149,0.7);
    font-size: 12px;
  }

  .loan-stats-page .stats-grid {
    margin-top: 0;
    gap: 18px;
  }

  .loan-stats-page .stat-card {
    position: relative;
    border-radius: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background: linear-gradient(180deg, rgba(255,255,255,1), rgba(250,245,255,0.96));
    box-shadow: 0 14px 30px rgba(17,24,39,0.07);
    padding: 22px 20px;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .loan-stats-page .stat-card::after {
    content: "";
    position: absolute;
    top: 0;
    left: 18px;
    right: 18px;
    height: 4px;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(167,139,250,0.65), rgba(196,181,253,0.95));
  }

  .loan-stats-page .stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(17,24,39,0.1);
  }

  .loan-stats-page .stat-card span {
    display: block;
    color: #4c1d95;
    font-weight: 800;
    font-size: 13px;
    line-height: 1.6;
  }

  .loan-stats-page .stat-card h1 {
    margin: 12px 0 0 0;
    font-size: clamp(38px, 4.3vw, 48px);
    color: #2e1065;
    line-height: 1;
  }

  .loan-stats-page .top-items {
    margin-top: 0;
    border-radius: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.96);
    box-shadow: 0 16px 34px rgba(17,24,39,0.07);
    padding: 22px;
  }

  .loan-stats-page .top-items h3 {
    margin: 0 0 16px 0;
    color: #2e1065;
    font-size: 20px;
    font-weight: 900;
  }

  .loan-stats-page .item-row {
    align-items: center;
    gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid rgba(167,139,250,0.12);
  }

  .loan-stats-page .item-row:last-child {
    border-bottom: none;
  }

  .loan-stats-page .item-row span:first-child {
    color: #2e1065;
    font-weight: 700;
  }

  .loan-stats-page .badge {
    background: rgba(243,232,255,0.95);
    border: 1px solid rgba(167,139,250,0.18);
    color: #5b21b6;
    padding: 7px 12px;
  }

  .loan-stats-page .empty {
    margin: 0;
    color: rgba(76,29,149,0.7);
    padding: 8px 0 0 0;
  }

  @media (max-width: 1100px) {
    .loan-stats-hero__inner {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 768px) {
    .loan-stats-hero {
      padding: 22px;
      border-radius: 22px;
    }
  }
</style>

<div class="loan-stats-page">
  <section class="loan-stats-hero">
    <div class="loan-stats-hero__inner">
      <div>
        <div class="loan-stats-hero__eyebrow">Dashboard Statistik</div>
        <h2 class="loan-stats-hero__title">Statistik Peminjaman</h2>
        <p class="loan-stats-hero__subtitle">
          Ringkasan status peminjaman barang untuk membantu admin memantau proses approval, peminjaman aktif, keterlambatan, dan pengembalian.
        </p>
      </div>

      <div class="loan-stats-hero__panel">
        <div>
          <p class="loan-stats-hero__panel-label">Total Monitoring</p>
          <p class="loan-stats-hero__panel-number"><?php echo e($pending + $active + $overdue + $returned); ?></p>
          <p class="loan-stats-hero__panel-copy">
            Akumulasi ringkasan status peminjaman yang ditampilkan pada panel statistik admin.
          </p>
        </div>

        <div>
          <div class="loan-stats-hero__track">
            <div class="loan-stats-hero__fill"></div>
          </div>
          <div class="loan-stats-hero__footer">
            <span>Monitoring peminjaman</span>
            <span>Panel admin</span>
          </div>
        </div>
      </div>
    </div>
  </section>

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
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventaris-hardware\resources\views/admin/loans/dashboard.blade.php ENDPATH**/ ?>