@extends('layouts.app')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
  <div>
    <h2 style="margin:0;color:#2e1065;font-weight:900;">Riwayat Peminjaman</h2>
    <p style="margin:6px 0 0 0;color:rgba(76,29,149,0.75);font-weight:700;">
      Kelola approval, jatuh tempo, dan pengembalian
    </p>
  </div>

  <a class="btn" href="{{ route('admin.loans.dashboard') }}">📊 Statistik</a>
</div>

{{-- Tabs Status --}}
<div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:14px;">
  <a class="btn" href="{{ route('admin.loans.index',['status'=>'pending']) }}">Pending</a>
  <a class="btn" href="{{ route('admin.loans.index',['status'=>'approved']) }}">Aktif</a>
  <a class="btn" href="{{ route('admin.loans.index',['status'=>'overdue']) }}">Jatuh Tempo</a>
  <a class="btn" href="{{ route('admin.loans.index',['status'=>'returned']) }}">Dikembalikan</a>
  <a class="btn" href="{{ route('admin.loans.index',['status'=>'rejected']) }}">Ditolak</a>
</div>

@if(session('success'))
  <p style="color:#15803d;font-weight:800;margin-top:10px;">{{ session('success') }}</p>
@endif

@if ($errors->any())
  <div style="margin-top:10px;color:#b91c1c;font-weight:800;">
    @foreach($errors->all() as $e) <div>- {{ $e }}</div> @endforeach
  </div>
@endif

<div class="table-wrap" style="margin-top:14px;">
  <table class="table">
    <tr>
      <th>No</th>
      <th>Pengaju</th>
      <th>Nama Peminjam</th>
      <th>Tipe</th>
      <th>Tgl Pinjam</th>
      <th>Jatuh Tempo</th>
      <th>Status</th>
      <th>Barang</th>
      <th>Aksi</th>
    </tr>

    @forelse($loans as $l)
      @php
        $isOverdue = ($l->status==='approved' && $l->due_date && $l->due_date < now()->toDateString());
      @endphp

      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $l->user?->name ?? '-' }}</td>
        <td>{{ $l->nama_peminjam }}</td>
        <td>{{ strtoupper($l->tipe_peminjam) }}</td>
        <td>{{ $l->tanggal_pinjam }}</td>
        <td>{{ $l->due_date ?? '-' }}</td>

        <td>
          @if($isOverdue)
            <span class="badge overdue">overdue</span>
          @else
            <span class="badge {{ $l->status }}">{{ $l->status }}</span>
          @endif
        </td>

        <td style="min-width:260px;">
          @foreach($l->items as $it)
            <div style="display:flex;justify-content:space-between;gap:10px;">
              <span>{{ $it->item?->nama_barang ?? '-' }}</span>
              <span style="font-weight:900;color:#2e1065;">x{{ $it->qty }}</span>
            </div>
          @endforeach
        </td>

        <td style="white-space:nowrap;">
          {{-- Pending: Approve / Reject --}}
          @if($l->status === 'pending')
            <form action="{{ route('admin.loans.approve',$l->id) }}" method="POST" style="display:inline;">
              @csrf
              <button type="submit" class="btn" onclick="return confirm('Setujui peminjaman ini?')">
                Approve
              </button>
            </form>

            <form action="{{ route('admin.loans.reject',$l->id) }}" method="POST" style="display:inline;">
              @csrf
              <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak peminjaman ini?')">
                Reject
              </button>
            </form>
          @endif

          {{-- Approved: Mark Returned --}}
          @if($l->status === 'approved')
            <form action="{{ route('admin.loans.returned',$l->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('PUT')

              <input type="date" name="tanggal_kembali" required
                style="border:1px solid rgba(167,139,250,0.35);border-radius:10px;padding:6px 8px;">

              <button type="submit" class="btn"
                onclick="return confirm('Tandai transaksi ini sudah dikembalikan?')">
                Mark Returned
              </button>
            </form>
          @endif

          {{-- Others --}}
          @if(in_array($l->status, ['returned','rejected']))
            <span style="color:rgba(76,29,149,0.75);font-weight:900;">-</span>
          @endif
        </td>
      </tr>

    @empty
      <tr><td colspan="9">Belum ada data.</td></tr>
    @endforelse
  </table>
</div>
@endsection
