@extends('layouts.app')

@section('content')


<a href="{{ route('user.inventaris.create') }}" class="btn">+ Tambah Data</a>

  <form method="GET" action="{{ route('user.inventaris.index') }}" style="display:flex; gap:10px; align-items:center;">
    <input
      type="text"
      name="q"
      value="{{ request('q') }}"
      placeholder="Cari lokasi / perangkat / kode (contoh: lab 201 kode 1)"
      class="input"
      style="min-width:320px;"
    >
    <button class="btn btn-primary" type="submit">Search</button>

    @if(request('q'))
      <a href="{{ route('user.inventaris.index') }}" class="btn btn-secondary">Reset</a>
    @endif
  </form>
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
        <a class="btn" href="{{ route('user.inventaris.edit', $item->id) }}">Edit</a>

        <form action="{{ route('user.inventaris.destroy', $item->id) }}"
              method="POST"
              style="display:inline;"
              onsubmit="return confirm('Yakin hapus data ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" style="cursor:pointer;">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>


</table>
@endsection
