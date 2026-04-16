@extends('layouts.app')

@section('content')
<style>
  .inbound-page {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .inbound-hero {
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

  .inbound-hero::after {
    content: "";
    position: absolute;
    right: -40px;
    bottom: -60px;
    width: 200px;
    height: 200px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(167,139,250,0.18), rgba(167,139,250,0));
    pointer-events: none;
  }

  .inbound-hero__inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: minmax(0, 1.3fr) minmax(220px, 0.7fr);
    gap: 18px;
    align-items: center;
  }

  .inbound-hero__eyebrow {
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

  .inbound-hero__title {
    margin: 14px 0 0 0;
    color: #2e1065;
    font-size: clamp(28px, 3.8vw, 38px);
    font-weight: 900;
    line-height: 1.08;
  }

  .inbound-hero__subtitle {
    margin: 10px 0 0 0;
    color: rgba(76,29,149,0.74);
    font-size: 14px;
    line-height: 1.8;
    max-width: 560px;
  }

  .inbound-hero__actions {
    display: flex;
    justify-content: flex-end;
    align-items: stretch;
  }

  .inbound-add-btn {
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

  .inbound-summary {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
  }

  .inbound-summary__card {
    padding: 18px 20px;
    border-radius: 20px;
    border: 1px solid rgba(167,139,250,0.22);
    background: linear-gradient(180deg, rgba(255,255,255,1), rgba(250,245,255,0.96));
    box-shadow: 0 12px 28px rgba(17,24,39,0.06);
  }

  .inbound-summary__label {
    margin: 0;
    color: rgba(76,29,149,0.72);
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }

  .inbound-summary__value {
    margin: 10px 0 0 0;
    color: #2e1065;
    font-size: 32px;
    font-weight: 900;
    line-height: 1;
  }

  .inbound-summary__hint {
    margin: 8px 0 0 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
    line-height: 1.6;
  }

  .inbound-alert {
    padding: 14px 16px;
    border-radius: 16px;
    border: 1px solid rgba(34,197,94,0.18);
    background: rgba(240,253,244,0.95);
    color: #15803d;
    font-weight: 800;
    box-shadow: 0 10px 20px rgba(21,128,61,0.06);
  }

  .inbound-table-shell {
    border-radius: 24px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.94);
    box-shadow: 0 16px 34px rgba(17,24,39,0.07);
    overflow: hidden;
  }

  .inbound-table-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 20px 22px;
    border-bottom: 1px solid rgba(167,139,250,0.16);
    background: linear-gradient(90deg, rgba(167,139,250,0.16), rgba(196,181,253,0.18));
  }

  .inbound-table-head h3 {
    margin: 0;
    color: #2e1065;
    font-size: 18px;
    font-weight: 900;
  }

  .inbound-table-head p {
    margin: 6px 0 0 0;
    color: rgba(76,29,149,0.7);
    font-size: 13px;
  }

  .inbound-table-count {
    padding: 8px 14px;
    border-radius: 999px;
    border: 1px solid rgba(167,139,250,0.22);
    background: rgba(255,255,255,0.82);
    color: #4c1d95;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
  }

  .inbound-table-shell .table-wrap {
    margin-top: 0;
    border: none;
    border-radius: 0;
  }

  .inbound-table-shell .table th {
    padding: 14px 18px;
  }

  .inbound-table-shell .table td {
    padding: 16px 18px;
    vertical-align: middle;
  }

  .inbound-index {
    width: 44px;
    height: 44px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(243,232,255,0.95);
    border: 1px solid rgba(167,139,250,0.2);
    color: #4c1d95;
    font-weight: 900;
  }

  .inbound-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .inbound-item strong {
    color: #2e1065;
    font-size: 15px;
  }

  .inbound-item span {
    color: rgba(76,29,149,0.68);
    font-size: 12px;
  }

  .inbound-qty {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 72px;
    padding: 8px 12px;
    border-radius: 999px;
    background: rgba(243,232,255,0.95);
    border: 1px solid rgba(167,139,250,0.18);
    color: #2e1065;
    font-weight: 900;
  }

  .inbound-date,
  .inbound-note {
    color: rgba(76,29,149,0.78);
    line-height: 1.6;
  }

  .inbound-empty {
    text-align: center;
    color: rgba(76,29,149,0.72);
    padding: 26px 18px;
  }

  @media (max-width: 900px) {
    .inbound-hero__inner {
      grid-template-columns: 1fr;
    }

    .inbound-hero__actions {
      justify-content: flex-start;
    }
  }

  @media (max-width: 640px) {
    .inbound-summary {
      grid-template-columns: 1fr;
    }

    .inbound-table-head {
      flex-direction: column;
      align-items: flex-start;
    }

    .inbound-add-btn {
      min-width: 0;
      width: 100%;
    }
  }
</style>

<div class="inbound-page">
  <section class="inbound-hero">
    <div class="inbound-hero__inner">
      <div>
        <div class="inbound-hero__eyebrow">Mutasi Stok Masuk</div>
        <h2 class="inbound-hero__title">Barang Masuk</h2>
        
      </div>

      <div class="inbound-hero__actions">
        <a class="inbound-add-btn" href="{{ route('admin.inbounds.create') }}">+ Tambah Barang Masuk</a>
      </div>
    </div>
  </section>

  <section class="inbound-summary">
    <div class="inbound-summary__card">
      <p class="inbound-summary__label">Total Riwayat</p>
      <p class="inbound-summary__value">{{ $logs->count() }}</p>
      <p class="inbound-summary__hint">Jumlah transaksi barang masuk yang tercatat pada sistem.</p>
    </div>

    <div class="inbound-summary__card">
      <p class="inbound-summary__label">Status Monitoring</p>
      <p class="inbound-summary__value">Aktif</p>
      <p class="inbound-summary__hint">Data stok masuk siap dipantau dan digunakan untuk pencatatan inventaris.</p>
    </div>
  </section>

  @if(session('success'))
    <div class="inbound-alert">{{ session('success') }}</div>
  @endif

  <section class="inbound-table-shell">
    <div class="inbound-table-head">
      <div>
        <h3>Riwayat Barang Masuk</h3>
        <p>Daftar mutasi masuk berdasarkan barang, jumlah, tanggal, dan keterangan tambahan.</p>
      </div>
      <div class="inbound-table-count">{{ $logs->count() }} Data</div>
    </div>

    <div class="table-wrap">
      <table class="table">
        <tr>
          <th style="width:90px;">No</th>
          <th>Nama Barang</th>
          <th style="width:130px;">Qty Masuk</th>
          <th style="width:160px;">Tanggal</th>
          <th>Keterangan</th>
        </tr>

        @forelse($logs as $l)
          <tr>
            <td>
              <span class="inbound-index">{{ $loop->iteration }}</span>
            </td>
            <td>
              <div class="inbound-item">
                <strong>{{ $l->item?->nama_barang ?? '-' }}</strong>
                <span>Data barang inventaris</span>
              </div>
            </td>
            <td>
              <span class="inbound-qty">{{ $l->qty_masuk }}</span>
            </td>
            <td class="inbound-date">{{ $l->tanggal_masuk }}</td>
            <td class="inbound-note">{{ $l->keterangan ?? '-' }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="inbound-empty">Belum ada data barang masuk.</td>
          </tr>
        @endforelse
      </table>
    </div>
  </section>
</div>
@endsection
