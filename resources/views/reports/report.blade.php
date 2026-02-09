<h2>Laporan Inventaris</h2>

<h3>Data Barang</h3>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
  <th>Nama</th><th>Kategori</th><th>Jumlah</th><th>Kondisi</th>
</tr>
@foreach($items as $i)
<tr>
  <td>{{ $i->name }}</td>
  <td>{{ $i->category->name }}</td>
  <td>{{ $i->quantity }}</td>
  <td>{{ $i->condition }}</td>
</tr>
@endforeach
</table>

<h3>Data Lokasi</h3>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
  <th>Nama Lokasi</th><th>Baik</th><th>Rusak</th>
</tr>
@foreach($locations as $l)
<tr>
  <td>{{ $l->name }}</td>
  <td>{{ $l->good_quantity }}</td>
  <td>{{ $l->damaged_quantity }}</td>
</tr>
@endforeach
</table>
