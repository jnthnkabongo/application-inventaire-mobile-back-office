import 'dart:async';
import 'package:frontend/pages/page_connexion.dart';
import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';

class MyBienvenuePage extends StatefulWidget {
  const MyBienvenuePage({super.key});

  @override
  State<MyBienvenuePage> createState() => _MyBienvenuePageState();
}

class _MyBienvenuePageState extends State<MyBienvenuePage> {
  @override
  void initState() {
    super.initState();
    // Démarre le timer
    Timer(const Duration(seconds: 4), onLoaded);
  }

  void onLoaded() {
    // Vérifie que le widget est toujours monté avant de naviguer
    if (!mounted) return;

    Navigator.of(context).pushReplacement(
      MaterialPageRoute(builder: (context) => const MyConnexionPage()),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: Column(
          children: [
            const Spacer(), // espace haut
            // 🎯 Animation centrée
            Center(
              child: Lottie.asset(
                "assets/animations/loading3.json",
                width: 120,
                height: 120,
                repeat: true,
              ),
            ),

            // 📝 Texte en bas
            const Padding(
              padding: EdgeInsets.only(bottom: 44),
              child: Text(
                'Bienvenue...',
                style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold),
              ),
            ),
            const Spacer(), // pousse le texte en bas
          ],
        ),
      ),
    );
  }
}
