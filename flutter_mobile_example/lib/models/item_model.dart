class ItemModel {
  ItemModel({
    required this.id,
    required this.namaBarang,
    required this.harga,
    required this.stok,
    required this.tanggal,
    required this.kategori,
    this.fotoUrl,
  });

  final int id;
  final String namaBarang;
  final int harga;
  final int stok;
  final String tanggal;
  final String kategori;
  final String? fotoUrl;

  factory ItemModel.fromJson(Map<String, dynamic> json) {
    return ItemModel(
      id: json['id'] ?? 0,
      namaBarang: json['nama_barang'] ?? '-',
      harga: json['harga'] ?? 0,
      stok: json['stok'] ?? 0,
      tanggal: json['tanggal'] ?? '-',
      kategori: json['category']?['nama_kategori'] ?? '-',
      fotoUrl: json['foto_url'],
    );
  }
}
