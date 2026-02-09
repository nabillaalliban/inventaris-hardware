@extends('layouts.app')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:16px;">
  <h2 style="margin:0;color:#2e1065;font-weight:900;">Daftar Kategori</h2>
  <a href="{{ route('user.categories.create') }}" class="btn">+ Tambah Kategori</a>
</div>

@if(session('success'))
  <p style="color:#15803d;font-weight:700;margin:0 0 10px 0;">{{ session('success') }}</p>
@endif

<div class="table-wrap">
  <table class="table">
    <tr>
      <th style="width:70px;">No</th>
      <th>Nama Kategori</th>
      <th style="width:160px;">Aksi</th>
    </tr>

    @foreach($categories as $category)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $category->nama_kategori }}</td>
      <td style="white-space:nowrap;">
        <a class="btn" href="{{ route('user.categories.edit', $category->id) }}">Edit</a>

        <form action="{{ route('user.categories.destroy', $category->id) }}"
              method="POST"
              style="display:inline;"
              onsubmit="return confirm('Yakin hapus kategori?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" style="cursor:pointer;">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
