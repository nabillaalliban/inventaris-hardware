import 'dart:convert';

import 'package:http/http.dart' as http;

import '../core/api_config.dart';
import '../models/item_model.dart';
import '../models/loan_model.dart';
import '../models/loan_stats_model.dart';
import '../models/user_model.dart';
import 'auth_storage.dart';

class LoginResponse {
  LoginResponse({
    required this.token,
    required this.user,
  });

  final String token;
  final UserModel user;
}

class ApiService {
  static Uri _uri(String path, [Map<String, String>? query]) {
    return Uri.parse('${ApiConfig.baseUrl}$path').replace(queryParameters: query);
  }

  static Future<Map<String, String>> _headers({bool auth = false}) async {
    final headers = <String, String>{
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    };

    if (auth) {
      final token = await AuthStorage.getToken();
      if (token != null) {
        headers['Authorization'] = 'Bearer $token';
      }
    }

    return headers;
  }

  static Future<LoginResponse> login({
    required String email,
    required String password,
  }) async {
    final response = await http.post(
      _uri('/login'),
      headers: await _headers(),
      body: jsonEncode({
        'email': email,
        'password': password,
      }),
    );

    final data = jsonDecode(response.body) as Map<String, dynamic>;

    if (response.statusCode >= 400) {
      throw Exception(data['message'] ?? 'Login gagal');
    }

    return LoginResponse(
      token: data['access_token'] ?? '',
      user: UserModel.fromJson(data['user'] as Map<String, dynamic>? ?? {}),
    );
  }

  static Future<void> logout() async {
    await http.post(
      _uri('/logout'),
      headers: await _headers(auth: true),
    );
    await AuthStorage.clearToken();
  }

  static Future<UserModel> me() async {
    final response = await http.get(
      _uri('/user'),
      headers: await _headers(auth: true),
    );

    final data = jsonDecode(response.body) as Map<String, dynamic>;
    if (response.statusCode >= 400) {
      throw Exception(data['message'] ?? 'Gagal mengambil user');
    }

    return UserModel.fromJson(data['data'] as Map<String, dynamic>? ?? {});
  }

  static Future<List<ItemModel>> fetchItems({String search = ''}) async {
    final response = await http.get(
      _uri('/items', search.isEmpty ? null : {'search': search}),
      headers: await _headers(auth: true),
    );

    final data = jsonDecode(response.body) as Map<String, dynamic>;
    if (response.statusCode >= 400) {
      throw Exception(data['message'] ?? 'Gagal mengambil barang');
    }

    final items = data['data'] as List<dynamic>? ?? [];
    return items
        .map((item) => ItemModel.fromJson(item as Map<String, dynamic>))
        .toList();
  }

  static Future<List<LoanModel>> fetchLoans() async {
    final response = await http.get(
      _uri('/loans'),
      headers: await _headers(auth: true),
    );

    final data = jsonDecode(response.body) as Map<String, dynamic>;
    if (response.statusCode >= 400) {
      throw Exception(data['message'] ?? 'Gagal mengambil pinjaman');
    }

    final loans = data['data'] as List<dynamic>? ?? [];
    return loans
        .map((loan) => LoanModel.fromJson(loan as Map<String, dynamic>))
        .toList();
  }

  static Future<LoanStatsModel> fetchLoanStats() async {
    final response = await http.get(
      _uri('/loan-stats'),
      headers: await _headers(auth: true),
    );

    final data = jsonDecode(response.body) as Map<String, dynamic>;
    if (response.statusCode >= 400) {
      throw Exception(data['message'] ?? 'Gagal mengambil statistik');
    }

    return LoanStatsModel.fromJson(data['data'] as Map<String, dynamic>? ?? {});
  }
}
