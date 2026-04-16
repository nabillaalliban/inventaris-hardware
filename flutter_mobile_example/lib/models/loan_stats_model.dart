class LoanStatsModel {
  LoanStatsModel({
    required this.returned,
    required this.notReturned,
    required this.total,
  });

  final int returned;
  final int notReturned;
  final int total;

  factory LoanStatsModel.fromJson(Map<String, dynamic> json) {
    return LoanStatsModel(
      returned: json['returned'] ?? 0,
      notReturned: json['not_returned'] ?? 0,
      total: json['total'] ?? 0,
    );
  }
}
