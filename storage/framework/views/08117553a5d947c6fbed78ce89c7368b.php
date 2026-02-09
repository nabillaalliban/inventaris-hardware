<?php $__env->startSection('content'); ?>
<h2>Tambah Peminjaman</h2>

<?php if($errors->any()): ?>
  <div style="color:red;">
    <ul>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
<?php endif; ?>

<form action="<?php echo e(route('user.peminjaman.store')); ?>" method="POST">
<?php echo csrf_field(); ?>

<label>Tipe Peminjam</label><br>
<select name="tipe_peminjam" required>
    <option value="">-- Pilih --</option>
    <option value="mahasiswa">Mahasiswa</option>
    <option value="dosen">Dosen</option>
    <option value="bidang1">Bidang 1</option>
    <option value="bidang2">Bidang 2</option>
    <option value="bidang3">Bidang 3</option>
</select><br><br>

<label>Nama Peminjam</label><br>
<input type="text" name="nama_peminjam" required><br><br>

<label>Nama Barang</label><br>
<input type="text"
       id="nama_barang"
       placeholder="Klik pilih barang"
       readonly
       required>
<input type="hidden" name="inventaris_id" id="inventaris_id">
<br><br>

<!-- daftar barang -->
<div style="border:1px solid #ddd;padding:10px;border-radius:8px;">
    <strong>Pilih Barang:</strong>
    <ul style="list-style:none;padding-left:0;">
        <?php $__currentLoopData = $inventaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li style="margin:6px 0;">
                <button type="button"
                    onclick="
                      document.getElementById('nama_barang').value='<?php echo e($i->nama_perangkat); ?>';
                      document.getElementById('inventaris_id').value='<?php echo e($i->id); ?>';
                    "
                    class="btn">
                    <?php echo e($i->nama_perangkat); ?>

                    (<?php echo e($i->category->nama_kategori ?? '-'); ?>)
                </button>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>

<br>

<label>Tanggal Pinjam</label><br>
<input type="date" name="tanggal_pinjam" required><br><br>

<label>Keterangan</label><br>
<textarea name="keterangan"></textarea><br><br>

<button type="submit" class="btn">Simpan</button>
<a href="<?php echo e(route('user.peminjaman.index')); ?>" class="btn btn-danger">Batal</a>

</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/user/peminjaman/create.blade.php ENDPATH**/ ?>