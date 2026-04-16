@extends('layouts.app')

@section('content')
<style>
  .user-loan-stats {
    display: flex;
    flex-direction: column;
    gap: 22px;
  }

  .user-loan-stats__hero {
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

  .user-loan-stats__hero::before {
    content: "";
    position: absolute;
    inset: auto -60px -90px auto;
    width: 240px;
    height: 240px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(167,139,250,0.22), rgba(167,139,250,0));
    pointer-events: none;
  }

  .user-loan-stats__hero-inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: minmax(0, 1.35fr) minmax(240px, 0.75fr);
    gap: 20px;
    align-items: stretch;
  }

  .user-loan-stats__eyebrow {
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

  .user-loan-stats__title {
    margin: 16px 0 0 0;
    color: #2e1065;
    font-weight: 900;
    font-size: clamp(28px, 4vw, 40px);
    line-height: 1.08;
    max-width: 620px;
  }

  .user-loan-stats__subtitle {
    margin: 12px 0 0 0;
    color: rgba(76,29,149,0.76);
    font-size: 14px;
    line-height: 1.8;
    max-width: 560px;
  }

  .user-loan-stats__panel {
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

  .user-loan-stats__panel-label {
    margin: 0;
    color: #4c1d95;
    font-size: 13px;
    font-weight: 800;
  }

  .user-loan-stats__panel-number {
    margin: 6px 0 0 0;
    color: #2e1065;
    font-size: clamp(42px, 5vw, 54px);
    font-weight: 900;
    line-height: 1;
  }

  .user-loan-stats__panel-copy {
    margin: 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
    line-height: 1.7;
  }

  .user-loan-stats__track {
    width: 100%;
    height: 10px;
    border-radius: 999px;
    background: rgba(167,139,250,0.16);
    overflow: hidden;
  }

  .user-loan-stats__fill {
    width: 74%;
    height: 100%;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(167,139,250,0.8), rgba(196,181,253,0.95));
  }

  .user-loan-stats__footer {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    color: rgba(76,29,149,0.7);
    font-size: 12px;
  }

  .user-loan-stats .stats-grid {
    margin-top: 0;
    gap: 18px;
  }

  .user-loan-stats .stat-card {
    position: relative;
    border-radius: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background: linear-gradient(180deg, rgba(255,255,255,1), rgba(250,245,255,0.96));
    box-shadow: 0 14px 30px rgba(17,24,39,0.07);
    padding: 22px 20px;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .user-loan-stats .stat-card::after {
    content: "";
    position: absolute;
    top: 0;
    left: 18px;
    right: 18px;
    height: 4px;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(167,139,250,0.65), rgba(196,181,253,0.95));
  }

  .user-loan-stats .stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(17,24,39,0.1);
  }

  .user-loan-stats .stat-card span {
    display: block;
    color: #4c1d95;
    font-weight: 800;
    font-size: 13px;
    line-height: 1.6;
  }

  .user-loan-stats .stat-card h1 {
    margin: 12px 0 0 0;
    font-size: clamp(40px, 4.5vw, 52px);
    color: #2e1065;
    line-height: 1;
  }

  @media (max-width: 1100px) {
    .user-loan-stats__hero-inner {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 768px) {
    .user-loan-stats__hero {
      padding: 22px;
      border-radius: 22px;
    }
  }
</style>

<div class="user-loan-stats">
  <section class="user-loan-stats__hero">
    <div class="user-loan-stats__hero-inner">
      <div>
        <div class="user-loan-stats__eyebrow">Statistik Saya</div>
        <h2 class="user-loan-stats__title">Statistik Peminjaman Saya</h2>
        <p class="user-loan-stats__subtitle">
          Ringkasan pengembalian berdasarkan transaksi untuk membantu kamu memantau status pinjaman yang sudah selesai maupun yang masih berjalan.
        </p>
      </div>

      <div class="user-loan-stats__panel">
        <div>
          <p class="user-loan-stats__panel-label">Total Transaksi</p>
          <p class="user-loan-stats__panel-number">{{ $returned + $notReturned }}</p>
          <p class="user-loan-stats__panel-copy">
            Total transaksi peminjaman yang tercatat pada akun kamu dan ditampilkan pada statistik ini.
          </p>
        </div>

        <div>
          <div class="user-loan-stats__track">
            <div class="user-loan-stats__fill"></div>
          </div>
          <div class="user-loan-stats__footer">
            <span>Monitoring pengembalian</span>
            <span>Akun user</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="stats-grid">
    <div class="stat-card">
      <span>Sudah Dikembalikan</span>
      <h1>{{ $returned }}</h1>
    </div>

    <div class="stat-card">
      <span>Belum Dikembalikan</span>
      <h1>{{ $notReturned }}</h1>
    </div>
  </div>
</div>

@endsection
