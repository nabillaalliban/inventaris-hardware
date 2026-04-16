@extends('layouts.app')

@section('content')
<style>
  .dashboard-admin {
    display: flex;
    flex-direction: column;
    gap: 22px;
  }

  .dashboard-showcase {
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

  .dashboard-showcase::before {
    content: "";
    position: absolute;
    inset: auto -60px -90px auto;
    width: 240px;
    height: 240px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(167,139,250,0.22), rgba(167,139,250,0));
    pointer-events: none;
  }

  .dashboard-showcase__inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: minmax(0, 1.4fr) minmax(260px, 0.8fr);
    gap: 20px;
    align-items: stretch;
  }

  .dashboard-showcase__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border-radius: 999px;
    background: rgba(255,255,255,0.78);
    border: 1px solid rgba(167,139,250,0.24);
    color: #4c1d95;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.3px;
    text-transform: uppercase;
  }

  .dashboard-showcase__title {
    margin: 16px 0 0 0;
    color: #2e1065;
    font-weight: 900;
    font-size: clamp(28px, 4vw, 40px);
    line-height: 1.08;
    max-width: 620px;
  }

  .dashboard-showcase__subtitle {
    margin: 12px 0 0 0;
    color: rgba(76,29,149,0.76);
    font-size: 14px;
    line-height: 1.8;
    max-width: 560px;
  }

  .dashboard-showcase__meta {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
    margin-top: 22px;
    max-width: 460px;
  }

  .dashboard-showcase__meta-card {
    padding: 14px 16px;
    border-radius: 18px;
    border: 1px solid rgba(167,139,250,0.2);
    background: rgba(255,255,255,0.72);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.65);
  }

  .dashboard-showcase__meta-label {
    margin: 0;
    color: rgba(76,29,149,0.7);
    font-size: 12px;
    font-weight: 700;
  }

  .dashboard-showcase__meta-value {
    margin: 8px 0 0 0;
    color: #2e1065;
    font-size: 24px;
    font-weight: 900;
    line-height: 1;
  }

  .dashboard-showcase__panel {
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

  .dashboard-showcase__panel-label {
    margin: 0;
    color: #4c1d95;
    font-size: 13px;
    font-weight: 800;
  }

  .dashboard-showcase__panel-number {
    margin: 6px 0 0 0;
    color: #2e1065;
    font-size: clamp(42px, 5vw, 54px);
    font-weight: 900;
    line-height: 1;
  }

  .dashboard-showcase__panel-copy {
    margin: 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
    line-height: 1.7;
  }

  .dashboard-showcase__progress {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .dashboard-showcase__track {
    width: 100%;
    height: 10px;
    border-radius: 999px;
    background: rgba(167,139,250,0.16);
    overflow: hidden;
  }

  .dashboard-showcase__fill {
    width: 72%;
    height: 100%;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(167,139,250,0.8), rgba(196,181,253,0.95));
  }

  .dashboard-showcase__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    font-size: 12px;
    color: rgba(76,29,149,0.7);
  }

  .dashboard-admin .dash-grid {
    margin-top: 0;
    gap: 18px;
  }

  .dashboard-admin .dash-card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-height: 225px;
    border-radius: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background: linear-gradient(180deg, rgba(255,255,255,1), rgba(250,245,255,0.96));
    box-shadow: 0 14px 30px rgba(17,24,39,0.07);
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .dashboard-admin .dash-card::after {
    content: "";
    position: absolute;
    top: 0;
    left: 18px;
    right: 18px;
    height: 4px;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(167,139,250,0.65), rgba(196,181,253,0.95));
  }

  .dashboard-admin .dash-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(17,24,39,0.1);
  }

  .dashboard-admin .dash-card .top {
    padding: 22px 20px 14px 20px;
    background: transparent;
    border-bottom: none;
    align-items: center;
  }

  .dashboard-admin .dash-card .label {
    margin: 0;
    max-width: 180px;
    color: #4c1d95;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.5;
  }

  .dashboard-admin .dash-card .icon {
    width: 52px;
    height: 52px;
    border-radius: 18px;
    background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(243,232,255,0.88));
    border: 1px solid rgba(167,139,250,0.24);
    box-shadow: 0 10px 22px rgba(76,29,149,0.08);
    font-size: 22px;
  }

  .dashboard-admin .dash-card .body {
    display: flex;
    flex: 1;
    flex-direction: column;
    justify-content: space-between;
    gap: 16px;
    padding: 0 20px 20px 20px;
  }

  .dashboard-admin .dash-card .value {
    margin: 0;
    color: #2e1065;
    font-size: clamp(38px, 4.3vw, 48px);
    font-weight: 900;
    line-height: 1;
    letter-spacing: -1px;
  }

  .dashboard-admin .dash-card .hint {
    margin: 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
    line-height: 1.7;
    max-width: 28ch;
  }

  .dash-card__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
  }

  .dash-card__line {
    flex: 1;
    height: 8px;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(167,139,250,0.55), rgba(196,181,253,0.88));
  }

  .dash-card__tag {
    padding: 6px 10px;
    border-radius: 999px;
    background: rgba(243,232,255,0.95);
    border: 1px solid rgba(167,139,250,0.18);
    color: #4c1d95;
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;
  }

  @media (max-width: 1100px) {
    .dashboard-showcase__inner {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 768px) {
    .dashboard-showcase {
      padding: 22px;
      border-radius: 22px;
    }

    .dashboard-showcase__meta {
      grid-template-columns: 1fr;
      max-width: none;
    }

    .dashboard-admin .dash-card {
      min-height: auto;
    }
  }
</style>

<div class="dashboard-admin">
  <section class="dashboard-showcase">
    <div class="dashboard-showcase__inner">
      <div>
        <div class="dashboard-showcase__eyebrow">Panel Monitoring Inventaris</div>
        <h2 class="dashboard-showcase__title">Dashboard Admin </h2>


        <div class="dashboard-showcase__meta">
          <div class="dashboard-showcase__meta-card">
            <p class="dashboard-showcase__meta-label">Total Kategori</p>
            <p class="dashboard-showcase__meta-value">{{ $jumlahKategori }}</p>
          </div>
          <div class="dashboard-showcase__meta-card">
            <p class="dashboard-showcase__meta-label">Total Barang</p>
            <p class="dashboard-showcase__meta-value">{{ $jumlahBarang }}</p>
          </div>
        </div>
      </div>

      <div class="dashboard-showcase__panel">
        <div>
          <p class="dashboard-showcase__panel-label">Ringkasan Utama</p>
          <p class="dashboard-showcase__panel-number">{{ $jumlahBarang }}</p>
          <p class="dashboard-showcase__panel-copy">
            Data inventaris aktif yang tercatat pada sistem dan siap dipantau melalui panel admin.
          </p>
        </div>

        <div class="dashboard-showcase__progress">
          <div class="dashboard-showcase__track">
            <div class="dashboard-showcase__fill"></div>
          </div>
          <div class="dashboard-showcase__footer">
            <span>Visual ringkasan inventaris</span>
            <span>Dashboard Admin</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="dash-grid">
    <div class="dash-card">
      <div class="top">
        <p class="label">Jumlah Kategori</p>
        <div class="icon">🏷️</div>
      </div>
      <div class="body">
        <p class="value">{{ $jumlahKategori }}</p>
        <p class="hint">Total kategori inventaris yang sudah terdaftar di dalam sistem.</p>
        <div class="dash-card__footer">
          <div class="dash-card__line"></div>
          <span class="dash-card__tag">Data Master</span>
        </div>
      </div>
    </div>

    <div class="dash-card">
      <div class="top">
        <p class="label">Jumlah Barang (Data)</p>
        <div class="icon">📦</div>
      </div>
      <div class="body">
        <p class="value">{{ $jumlahBarang }}</p>
        <p class="hint">Total seluruh data inventaris yang tersimpan dan dapat dikelola admin.</p>
        <div class="dash-card__footer">
          <div class="dash-card__line"></div>
          <span class="dash-card__tag">Inventaris</span>
        </div>
      </div>
    </div>

    <div class="dash-card">
      <div class="top">
        <p class="label">Kondisi Baik</p>
        <div class="icon">✅</div>
      </div>
      <div class="body">
        <p class="value">{{ $baik }}</p>
        <p class="hint">Perangkat dengan kondisi baik dan siap digunakan untuk operasional.</p>
        <div class="dash-card__footer">
          <div class="dash-card__line"></div>
          <span class="dash-card__tag">Siap Pakai</span>
        </div>
      </div>
    </div>

    <div class="dash-card">
      <div class="top">
        <p class="label">Kondisi Rusak</p>
        <div class="icon">⚠️</div>
      </div>
      <div class="body">
        <p class="value">{{ $rusak }}</p>
        <p class="hint">Perangkat yang memerlukan perhatian, perbaikan, atau tindak lanjut admin.</p>
        <div class="dash-card__footer">
          <div class="dash-card__line"></div>
          <span class="dash-card__tag">Perlu Tindak Lanjut</span>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
