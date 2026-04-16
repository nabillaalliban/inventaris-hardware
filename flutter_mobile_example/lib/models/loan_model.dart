class LoanItemModel {
  LoanItemModel({
    required this.namaBarang,
    required this.qty,
    required this.kategori,
  });

  final String namaBarang;
  final int qty;
  final String kategori;

  factory LoanItemModel.fromJson(Map<String, dynamic> json) {
    final item = json['item'] as Map<String, dynamic>? ?? {};
    final category = item['category'] as Map<String, dynamic>? ?? {};

    return LoanItemModel(
      namaBarang: item['nama_barang'] ?? '-',
      qty: json['qty'] ?? 0,
      kategori: category['nama_kategori'] ?? '-',
    );
  }
}

class LoanModel {
  LoanModel({
    required this.id,
    required this.namaPeminjam,
    required this.tipePeminjam,
    required this.tanggalPinjam,
    required this.dueDate,
    required this.status,
    required this.items,
  });

  final int id;
  final String namaPeminjam;
  final String tipePeminjam;
  final String tanggalPinjam;
  final String dueDate;
  final String status;
  final List<LoanItemModel> items;

  factory LoanModel.fromJson(Map<String, dynamic> json) {
    final rawItems = (json['items'] as List<dynamic>? ?? [])
        .map((item) => LoanItemModel.fromJson(item as Map<String, dynamic>))
        .toList();

    return LoanModel(
      id: json['id'] ?? 0,
      namaPeminjam: json['nama_peminjam'] ?? '-',
      tipePeminjam: json['tipe_peminjam'] ?? '-',
      tanggalPinjam: json['tanggal_pinjam'] ?? '-',
      dueDate: json['due_date'] ?? '-',
      status: json['status'] ?? '-',
      items: rawItems,
    );
  }
}
