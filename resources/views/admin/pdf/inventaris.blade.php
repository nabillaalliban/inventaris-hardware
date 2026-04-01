<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:6px; text-align:center; }
    </style>
</head>
<body>
<h2>Laporan Inventaris Hardware</h2>

<table>
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kondisi</th>
            <th>Lokasi</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inventaris as $item)
        <tr>
            <td>{{ $item->kode }}</td>
            <td>{{ $item->nama_perangkat }}</td>
            <td>{{ $item->kondisi }}</td>
            <td>{{ $item->lokasi }}</td>
            <td>{{ $item->tanggal_masuk }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
