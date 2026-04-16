import 'package:flutter/material.dart';

import 'screens/home_screen.dart';
import 'screens/login_screen.dart';
import 'services/auth_storage.dart';

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  final token = await AuthStorage.getToken();
  runApp(SipiksiApp(initialToken: token));
}

class SipiksiApp extends StatelessWidget {
  const SipiksiApp({super.key, required this.initialToken});

  final String? initialToken;

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'SIPIKSI Mobile',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        useMaterial3: true,
        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color(0xFFA78BFA),
          primary: const Color(0xFFA78BFA),
        ),
        scaffoldBackgroundColor: const Color(0xFFF8F5FF),
        cardTheme: const CardThemeData(
          color: Colors.white,
          elevation: 0,
          margin: EdgeInsets.zero,
        ),
        inputDecorationTheme: InputDecorationTheme(
          filled: true,
          fillColor: const Color(0xFFFAF5FF),
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(14),
            borderSide: BorderSide(color: Colors.deepPurple.shade100),
          ),
          enabledBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(14),
            borderSide: BorderSide(color: Colors.deepPurple.shade100),
          ),
          focusedBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(14),
            borderSide: const BorderSide(color: Color(0xFFA78BFA), width: 1.5),
          ),
        ),
      ),
      home: initialToken == null ? const LoginScreen() : const HomeScreen(),
    );
  }
}
