import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:frontend/models/Materiel.dart';
import 'package:frontend/services/application_service.dart';
import 'package:shared_preferences/shared_preferences.dart';

class MyListeEnregistrementPage extends StatefulWidget {
  const MyListeEnregistrementPage({super.key});

  @override
  State<MyListeEnregistrementPage> createState() =>
      _MyListeEnregistrementPageState();
}

class _MyListeEnregistrementPageState extends State<MyListeEnregistrementPage> {
  final ApiService apiService = ApiService();
  List<Materiel>? materiels;
  String? token;

  @override
  void initState() {
    super.initState();
    _getEmail();
    _getMateriel();
  }

  Future<void> _getEmail() async {
    final prefs = await SharedPreferences.getInstance();
    final newToken = prefs.getString('token');

    if (!mounted) return;
    setState(() {
      token = newToken;
    });
  }

  Future<void> _getMateriel() async {
    try {
      final fetchMateriels = await apiService.recuperationMateriel();
      setState(() {
        materiels = fetchMateriels;
      });
    } catch (e) {
      print('Erreur lors de la récupération des matériels: $e');
    }
  }

  @override
  Widget build(BuildContext context) {
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
            centerTitle: true,
            title: const Text(
              'Liste d\'enregistrement',
              textAlign: TextAlign.center,
              style: TextStyle(color: Colors.white),
            ),
          ),
        ),
      ),
      body: materiels == null
          ? const Center(child: CircularProgressIndicator())
          : ListView.builder(
              itemCount: materiels!.length,
              itemBuilder: (context, index) {
                return Card(
                  color: Colors.white,
                  margin: const EdgeInsets.symmetric(
                    vertical: 8,
                    horizontal: 10,
                  ),
                  elevation: 5,
                  child: ListTile(
                    leading: materiels![index].photo != null
                        ? ClipOval(
                            child: CachedNetworkImage(
                              imageUrl: materiels![index].photo!,
                              width: 50,
                              height: 50,
                              fit: BoxFit.cover,
                              memCacheHeight: 100,
                              memCacheWidth: 100,
                              placeholder: (context, url) =>
                                  const CircularProgressIndicator(
                                    strokeWidth: 2,
                                  ),
                              errorWidget: (context, url, error) =>
                                  const Icon(Icons.broken_image, size: 50),
                            ),
                          )
                        : const Icon(Icons.photo_camera, size: 50),
                    title: Text(
                      '${index + 1}. ${materiels![index].marque ?? 'Non spécifié'}',
                      style: const TextStyle(
                        fontWeight: FontWeight.bold,
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
                    trailing: const Icon(Icons.chevron_right),
                  ),
                );
              },
            ),
    );
  }
}
