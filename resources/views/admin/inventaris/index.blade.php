@extends('layouts.app')

@section('content')

<style>
.toolbar{
    display:flex;
    justify-content: space-between; /* kiri & kanan */
    align-items: center;
    margin-bottom: 15px;
}

.searchbar{
    flex:1;
}

.top-action{
    margin-left: auto;
}
</style>

<div class="toolbar">

  <!-- SEARCH (KIRI) -->
  <div class="searchbar">
    <form method="GET" action="{{ route('admin.inventaris.index') }}" class="searchbox">
      <span style="font-size:16px;">🔎</span>

      <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        placeholder="Cari lokasi / perangkat / kode..."
        class="search-input"
      >

      <button class="btn btn-primary btn-sm" type="submit">Search</button>

      @if(request('q'))
        <a href="{{ route('admin.inventaris.index') }}" class="btn btn-secondary btn-sm">Reset</a>
      @endif
    </form>
  </div>

  <!-- TOMBOL (KANAN ATAS) -->
  <div class="top-action">
    <a href="{{ route('admin.inventaris.create') }}" class="btn">
      + Tambah Data
    </a>
  </div>

</div>


<div class="table-wrap">
  <table class="table">
    <tr>
      <th>No</th>
      <th>Kode</th>
      <th>Nama Perangkat</th>
      <th>Lokasi</th>
      <th>Kondisi</th>
      <th>Tanggal Masuk</th>
      <th>Kategori</th>
      <th>Aksi</th>
    </tr>

    @foreach($inventaris as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->kode }}</td>
      <td>{{ $item->nama_perangkat }}</td>
      <td>{{ $item->lokasi }}</td>
      <td>{{ $item->kondisi }}</td>
      <td>{{ $item->tanggal_masuk }}</td>
      <td>{{ $item->category?->nama_kategori ?? '-' }}</td>
      <td style="white-space:nowrap;">
        <a class="btn" href="{{ route('admin.inventaris.edit', $item->id) }}">Edit</a>

        <form action="{{ route('admin.inventaris.destroy', $item->id) }}"
              method="POST"
              style="display:inline;"
              onsubmit="return confirm('Yakin hapus data ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>

@endsection
