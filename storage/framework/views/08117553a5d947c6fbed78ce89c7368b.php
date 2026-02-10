<?php $__env->startSection('content'); ?>
<style>
  :root{
    --purple-50:#f6f1ff;
    --purple-100:#efe7ff;
    --purple-200:#e1d4ff;
    --purple-400:#9a7bff;
    --purple-600:#6d3cff;
    --text:#1f2937;
    --muted:#6b7280;
    --border:#e7e0ff;
    --shadow: 0 10px 30px rgba(109, 60, 255, .08);
    --radius: 18px;
  }

  .loan-wrap{
    max-width: 980px;
    margin: 28px auto;
    padding: 0 16px;
  }

  .loan-card{
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .loan-header{
    padding: 18px 20px;
    background: linear-gradient(90deg, var(--purple-100), #f3efff);
    display:flex;
    align-items:flex-start;
    justify-content: space-between;
    gap: 12px;
  }

  .loan-title{
    margin: 0;
    font-size: 22px;
    font-weight: 800;
    color: var(--text);
    letter-spacing: .2px;
  }

  .loan-subtitle{
    margin: 4px 0 0;
    color: var(--muted);
    font-size: 13px;
  }

  .btn-back{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding: 10px 14px;
    border-radius: 14px;
    border: 1px solid var(--border);
    background: #fff;
    color: var(--purple-600);
    text-decoration:none;
    font-weight: 700;
    box-shadow: 0 6px 14px rgba(109, 60, 255, .06);
    white-space: nowrap;
  }
  .btn-back:hover{ filter: brightness(.98); }

  .loan-body{
    padding: 20px;
    background: #fff;
  }

  .alert-errors{
    border: 1px solid #fecaca;
    background: #fff1f2;
    color: #991b1b;
    padding: 12px 14px;
    border-radius: 14px;
    margin-bottom: 14px;
  }
  .alert-errors ul{ margin: 6px 0 0 18px; }

  .form-grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px 18px;
  }
  @media (max-width: 760px){
    .form-grid{ grid-template-columns: 1fr; }
  }

  .form-group{ display:flex; flex-direction:column; gap:8px; }
  .label{
    font-weight: 800;
    color: var(--text);
    font-size: 13px;
  }

  .control{
    border: 1px solid var(--border);
    background: var(--purple-50);
    border-radius: 14px;
    padding: 12px 14px;
    outline: none;
    color: var(--text);
    transition: .15s ease;
  }
  .control:focus{
    border-color: rgba(109, 60, 255, .45);
    box-shadow: 0 0 0 4px rgba(109, 60, 255, .10);
    background: #fff;
  }

  .control::placeholder{ color: #9ca3af; }

  .span-2{ grid-column: span 2; }
  @media (max-width: 760px){ .span-2{ grid-column: span 1; } }

  .select-wrap{ position: relative; }
  .select-wrap:after{
    content:"";
    position:absolute;
    right: 14px;
    top: 50%;
    width: 10px;
    height: 10px;
    border-right: 2px solid rgba(31,41,55,.55);
    border-bottom: 2px solid rgba(31,41,55,.55);
    transform: translateY(-60%) rotate(45deg);
    pointer-events:none;
  }
  select.control{ appearance:none; padding-right: 44px; }

  .items-help{
    font-size: 12px;
    color: var(--muted);
    margin-top: 4px;
  }

  .actions{
    display:flex;
    justify-content:flex-end;
    gap: 10px;
    padding-top: 18px;
    border-top: 1px solid var(--border);
    margin-top: 18px;
  }

  .btn{
    border: 1px solid var(--border);
    background: #fff;
    color: var(--text);
    padding: 10px 16px;
    border-radius: 14px;
    font-weight: 800;
    cursor:pointer;
    text-decoration:none;
  }
  .btn:hover{ filter: brightness(.98); }

  .btn-primary{
    background: var(--purple-400);
    border-color: rgba(109,60,255,.18);
    color: #fff;
  }
  .btn-primary:hover{ filter: brightness(.97); }

  .btn-ghost{
    background: #fff;
    color: var(--text);
  }
</style>

<div class="loan-wrap">
  <div class="loan-card">
    <div class="loan-header">
      <div>
        <h2 class="loan-title">Tambah Peminjaman</h2>
        <p class="loan-subtitle">Isi data peminjam dan pilih barang yang dipinjam.</p>
      </div>

      <a class="btn-back" href="<?php echo e(route('user.peminjaman.index')); ?>">
        ← Kembali
      </a>
    </div>

    <div class="loan-body">
      <?php if($errors->any()): ?>
        <div class="alert-errors">
          <strong>Terjadi kesalahan:</strong>
          <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?php echo e(route('user.peminjaman.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-grid">
          
          <div class="form-group">
            <div class="label">Tipe Peminjam</div>
            <div class="select-wrap">
              <select name="tipe_peminjam" class="control" required>
                <option value="">-- Pilih --</option>
                <option value="mahasiswa" <?php echo e(old('tipe_peminjam')=='mahasiswa' ? 'selected' : ''); ?>>Mahasiswa</option>
                <option value="dosen" <?php echo e(old('tipe_peminjam')=='dosen' ? 'selected' : ''); ?>>Dosen</option>
                <option value="bidang1" <?php echo e(old('tipe_peminjam')=='bidang1' ? 'selected' : ''); ?>>Bidang 1</option>
                <option value="bidang2" <?php echo e(old('tipe_peminjam')=='bidang2' ? 'selected' : ''); ?>>Bidang 2</option>
                <option value="bidang3" <?php echo e(old('tipe_peminjam')=='bidang3' ? 'selected' : ''); ?>>Bidang 3</option>
              </select>
            </div>
          </div>

          
          <div class="form-group">
            <div class="label">Tanggal Pinjam</div>
            <input type="date" name="tanggal_pinjam" class="control" value="<?php echo e(old('tanggal_pinjam')); ?>" required>
          </div>

          
          <div class="form-group span-2">
            <div class="label">Nama Peminjam</div>
            <input type="text" name="nama_peminjam" class="control" value="<?php echo e(old('nama_peminjam')); ?>" required>
          </div>

          
          <div class="form-group span-2">
            <div class="label">Barang yang Dipinjam</div>

            <div class="select-wrap">
              <select
                class="control"
                id="inventaris_select"
                required
                onchange="
                  const opt = this.options[this.selectedIndex];
                  document.getElementById('inventaris_id').value = opt.value || '';
                "
              >
                <option value="">-- Pilih Barang (yang belum dipinjam) --</option>

                <?php $__empty_1 = true; $__currentLoopData = $inventaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <option value="<?php echo e($i->id); ?>" <?php echo e(old('inventaris_id')==$i->id ? 'selected' : ''); ?>>
                    <?php echo e($i->nama_perangkat); ?> (<?php echo e($i->category->nama_kategori ?? '-'); ?>)
                  </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  
                <?php endif; ?>
              </select>
            </div>

            <input type="hidden" name="inventaris_id" id="inventaris_id" value="<?php echo e(old('inventaris_id')); ?>">

            <?php if($inventaris->isEmpty()): ?>
              <div class="items-help">Tidak ada barang tersedia (semua sedang dipinjam).</div>
            <?php else: ?>
              <div class="items-help">Pilih satu barang dari daftar yang tersedia.</div>
            <?php endif; ?>
          </div>

          
          <div class="form-group span-2">
            <div class="label">Keterangan</div>
            <textarea name="keterangan" class="control" rows="5" placeholder="Tambahkan keterangan jika perlu..."><?php echo e(old('keterangan')); ?></textarea>
          </div>
        </div>

        <div class="actions">
          <a href="<?php echo e(route('user.peminjaman.index')); ?>" class="btn btn-ghost">Batal</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  (function () {
    const oldId = <?php echo json_encode(old('inventaris_id'), 15, 512) ?>;
    if (oldId) {
      const select = document.getElementById('inventaris_select');
      if (select) select.value = String(oldId);
      const hidden = document.getElementById('inventaris_id');
      if (hidden) hidden.value = String(oldId);
    }
  })();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/peminjaman/create.blade.php ENDPATH**/ ?>