<?php $__env->startSection('content'); ?>
<style>
  .items-page {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .items-hero {
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

  .items-hero::after {
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

  .items-hero__inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: minmax(0, 1.3fr) minmax(220px, 0.7fr);
    gap: 18px;
    align-items: center;
  }

  .items-hero__eyebrow {
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

  .items-hero__title {
    margin: 14px 0 0 0;
    color: #2e1065;
    font-size: clamp(28px, 3.8vw, 38px);
    font-weight: 900;
    line-height: 1.08;
  }

  .items-hero__subtitle {
    margin: 10px 0 0 0;
    color: rgba(76,29,149,0.74);
    font-size: 14px;
    line-height: 1.8;
    max-width: 560px;
  }

  .items-hero__actions {
    display: flex;
    justify-content: flex-end;
    align-items: stretch;
  }

  .items-add-btn {
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

  .items-summary {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
  }

  .items-summary__card {
    padding: 18px 20px;
    border-radius: 20px;
    border: 1px solid rgba(167,139,250,0.22);
    background: linear-gradient(180deg, rgba(255,255,255,1), rgba(250,245,255,0.96));
    box-shadow: 0 12px 28px rgba(17,24,39,0.06);
  }

  .items-summary__label {
    margin: 0;
    color: rgba(76,29,149,0.72);
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }

  .items-summary__value {
    margin: 10px 0 0 0;
    color: #2e1065;
    font-size: 32px;
    font-weight: 900;
    line-height: 1;
  }

  .items-summary__hint {
    margin: 8px 0 0 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
    line-height: 1.6;
  }

  .items-alert {
    padding: 14px 16px;
    border-radius: 16px;
    border: 1px solid rgba(34,197,94,0.18);
    background: rgba(240,253,244,0.95);
    color: #15803d;
    font-weight: 800;
    box-shadow: 0 10px 20px rgba(21,128,61,0.06);
  }

  .items-table-shell {
    border-radius: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.94);
    box-shadow: 0 16px 34px rgba(17,24,39,0.07);
    overflow: hidden;
  }

  .items-table-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 20px 22px;
    border-bottom: 1px solid rgba(167,139,250,0.16);
    background: linear-gradient(90deg, rgba(167,139,250,0.16), rgba(196,181,253,0.18));
  }

  .items-table-head h3 {
    margin: 0;
    color: #2e1065;
    font-size: 18px;
    font-weight: 900;
  }

  .items-table-head p {
    margin: 6px 0 0 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
  }

  .items-table-count {
    padding: 8px 14px;
    border-radius: 999px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.82);
    color: #4c1d95;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
  }

  .items-table-shell .table-wrap {
    margin-top: 0;
    border: none;
    border-radius: 0;
  }

  .items-table-shell .table th {
    padding: 14px 18px;
  }

  .items-table-shell .table td {
    padding: 16px 18px;
    vertical-align: middle;
  }

  .items-name {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .items-name strong {
    color: #2e1065;
    font-size: 15px;
  }

  .items-name span {
    color: rgba(76,29,149,0.68);
    font-size: 12px;
  }

  .items-category,
  .items-date {
    color: rgba(76,29,149,0.78);
  }

  .items-price {
    color: #2e1065;
    font-weight: 900;
  }

  .items-stock {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 62px;
    padding: 8px 12px;
    border-radius: 999px;
    background: rgba(243,232,255,0.95);
    border: 1px solid rgba(167,139,250,0.18);
    color: #2e1065;
    font-weight: 900;
  }

  .items-actions form {
    margin: 0;
  }

  .items-actions .btn-danger {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    padding: 8px 12px;
    font-weight: 800;
  }

  .items-empty {
    padding: 24px 18px;
    color: rgba(76,29,149,0.72);
    text-align: center;
  }

  @media (max-width: 900px) {
    .items-hero__inner {
      grid-template-columns: 1fr;
    }

    .items-hero__actions {
      justify-content: flex-start;
    }
  }

  @media (max-width: 640px) {
    .items-summary {
      grid-template-columns: 1fr;
    }

    .items-table-head {
      flex-direction: column;
      align-items: flex-start;
    }

    .items-add-btn {
      min-width: 0;
      width: 100%;
    }
  }
</style>

<div class="items-page">
  <section class="items-hero">
    <div class="items-hero__inner">
      <div>
        <div class="items-hero__eyebrow">Inventaris Barang</div>
        <h2 class="items-hero__title">Barang</h2>
        <p class="items-hero__subtitle">
          Kelola data barang untuk peminjaman dengan tampilan yang lebih rapi, jelas, dan siap untuk presentasi.
        </p>
      </div>

      <div class="items-hero__actions">
        <a class="items-add-btn" href="<?php echo e(route('admin.items.create')); ?>">+ Tambah Barang</a>
      </div>
    </div>
  </section>

  <section class="items-summary">
    <div class="items-summary__card">
      <p class="items-summary__label">Total Barang</p>
      <p class="items-summary__value"><?php echo e($items->count()); ?></p>
      <p class="items-summary__hint">Jumlah seluruh barang inventaris yang saat ini tercatat pada sistem.</p>
    </div>

    <div class="items-summary__card">
      <p class="items-summary__label">Status Data</p>
      <p class="items-summary__value">Aktif</p>
      <p class="items-summary__hint">Data barang siap digunakan untuk proses peminjaman dan pengelolaan inventaris.</p>
    </div>
  </section>

  <?php if(session('success')): ?>
    <div class="items-alert"><?php echo e(session('success')); ?></div>
  <?php endif; ?>

  <section class="items-table-shell">
    <div class="items-table-head">
      <div>
        <h3>Daftar Barang</h3>
      </div>
      <div class="items-table-count"><?php echo e($items->count()); ?> Data</div>
    </div>

    <div class="table-wrap">
      <table class="table">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Tanggal</th>
            <th style="width:140px;">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td>
                <div class="items-name">
                  <strong><?php echo e($it->nama_barang); ?></strong>
                  <span>Barang inventaris</span>
                </div>
              </td>

              <td class="items-category"><?php echo e($it->category?->nama_kategori ?? '-'); ?></td>

              <td class="items-price">
                Rp <?php echo e(number_format($it->harga,0,',','.')); ?>

              </td>

              <td>
                <span class="items-stock"><?php echo e($it->stok); ?></span>
              </td>

              <td class="items-date"><?php echo e($it->tanggal); ?></td>

              <td class="items-actions">
                <form action="<?php echo e(route('admin.items.destroy', $it->id)); ?>"
                      method="POST"
                      onsubmit="return confirm('Yakin hapus barang ini?')">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button type="submit" class="btn-danger">🗑️ Hapus</button>
                </form>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="6" class="items-empty">
                Belum ada barang.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventaris-hardware\resources\views/admin/items/index.blade.php ENDPATH**/ ?>