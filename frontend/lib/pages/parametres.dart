import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

class MyParametresPage extends StatefulWidget {
  const MyParametresPage({super.key});

  @override
  State<MyParametresPage> createState() => _MyParametresPageState();
}

class _MyParametresPageState extends State<MyParametresPage> {
  String? utilisateur;
  String? token;
  String? email;

  @override
  void initState() {
    super.initState();
    _getEmail();
  }

  Future<void> _getEmail() async {
    final prefs = await SharedPreferences.getInstance();

    final newUser = prefs.getString('name');
    final newToken = prefs.getString('token');
    final newEmail = prefs.getString('email');

    if (!mounted) return;
    setState(() {
      utilisateur = newUser;
      token = newToken;
      email = newEmail;
    });
  }

  @override
  Widget build(BuildContext context) {
    if (utilisateur == null || email == null) {
      return const Center(child: CircularProgressIndicator());
    }
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: PreferredSize(
        preferredSize: const Size.fromHeight(kToolbarHeight),
        child: Container(
          decoration: BoxDecoration(
            color: Colors.blueAccent,
            boxShadow: [
              BoxShadow(
                color: Colors.black.withOpacity(0.2),
                spreadRadius: 0,
                blurRadius: 5,
                offset: const Offset(0, 2),
              ),
            ],
          ),
          child: AppBar(
            automaticallyImplyLeading: true,
            backgroundColor: Colors.transparent,
            elevation: 0,
            title: const Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Expanded(
                  child: Text(
                    'Paramètres',
                    textAlign: TextAlign.center,
                    style: TextStyle(color: Colors.white),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16.0, vertical: 16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const SizedBox(height: 20),

              // Header utilisateur
              Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: Colors.white.withOpacity(0.05),
                  borderRadius: BorderRadius.circular(12),
                ),
                child: Row(
                  children: [
                    const CircleAvatar(
                      radius: 30,
                      backgroundColor: Colors.blueAccent,
                      child: Icon(Icons.person, color: Colors.white, size: 30),
                    ),
                    const SizedBox(width: 12),
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          utilisateur!.toUpperCase(),
                          style: const TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        const SizedBox(height: 4),
                        Text(
                          email!.toUpperCase(),
                          style: const TextStyle(
                            fontSize: 14,
                            color: Colors.grey,
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 20),

              // Liste des options
              Expanded(
                child: ListView(
                  physics: const BouncingScrollPhysics(),
                  children: [
                    _buildListTile(Icons.notifications, 'Notifications'),
                    _buildListTile(Icons.lock, 'Changer le mot de passe'),
                    _buildListTile(Icons.language, 'Langue'),
                    _buildListTile(Icons.person, 'Profil'),
                    _buildListTile(Icons.help, 'Aide'),
                  ],
                ),
              ),

              // Bouton de déconnexion
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: () {
                    // Logique de déconnexion
                  },
                  style: ElevatedButton.styleFrom(
                    padding: const EdgeInsets.symmetric(vertical: 16),
                    backgroundColor: Colors.blueAccent,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12),
                    ),
                  ),
                  child: const Text(
                    'Déconnexion',
                    style: TextStyle(fontSize: 18, color: Colors.white),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildListTile(IconData icon, String title) {
    return Card(
      color: Colors.white,
      margin: const EdgeInsets.symmetric(vertical: 8),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      elevation: 3,
      child: ListTile(
        leading: Icon(icon, color: Colors.blueAccent),
        title: Text(title, style: const TextStyle(fontSize: 18)),
        trailing: const Icon(
          Icons.arrow_forward_ios,
          color: Colors.blueAccent,
          size: 18,
        ),
        onTap: () {
          // Logique pour chaque option
        },
      ),
    );
  }
}
