//import 'dart:convert';
import "package:flutter/material.dart";
import 'package:frontend/models/User.dart';
import 'package:frontend/pages/navigationbar_page.dart';
import 'package:frontend/services/application_service.dart';
//import 'package:shared_preferences/shared_preferences.dart';

class MyConnexionPage extends StatefulWidget {
  const MyConnexionPage({super.key});

  @override
  State<MyConnexionPage> createState() => _MyConnexionPageState();
}

class _MyConnexionPageState extends State<MyConnexionPage> {
  final _formKey = GlobalKey<FormState>();
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();
  bool _isObscure = true;
  final FocusNode _focusNode = FocusNode();
  final ApiService _apiService = ApiService();

  void _login() async {
    if (!_formKey.currentState!.validate()) return;

    final email = _emailController.text.trim();
    final password = _passwordController.text.trim();

    print('Email avant envoi: $email');
    print('Mot de passe avant envoi: $password');

    try {
      final response = await _apiService.login(email, password);

      // Création utilisateur
      final utilisateur = UserModel.fromJson(response['user']);

      // Nettoyage
      _emailController.clear();
      _passwordController.clear();

      // Navigation
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (_) => const MyNavigationPage()),
      );

      print('Connexion réussie: ${utilisateur.name}');
    } catch (e) {
      print('Connexion échouée: $e');
      ScaffoldMessenger.of(
        context,
      ).showSnackBar(SnackBar(content: Text('Erreur: $e')));
    }
  }

  @override
  void initState() {
    super.initState();
    _focusNode.addListener(() {
      setState(() {});
    });
  }

  @override
  void dispose() {
    _focusNode.dispose();
    _emailController.dispose();
    _passwordController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      resizeToAvoidBottomInset: true,
      body: SafeArea(
        child: SingleChildScrollView(
          child: Form(
            key: _formKey,
            child: Padding(
              padding: const EdgeInsets.all(10.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  const SizedBox(height: 180),
                  // Image de la boîte (tu peux la remplacer par ton image asset)
                  Center(
                    child: Icon(
                      Icons.inventory_2_outlined,
                      size: 120,
                      color: Colors.blue.shade700,
                    ),
                  ),

                  const SizedBox(height: 100),

                  // Titre Connexion
                  const Text(
                    "Connexion",
                    style: TextStyle(
                      fontSize: 20,
                      fontWeight: FontWeight.bold,
                      color: Colors.black87,
                    ),
                  ),

                  const SizedBox(height: 8),

                  const Text(
                    "Veuillez entrer vos identifiants de connexion pour accéder à votre compte.",
                    textAlign: TextAlign.center,
                    style: TextStyle(color: Colors.black54, fontSize: 14),
                  ),

                  const SizedBox(height: 20),

                  // Champ Email
                  TextFormField(
                    controller: _emailController,
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return "Veuillez remplir correctement le champ Adresse e-mail";
                      } else if (!value.contains("@") || !value.contains("")) {
                        return "Veuillez entrer une adresse e-mail valide";
                      }
                      return null;
                    },
                    decoration: InputDecoration(
                      prefixIcon: const Icon(Icons.email_outlined),
                      labelText: "Adresse e-mail",
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(12),
                        borderSide: const BorderSide(color: Colors.blue),
                      ),
                    ),
                  ),

                  const SizedBox(height: 20),

                  // Champ Mot de passe
                  TextFormField(
                    //obscureText: true,
                    focusNode: _focusNode,
                    controller: _passwordController,
                    obscureText: _isObscure,
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return "Veuillez entrer le bon mot de passe";
                      }
                      return null;
                    },
                    decoration: InputDecoration(
                      prefixIcon: const Icon(Icons.lock_outline),
                      labelText: "Mot de passe",
                      suffixIcon: IconButton(
                        onPressed: () {
                          setState(() {
                            _isObscure = !_isObscure;
                          });
                        },
                        icon: Icon(
                          _isObscure ? Icons.visibility : Icons.visibility_off,
                          color: _focusNode.hasFocus
                              ? Colors.blue
                              : Colors.white,
                        ),
                      ),
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(12),
                      ),
                    ),
                  ),

                  const SizedBox(height: 10),

                  // Mot de passe oublié
                  Align(
                    alignment: Alignment.centerRight,
                    child: TextButton(
                      onPressed: () {},
                      child: const Text(
                        "Mot de passe oublié?",
                        style: TextStyle(color: Colors.blue),
                      ),
                    ),
                  ),

                  const SizedBox(height: 10),

                  // Bouton Se connecter
                  SizedBox(
                    width: double.infinity,
                    child: ElevatedButton(
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.blue,
                        foregroundColor: Colors.white,
                        padding: const EdgeInsets.symmetric(vertical: 15),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12),
                        ),
                      ),
                      onPressed: _login,
                      child: const Text(
                        "Se connecter",
                        style: TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  ),

                  const SizedBox(height: 20),

                  // S'inscrire
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const Text("Vous n'avez pas de compte? "),
                      GestureDetector(
                        onTap: () {},
                        child: const Text(
                          "S'inscrire",
                          style: TextStyle(
                            color: Colors.grey,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}
