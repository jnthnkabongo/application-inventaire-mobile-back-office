import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:frontend/models/Materiel.dart';
import 'package:frontend/services/application_service.dart';
import 'package:shared_preferences/shared_preferences.dart';

class MyAccueilPage extends StatefulWidget {
  const MyAccueilPage({super.key});

  @override
  State<MyAccueilPage> createState() => _MyAccueilPageState();
}

class _MyAccueilPageState extends State<MyAccueilPage> {
  final ApiService apiService = ApiService();
  List<Materiel>? materiels;
  String? token;
  String? utilisateur;
  String? role;
  String? email;

  @override
  void initState() {
    super.initState();
    _getEmail();
    _dataMateriel();
  }

  Future<void> _getEmail() async {
    final prefs = await SharedPreferences.getInstance();

    final newUser = prefs.getString('name');
    final newRole = prefs.getString('role_name');
    final newEmail = prefs.getString('email');
    final newToken = prefs.getString('token');

    if (!mounted) return;
    setState(() {
      utilisateur = newUser;
      role = newRole;
      email = newEmail;
      token = newToken;
    });
  }

  Future<void> _dataMateriel() async {
    try {
      final fetchedMateriels = await apiService.recuperationMateriel();
      setState(() {
        materiels = fetchedMateriels;
      });
    } catch (e) {
      print('Erreur lors de la récupération des matériels: $e');
    }
  }

  @override
  Widget build(BuildContext context) {
    if (utilisateur == null || email == null || role == null) {
      return const Center(child: CircularProgressIndicator());
    }
    return Container(
      color: Colors.white,
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        children: [
          Container(
            decoration: BoxDecoration(
              color: Colors.blueAccent,
              borderRadius: BorderRadius.circular(20),
            ),
            width: double.infinity,
            padding: const EdgeInsets.symmetric(vertical: 60, horizontal: 15),
            child: Row(
              children: [
                const Icon(Icons.account_circle, size: 80, color: Colors.white),
                const SizedBox(width: 15),
                Flexible(
                  child: Text(
                    "Bienvenu(e), ${utilisateur!.toUpperCase()}",
                    maxLines: 1,
                    softWrap: false,
                    overflow: TextOverflow.ellipsis,
                    style: const TextStyle(
                      fontSize: 13,
                      letterSpacing: 0.5,
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                    ),
                  ),
                ),
              ],
            ),
          ),

          const SizedBox(height: 5),
          //Text("Liste des matériels inventoriés"),
          Padding(
            padding: const EdgeInsets.symmetric(vertical: 4),
            child: Text(
              "Liste des matériels inventoriés",
              style: const TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.w600,
                color: Colors.blue,
              ),
            ),
          ),
          Expanded(
            child: materiels == null
                ? const Center(child: CircularProgressIndicator())
                : ListView.builder(
                    padding: EdgeInsets.zero,
                    itemCount: materiels!.length,
                    itemBuilder: (context, index) {
                      return Card(
                        color: Colors.white,
                        margin: const EdgeInsets.symmetric(
                          vertical: 8,
                          horizontal: 10,
                        ),
                        elevation: 2,
                        child: ListTile(
                          leading: materiels![index].photo != null
                              // ? ClipOval(
                              //     child: Image.network(
                              //       materiels![index]
                              //           .photo!, // Affichage de l'image
                              //       width: 50,
                              //       height: 50,
                              //       fit: BoxFit.cover,
                              //     ),
                              //   )
                              ? ClipOval(
                                  child: CachedNetworkImage(
                                    imageUrl: materiels![index].photo!,
                                    width: 50,
                                    height: 50,
                                    fit: BoxFit.cover,
                                    memCacheWidth: 100,
                                    memCacheHeight: 100,
                                    placeholder: (context, url) =>
                                        const SizedBox(
                                          width: 50,
                                          height: 50,
                                          child: CircularProgressIndicator(
                                            strokeWidth: 2,
                                          ),
                                        ),
                                    errorWidget: (context, url, error) =>
                                        const Icon(
                                          Icons.broken_image,
                                          size: 50,
                                        ),
                                  ),
                                )
                              : Icon(Icons.photo_camera, size: 50),
                          title: Text(
                            '${index + 1}. ${materiels![index].marque ?? 'Non spécifié'}',
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 16,
                              color: Colors.blueAccent,
                            ),
                          ),
                          subtitle: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                'Modèle: ${materiels![index].modele ?? 'Non spécifié'}',
                              ),
                              Text(
                                'Numéro de série: ${materiels![index].numero_serie ?? 'Non spécifié'}',
                              ),
                            ],
                          ),
                          trailing: Icon(Icons.chevron_right),
                          contentPadding: const EdgeInsets.all(10),
                          onTap: () {
                            // Action de clic ici, si nécessaire
                          },
                        ),
                      );
                    },
                  ),
          ),
        ],
      ),
    );
  }
}
