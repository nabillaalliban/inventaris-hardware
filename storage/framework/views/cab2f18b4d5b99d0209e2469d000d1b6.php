<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inventaris Hardware</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
<style>


/* ===== NAVBAR + SIDEBAR (lebih modern) ===== */
.navbar{
  height: 72px;
  background: linear-gradient(90deg, #BDA1FF, #a78bfa);
  margin: 18px 24px 0 24px;   /* jarak atas & kiri kanan */
  padding: 0 28px;
  color:white;
  display:flex;
  justify-content:space-between;
  align-items:center;
  border-radius: 24px;        /* atas & bawah rounded */
  box-shadow: 0 18px 40px rgba(139, 92, 246, .25);
  position: sticky;
  top: 10px;
  z-index: 50;
}



.brand{
  display:flex;
  align-items:center;
  gap:10px;
  font-weight: 900;
}

.brand-badge{
  width:36px;
  height:36px;
  border-radius:12px;
  background: rgba(255,255,255,.18);
  border:1px solid rgba(255,255,255,.25);
  display:grid;
  place-items:center;
}

.nav-right{
  display:flex;
  align-items:center;
  gap:10px;
}

.user-chip{
  padding:8px 14px;
  border-radius:999px;
  background: rgba(255,255,255,.20);
  backdrop-filter: blur(4px);
  border:1px solid rgba(255,255,255,.35);
  font-weight:800;
}


.btn-logout{
  padding:8px 12px;
  border-radius:999px;
  border:1px solid rgba(255,255,255,.22);
  background: rgba(0,0,0,.12);
  color:white;
  font-weight:700;
  cursor:pointer;
}
.searchbox{
  display:flex;
  align-items:center;
  gap: 8px;
  background: #ffffff;
  border: 1px solid rgba(167,139,250,0.25);
  border-radius: 999px;      /* pill */
  padding: 6px 10px;
  box-shadow: 0 8px 20px rgba(76, 29, 149, 0.08);
  max-width: 420px;
  width: 100%;
}
.searchbox .search-input{
  border: none;
  outline: none;
  background: transparent;
  width: 100%;
  font-size: 14px;
  padding: 8px 6px;
}
.searchbox button{
  border-radius: 999px;
  padding: 8px 16px;
}

.layout{
  display:grid;
  grid-template-columns: 280px 1fr;
  gap:20px;
  padding:20px;
  min-height: calc(100vh - 64px);
}

.sidebar{
  background:white;
  padding:16px;
  border-radius:18px;
  border:1px solid rgba(167,139,250,0.22);
  box-shadow: 0 14px 30px rgba(17,24,39,0.08);
}

.sidebar ul{
  list-style:none;
  padding:0;
  margin:0;
  display:flex;
  flex-direction:column;
  gap:10px;
}

.sidebar a{
  display:flex;
  align-items:center;
  gap:12px;
  padding:12px 14px;
  border-radius:16px;
  text-decoration:none;
  font-weight:800;
  color:#111827;
  background:#faf5ff;
  border:1px solid rgba(167,139,250,0.22);
}

.sidebar a.active{
  background: linear-gradient(90deg, rgba(167,139,250,.35), rgba(196,181,253,.6));
}

.content{
  padding:0;
}



  .table-wrap{
  margin-top: 16px;
  overflow:auto;
  border-radius: 14px;
  border: 1px solid rgba(167,139,250,0.25);
}

.table{
  width:100%;
  border-collapse: collapse;
  background: white;
}

.table th{
  text-align:left;
  font-size: 13px;
  color:#4c1d95;
  background: #f3e8ff; /* ungu sangat soft */
  padding: 12px 14px;
  white-space: nowrap;
}

.table td{
  padding: 12px 14px;
  border-top: 1px solid rgba(167,139,250,0.18);
  font-size: 14px;
}

.table tr:hover td{
  background: #faf5ff;
}

.btn{
  display:inline-block;
  padding: 8px 12px;
  border-radius: 10px;
  text-decoration:none;
  font-weight:600;
  border: 1px solid rgba(167,139,250,0.45);
  background: #ede9fe;
  color:#4c1d95;
}

.btn:hover{
  background:#ddd6fe;
}

.btn-danger{
  border-color: rgba(239,68,68,0.35);
  background: rgba(239,68,68,0.08);
  color:#b91c1c;
}
.btn-danger:hover{
  background: rgba(239,68,68,0.12);
}

/* css create*/
/* ===== FORM UI (ungu soft) ===== */

/* ===== THEME FORM (senada inventaris) ===== */
.form-wrap{
  max-width: 900px;
  margin: 0 auto;
}

.form-shell{
  border-radius: 18px;
  border: 1px solid rgba(167,139,250,0.22);
  overflow: hidden;
  box-shadow: 0 14px 30px rgba(17,24,39,0.08);
  background: white;
}

.form-top{
  padding: 18px 22px;
  background: linear-gradient(90deg, rgba(167,139,250,0.25), rgba(196,181,253,0.35));
  border-bottom: 1px solid rgba(167,139,250,0.18);
  display:flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
}

.form-top h2{
  margin:0;
  font-size: 18px;
  font-weight: 900;
  color:#2e1065;
}

.form-top p{
  margin:6px 0 0 0;
  font-size: 13px;
  color: rgba(76,29,149,0.75);
}

.form-body{
  padding: 22px;
}

.alert{
  border: 1px solid rgba(239,68,68,0.22);
  background: rgba(239,68,68,0.06);
  color:#991b1b;
  padding: 12px 14px;
  border-radius: 14px;
  margin-bottom: 14px;
}

.form-grid{
  display:grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 14px;
}

.form-group{
  display:flex;
  flex-direction: column;
  gap: 6px;
}

.form-group.full{
  grid-column: 1 / -1;
}

.label{
  font-size: 13px;
  font-weight: 800;
  color:#4c1d95;
}

.input, .select{
  width:100%;
  padding: 12px 12px;
  border-radius: 14px;
  border: 1px solid rgba(167,139,250,0.30);
  background: #faf5ff; /* ungu super soft biar senada */
  outline: none;
  transition: box-shadow .15s ease, border-color .15s ease, background .15s ease;
}

.input::placeholder{ color: rgba(76,29,149,0.35); }

.input:focus, .select:focus{
  background: white;
  border-color: rgba(167,139,250,0.75);
  box-shadow: 0 0 0 4px rgba(167,139,250,0.18);
}

.form-actions{
  display:flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 18px;
  padding-top: 18px;
  border-top: 1px solid rgba(167,139,250,0.15);
}

/* tombol primary (senada) */
.btn-primary{
  display:inline-block;
  padding: 10px 14px;
  border-radius: 12px;
  text-decoration:none;
  font-weight: 800;
  border: 1px solid rgba(167,139,250,0.55);
  background: linear-gradient(90deg, rgba(167,139,250,0.55), rgba(196,181,253,0.75));
  color:#2e1065;
  cursor:pointer;
}

.btn-primary:hover{
  filter: brightness(0.98);
}

/* tombol secondary */
.btn-secondary{
  display:inline-block;
  padding: 10px 14px;
  border-radius: 12px;
  text-decoration:none;
  font-weight: 800;
  border: 1px solid rgba(167,139,250,0.30);
  background: rgba(255,255,255,0.9);
  color:#4c1d95;
}

.btn-secondary:hover{
  background: rgba(255,255,255,1);
}

.card-transparent{
  background: transparent;
  box-shadow: none;
  border: none;
  padding: 0;
}

/* css admin */
/* ===== ADMIN DASHBOARD CARDS (ungu soft) ===== */
.dash-grid{
  display:grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 16px;
  margin-top: 16px;
}

.dash-card{
  border-radius: 16px;
  border: 1px solid rgba(167,139,250,0.22);
  background: white;
  box-shadow: 0 12px 26px rgba(17,24,39,0.06);
  overflow: hidden;
}

.dash-card .top{
  padding: 14px 16px;
  background: linear-gradient(90deg, rgba(167,139,250,0.25), rgba(196,181,253,0.35));
  border-bottom: 1px solid rgba(167,139,250,0.16);
  display:flex;
  align-items:center;
  justify-content: space-between;
  gap: 10px;
}

.dash-card .label{
  margin:0;
  font-size: 13px;
  font-weight: 800;
  color:#2e1065;
}

.dash-card .icon{
  width: 36px;
  height: 36px;
  border-radius: 12px;
  display:flex;
  align-items:center;
  justify-content:center;
  background: rgba(255,255,255,0.75);
  border: 1px solid rgba(167,139,250,0.25);
}

.dash-card .body{
  padding: 16px;
}

.dash-card .value{
  margin:0;
  font-size: 34px;
  font-weight: 900;
  color:#2e1065;
  letter-spacing: -0.5px;
}

.dash-card .hint{
  margin:6px 0 0 0;
  font-size: 12px;
  color: rgba(76,29,149,0.7);
}

/* Responsive */
@media (max-width: 1100px){
  .dash-grid{ grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 640px){
  .dash-grid{ grid-template-columns: 1fr; }
}



</style>


</head>
<body>

<nav class="navbar">
  <div class="brand">
    <div class="brand-badge">⚡</div>
    <div>SIPIKSI</div>
  </div>

  <div class="nav-right">
    <div class="user-chip">👤 <?php echo e(auth()->user()->name); ?></div>

    <form action="<?php echo e(route('logout')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</nav>

<!-- LAYOUT -->
<div class="layout">

    <!-- SIDEBAR -->
   <aside class="sidebar">
    <p class="menu-title">Menu</p>
    <ul>
        <?php if(auth()->user()->role == 'admin'): ?>
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                   class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                   📊 Dashboard
                </a>
                <li><a href="<?php echo e(route('admin.items.index')); ?>">📦 Data Barang</a></li>
<li><a href="<?php echo e(route('admin.loans.dashboard')); ?>">📊 Statistik Peminjaman</a></li>
<li><a href="<?php echo e(route('admin.loans.index')); ?>">📋 Riwayat Peminjaman</a></li>

            </li>
        <?php endif; ?>

        <?php if(auth()->user()->role == 'user'): ?>
            <li>
                <a href="<?php echo e(route('user.inventaris.index')); ?>"
                   class="<?php echo e(request()->routeIs('user.inventaris.*') ? 'active' : ''); ?>">
                   📦 Inventaris
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('user.categories.index')); ?>"
                   class="<?php echo e(request()->routeIs('user.categories.*') ? 'active' : ''); ?>">
                   🏷️ Kategori
                </a>
            </li>

            <li><a href="<?php echo e(route('user.items.index')); ?>">📦 Barang</a></li>
<?php if(auth()->user()->role == 'admin'): ?>
  <li><a href="<?php echo e(route('admin.cart.index')); ?>">🛒 Keranjang</a></li>
<?php endif; ?>
<li><a href="<?php echo e(route('user.loans.index')); ?>">📌 Riwayat Peminjaman</a></li>
<li><a href="<?php echo e(route('user.loans.stats')); ?>">📊 Statistik</a></li>
<li><a href="<?php echo e(route('user.inbounds.index')); ?>">📥 Barang Masuk</a></li>



            <li>
                <a href="<?php echo e(route('inventaris.exportPdf')); ?>"
                   class="<?php echo e(request()->routeIs('inventaris.exportPdf') ? 'active' : ''); ?>">
                   📄 Export PDF
                </a>
            </li>
        <?php endif; ?>
    </ul>
</aside>


    <!-- CONTENT -->
    <main class="content">
        <div class="card">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

</div>

</body>
</html>
<?php /**PATH /home/rpl-1/Bia/inventaris-hardware/resources/views/layouts/app.blade.php ENDPATH**/ ?>