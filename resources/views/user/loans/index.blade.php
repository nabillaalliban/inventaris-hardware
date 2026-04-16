@extends('layouts.app')

@section('content')
<style>
  .user-loans-page {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .user-loans-hero {
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

  .user-loans-hero::after {
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

  .user-loans-hero__inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: minmax(0, 1.3fr) minmax(220px, 0.7fr);
    gap: 18px;
    align-items: center;
  }

  .user-loans-hero__eyebrow {
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

  .user-loans-hero__title {
    margin: 14px 0 0 0;
    color: #2e1065;
    font-size: clamp(28px, 3.8vw, 38px);
    font-weight: 900;
    line-height: 1.08;
  }

  .user-loans-hero__subtitle {
    margin: 10px 0 0 0;
    color: rgba(76,29,149,0.74);
    font-size: 14px;
    line-height: 1.8;
    max-width: 560px;
  }

  .user-loans-hero__actions {
    display: flex;
    justify-content: flex-end;
    align-items: stretch;
  }

  .user-loans-stat-btn {
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

  .user-loans-summary {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
  }

  .user-loans-summary__card {
    padding: 18px 20px;
    border-radius: 20px;
    border: 1px solid rgba(167,139,250,0.22);
    background: linear-gradient(180deg, rgba(255,255,255,1), rgba(250,245,255,0.96));
    box-shadow: 0 12px 28px rgba(17,24,39,0.06);
  }

  .user-loans-summary__label {
    margin: 0;
    color: rgba(76,29,149,0.72);
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }

  .user-loans-summary__value {
    margin: 10px 0 0 0;
    color: #2e1065;
    font-size: 32px;
    font-weight: 900;
    line-height: 1;
  }

  .user-loans-summary__hint {
    margin: 8px 0 0 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
    line-height: 1.6;
  }

  .user-loans-alert {
    padding: 14px 16px;
    border-radius: 16px;
    border: 1px solid rgba(34,197,94,0.18);
    background: rgba(240,253,244,0.95);
    color: #15803d;
    font-weight: 800;
    box-shadow: 0 10px 20px rgba(21,128,61,0.06);
  }

  .user-loans-table-shell {
    border-radius: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.94);
    box-shadow: 0 16px 34px rgba(17,24,39,0.07);
    overflow: hidden;
  }

  .user-loans-table-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 20px 22px;
    border-bottom: 1px solid rgba(167,139,250,0.16);
    background: linear-gradient(90deg, rgba(167,139,250,0.16), rgba(196,181,253,0.18));
  }

  .user-loans-table-head h3 {
    margin: 0;
    color: #2e1065;
    font-size: 18px;
    font-weight: 900;
  }

  .user-loans-table-head p {
    margin: 6px 0 0 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
  }

  .user-loans-table-count {
    padding: 8px 14px;
    border-radius: 999px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.82);
    color: #4c1d95;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
  }

  .user-loans-table-shell .table-wrap {
    margin-top: 0;
    border: none;
    border-radius: 0;
  }

  .user-loans-table-shell .table th {
    padding: 14px 16px;
    white-space: nowrap;
  }

  .user-loans-table-shell .table td {
    padding: 16px;
    vertical-align: top;
  }

  .user-loans-index {
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

  .user-loans-person {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .user-loans-person strong {
    color: #2e1065;
    font-size: 14px;
  }

  .user-loans-person span,
  .user-loans-date,
  .user-loans-type {
    color: rgba(76,29,149,0.75);
  }

  .user-loans-type {
    font-weight: 800;
  }

  .user-loans-status {
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

  .user-loans-status.pending {
    background: rgba(254,249,195,0.95);
    color: #854d0e;
  }

  .user-loans-status.approved {
    background: rgba(219,234,254,0.95);
    color: #1d4ed8;
  }

  .user-loans-status.returned {
    background: rgba(220,252,231,0.95);
    color: #15803d;
  }

  .user-loans-status.rejected {
    background: rgba(254,226,226,0.95);
    color: #b91c1c;
  }

  .user-loans-items {
    display: flex;
    flex-direction: column;
    gap: 8px;
    min-width: 240px;
  }

  .user-loans-item-row {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 8px 10px;
    border-radius: 12px;
    background: rgba(250,245,255,0.95);
    border: 1px solid rgba(167,139,250,0.12);
  }

  .user-loans-item-row strong {
    color: #2e1065;
  }

  .user-loans-qty {
    font-weight: 900;
    color: #2e1065;
  }

  .user-loans-empty {
    text-align: center;
    color: rgba(76,29,149,0.72);
    padding: 28px 18px;
  }

  @media (max-width: 900px) {
    .user-loans-hero__inner {
      grid-template-columns: 1fr;
    }

    .user-loans-hero__actions,
    .user-loans-table-head {
      justify-content: flex-start;
    }

    .user-loans-table-head {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  @media (max-width: 640px) {
    .user-loans-summary {
      grid-template-columns: 1fr;
    }

    .user-loans-stat-btn {
      min-width: 0;
      width: 100%;
    }
  }
</style>

<div class="user-loans-page">
  <section class="user-loans-hero">
    <div class="user-loans-hero__inner">
      <div>
        <div class="user-loans-hero__eyebrow">Peminjaman Saya</div>
        <h2 class="user-loans-hero__title">Riwayat Peminjaman</h2>
        <p class="user-loans-hero__subtitle">
          Lihat semua transaksi peminjaman yang kamu ajukan, lengkap dengan status, jatuh tempo, dan daftar barang.
        </p>
      </div>

      <div class="user-loans-hero__actions">
        <a class="user-loans-stat-btn" href="{{ route('user.loans.stats') }}">📊 Statistik</a>
      </div>
    </div>
  </section>

  <section class="user-loans-summary">
    <div class="user-loans-summary__card">
      <p class="user-loans-summary__label">Total Riwayat</p>
      <p class="user-loans-summary__value">{{ $loans->count() }}</p>
      <p class="user-loans-summary__hint">Jumlah seluruh transaksi peminjaman yang pernah kamu ajukan.</p>
    </div>

    <div class="user-loans-summary__card">
      <p class="user-loans-summary__label">Status Data</p>
      <p class="user-loans-summary__value">Aktif</p>
      <p class="user-loans-summary__hint">Data peminjaman siap dipantau untuk melihat progres approval dan pengembalian.</p>
    </div>
  </section>

  @if(session('success'))
    <div class="user-loans-alert">{{ session('success') }}</div>
  @endif

  <section class="user-loans-table-shell">
    <div class="user-loans-table-head">
      <div>
        <h3>Daftar Riwayat Peminjaman</h3>
        <p>Menampilkan data peminjam, tipe, tanggal, jatuh tempo, status, dan barang yang diajukan.</p>
      </div>
      <div class="user-loans-table-count">{{ $loans->count() }} Data</div>
    </div>

    <div class="table-wrap">
      <table class="table">
        <tr>
          <th style="width:80px;">No</th>
          <th>Nama Peminjam</th>
          <th>Tipe</th>
          <th>Tgl Pinjam</th>
          <th>Jatuh Tempo</th>
          <th>Status</th>
          <th>Barang</th>
        </tr>

        @forelse($loans as $l)
          <tr>
            <td><span class="user-loans-index">{{ $loop->iteration }}</span></td>
            <td>
              <div class="user-loans-person">
                <strong>{{ $l->nama_peminjam }}</strong>
                <span>Data peminjam</span>
              </div>
            </td>
            <td class="user-loans-type">{{ strtoupper($l->tipe_peminjam) }}</td>
            <td class="user-loans-date">{{ $l->tanggal_pinjam }}</td>
            <td class="user-loans-date">{{ $l->due_date ?? '-' }}</td>
            <td><span class="user-loans-status {{ $l->status }}">{{ $l->status }}</span></td>

            <td>
              <div class="user-loans-items">
                @foreach($l->items as $it)
                  <div class="user-loans-item-row">
                    <strong>{{ $it->item?->nama_barang ?? '-' }}</strong>
                    <span class="user-loans-qty">x{{ $it->qty }}</span>
                  </div>
                @endforeach
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="user-loans-empty">Belum ada data.</td></tr>
        @endforelse
      </table>
    </div>
  </section>
</div>
@endsection
