<?php $__env->startSection('content'); ?>
<style>
  .category-page {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .category-hero {
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

  .category-hero::after {
    content: "";
    position: absolute;
    right: -30px;
    bottom: -50px;
    width: 180px;
    height: 180px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(167,139,250,0.20), rgba(167,139,250,0));
    pointer-events: none;
  }

  .category-hero__inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: minmax(0, 1.35fr) minmax(220px, 0.7fr);
    gap: 18px;
    align-items: center;
  }

  .category-hero__eyebrow {
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

  .category-hero__title {
    margin: 14px 0 0 0;
    color: #2e1065;
    font-size: clamp(26px, 3.5vw, 36px);
    font-weight: 900;
    line-height: 1.1;
  }

  .category-hero__subtitle {
    margin: 10px 0 0 0;
    color: rgba(76,29,149,0.74);
    font-size: 14px;
    line-height: 1.8;
    max-width: 560px;
  }

  .category-hero__actions {
    display: flex;
    justify-content: flex-end;
    align-items: stretch;
  }

  .category-add-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-width: 100%;
    padding: 14px 18px;
    border-radius: 18px;
    border: 1px solid rgba(167,139,250,0.4);
    background: linear-gradient(90deg, rgba(167,139,250,0.55), rgba(196,181,253,0.82));
    color: #2e1065;
    font-weight: 900;
    text-decoration: none;
    box-shadow: 0 12px 24px rgba(76,29,149,0.08);
  }

  .category-summary {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
  }

  .category-summary__card {
    border-radius: 20px;
    border: 1px solid rgba(167,139,250,0.22);
    background: linear-gradient(180deg, rgba(255,255,255,1), rgba(250,245,255,0.96));
    box-shadow: 0 12px 28px rgba(17,24,39,0.06);
    padding: 18px 20px;
  }

  .category-summary__label {
    margin: 0;
    color: rgba(76,29,149,0.72);
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }

  .category-summary__value {
    margin: 10px 0 0 0;
    color: #2e1065;
    font-size: 32px;
    font-weight: 900;
    line-height: 1;
  }

  .category-summary__hint {
    margin: 8px 0 0 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
    line-height: 1.6;
  }

  .category-alert {
    padding: 14px 16px;
    border-radius: 16px;
    border: 1px solid rgba(34,197,94,0.18);
    background: rgba(240,253,244,0.95);
    color: #15803d;
    font-weight: 700;
    box-shadow: 0 10px 20px rgba(21,128,61,0.06);
  }

  .category-table-shell {
    border-radius: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.92);
    box-shadow: 0 16px 34px rgba(17,24,39,0.07);
    overflow: hidden;
  }

  .category-table-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 20px 22px;
    border-bottom: 1px solid rgba(167,139,250,0.16);
    background: linear-gradient(90deg, rgba(167,139,250,0.16), rgba(196,181,253,0.18));
  }

  .category-table-head h3 {
    margin: 0;
    color: #2e1065;
    font-size: 18px;
    font-weight: 900;
  }

  .category-table-head p {
    margin: 6px 0 0 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
  }

  .category-table-count {
    padding: 8px 14px;
    border-radius: 999px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.82);
    color: #4c1d95;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
  }

  .category-table-shell .table-wrap {
    margin-top: 0;
    border: none;
    border-radius: 0;
  }

  .category-table-shell .table th {
    padding: 14px 18px;
  }

  .category-table-shell .table td {
    padding: 16px 18px;
    vertical-align: middle;
  }

  .category-index {
    width: 46px;
    height: 46px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(243,232,255,0.95);
    border: 1px solid rgba(167,139,250,0.2);
    color: #4c1d95;
    font-weight: 900;
  }

  .category-name {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .category-name strong {
    color: #2e1065;
    font-size: 15px;
  }

  .category-name span {
    color: rgba(76,29,149,0.68);
    font-size: 12px;
  }

  .category-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }

  .category-actions form {
    margin: 0;
  }

  .category-actions .btn,
  .category-actions .btn-danger {
    border-radius: 12px;
    padding: 8px 12px;
    font-weight: 800;
  }

  @media (max-width: 900px) {
    .category-hero__inner {
      grid-template-columns: 1fr;
    }

    .category-hero__actions {
      justify-content: flex-start;
    }
  }

  @media (max-width: 640px) {
    .category-summary {
      grid-template-columns: 1fr;
    }

    .category-table-head {
      flex-direction: column;
      align-items: flex-start;
    }

    .category-add-btn {
      min-width: 0;
      width: 100%;
    }
  }
</style>

<div class="category-page">
  <section class="category-hero">
    <div class="category-hero__inner">
      <div>
        <div class="category-hero__eyebrow">Manajemen Kategori</div>
        <h2 class="category-hero__title">Daftar Kategori</h2>
       
      </div>

      <div class="category-hero__actions">
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="category-add-btn">+ Tambah Kategori</a>
      </div>
    </div>
  </section>

  <section class="category-summary">
    <div class="category-summary__card">
      <p class="category-summary__label">Total Kategori</p>
      <p class="category-summary__value"><?php echo e($categories->count()); ?></p>
      <p class="category-summary__hint">Jumlah kategori yang saat ini tersimpan di sistem inventaris.</p>
    </div>

    <div class="category-summary__card">
      <p class="category-summary__label">Status Data</p>
      <p class="category-summary__value">Aktif</p>
      <p class="category-summary__hint">Data kategori siap digunakan untuk pengelompokan barang inventaris.</p>
    </div>
  </section>

  <?php if(session('success')): ?>
    <div class="category-alert"><?php echo e(session('success')); ?></div>
  <?php endif; ?>

  <section class="category-table-shell">
    <div class="category-table-head">
      <div>
        <h3>Tabel Kategori</h3>
          </div>
      <div class="category-table-count"><?php echo e($categories->count()); ?> Kategori</div>
    </div>

    <div class="table-wrap">
      <table class="table">
        <tr>
          <th style="width:90px;">No</th>
          <th>Nama Kategori</th>
          <th style="width:190px;">Aksi</th>
        </tr>

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td>
            <span class="category-index"><?php echo e($loop->iteration); ?></span>
          </td>
          <td>
            <div class="category-name">
              <strong><?php echo e($category->nama_kategori); ?></strong>
              <span>Kategori inventaris terdaftar</span>
            </div>
          </td>
          <td>
            <div class="category-actions">
              <a class="btn" href="<?php echo e(route('admin.categories.edit', $category->id)); ?>">Edit</a>

              <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>"
                    method="POST"
                    onsubmit="return confirm('Yakin hapus kategori?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger" style="cursor:pointer;">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </table>
    </div>
  </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventaris-hardware\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>