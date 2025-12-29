import 'dart:io';
import 'package:flutter/material.dart';
import 'package:frontend/models/Materiel.dart';
import 'package:frontend/services/application_service.dart';
import 'package:image_picker/image_picker.dart';

class MyEnregistrementPage extends StatefulWidget {
  const MyEnregistrementPage({super.key});

  @override
  State<MyEnregistrementPage> createState() => _MyEnregistrementPageState();
}

class _MyEnregistrementPageState extends State<MyEnregistrementPage> {
  final _formKey = GlobalKey<FormState>();

  int? regionId;
  int? shopId;
  int? typeMatId;
  int? etat;
  File? image;

  final picker = ImagePicker();

  final marqueController = TextEditingController();
  final modeleController = TextEditingController();
  final numeroSerieController = TextEditingController();
  final observationtionController = TextEditingController();

  final List<Map<String, dynamic>> regions = [
    {'id': 1, 'name': 'Kinshasa'},
    {'id': 2, 'name': 'Katanga'},
    {'id': 3, 'name': 'Ituri'},
  ];
  final List<Map<String, dynamic>> shops = [
    {'id': 1, 'name': 'HQ Kinshasa'},
    {'id': 2, 'name': 'DC Ngaliema'},
    {'id': 3, 'name': 'Shop Ngaliema'},
  ];

  final List<Map<String, dynamic>> typesMateriel = [
    {'id': 1, 'name': 'Ordinateur'},
    {'id': 2, 'name': 'Imprimante'},
    {'id': 3, 'name': 'Moniteur'},
  ];

  final List<Map<String, dynamic>> etats = [
    {'id': 1, 'name': 'Très bon'},
    {'id': 2, 'name': 'Bon'},
    {'id': 3, 'name': 'Légèrement bon'},
    {'id': 4, 'name': 'Mauvais'},
  ];

  Future<void> _pickImage(ImageSource source) async {
    final pickedFile = await picker.pickImage(source: source, imageQuality: 80);

    if (pickedFile != null) {
      setState(() {
        image = File(pickedFile.path);
      });
    }
  }

  Future<void> _soumettreFormulaire() async {
    if (!_formKey.currentState!.validate()) return;
    if (regionId == null ||
        shopId == null ||
        typeMatId == null ||
        etat == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Veuillez remplir tous les champs')),
      );
      return;
    }
    if (image == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Veuillez ajouter une photo')),
      );
      return;
    }

    final materiel = Materiel(
      regionId: regionId!,
      shopId: shopId!,
      typeMatId: typeMatId!,
      marque: marqueController.text,
      modele: modeleController.text,
      numero_serie: numeroSerieController.text,
      etat: etat!,
      observation: observationtionController.text,
      photo: '',
    );

    final success = await ApiService().soumissionMateriel(
      materiel: materiel,
      image: image!,
    );

    if (success) {
      ScaffoldMessenger.of(
        context,
      ).showSnackBar(const SnackBar(content: Text('Enregistrement reussi')));
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
            title: const Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Expanded(
                  child: Text(
                    'Enregistrement un élément',
                    textAlign: TextAlign.center,
                    style: TextStyle(color: Colors.white),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Form(
          key: _formKey,
          child: Column(
            children: [
              const SizedBox(height: 20),
              Row(
                children: [
                  Expanded(
                    child: Theme(
                      data: Theme.of(
                        context,
                      ).copyWith(canvasColor: Colors.white),
                      child: DropdownButtonFormField<int>(
                        decoration: const InputDecoration(
                          labelText: "Choisissez la region",
                          border: OutlineInputBorder(),
                          filled: true,
                          fillColor: Colors.white,
                        ),
                        items: regions
                            .map(
                              (e) => DropdownMenuItem<int>(
                                value: e['id'] as int,
                                child: Text(e['name'] as String),
                              ),
                            )
                            .toList(),
                        // ignore: deprecated_member_use
                        value: regionId, // valeur actuelle
                        onChanged: (value) {
                          setState(() {
                            regionId = value; // regionId est int?
                          });
                        },
                        validator: (value) => value == null
                            ? 'Veuillez sélectionner une région'
                            : null,
                      ),
                    ),
                  ),
                ],
              ),
              SizedBox(height: 10),
              Row(
                children: [
                  Expanded(
                    child: Theme(
                      data: Theme.of(
                        context,
                      ).copyWith(canvasColor: Colors.white),
                      child: DropdownButtonFormField<int>(
                        decoration: const InputDecoration(
                          labelText: "Choisissez votre localisation",
                          border: OutlineInputBorder(),
                          filled: true,
                          fillColor: Colors.white,
                        ),
                        items: shops
                            .map(
                              (e) => DropdownMenuItem<int>(
                                value: e['id'] as int,
                                child: Text(e['name'] as String),
                              ),
                            )
                            .toList(),
                        // ignore: deprecated_member_use
                        value: shopId,
                        onChanged: (value) {
                          setState(() {
                            shopId = value;
                          });
                        },
                        validator: (value) => value == null
                            ? 'Veuillez sélectionner une localisation'
                            : null,
                      ),
                    ),
                  ),
                ],
              ),
              SizedBox(height: 10),
              Row(
                children: [
                  Expanded(
                    child: Theme(
                      data: Theme.of(
                        context,
                      ).copyWith(canvasColor: Colors.white),
                      child: DropdownButtonFormField<int>(
                        decoration: const InputDecoration(
                          labelText: "Choisissez le type de matériel",
                          border: OutlineInputBorder(),
                          filled: true,
                          fillColor: Colors.white,
                        ),
                        items: typesMateriel
                            .map(
                              (e) => DropdownMenuItem<int>(
                                value: e['id'] as int,
                                child: Text(e['name'] as String),
                              ),
                            )
                            .toList(),
                        // ignore: deprecated_member_use
                        value: typeMatId,
                        onChanged: (value) {
                          setState(() {
                            typeMatId = value;
                          });
                        },
                        validator: (value) => value == null
                            ? 'Veuillez sélectionner un type de matériel'
                            : null,
                      ),
                    ),
                  ),
                ],
              ),
              SizedBox(height: 10),

              TextFormField(
                controller: marqueController,
                decoration: const InputDecoration(
                  labelText: 'Marque',
                  border: OutlineInputBorder(),
                ),
                validator: (value) =>
                    value!.isEmpty ? 'Champ obligatoire' : null,
              ),
              SizedBox(height: 10),

              TextFormField(
                controller: modeleController,
                decoration: const InputDecoration(
                  labelText: 'Modèle',
                  border: OutlineInputBorder(),
                ),
                validator: (value) =>
                    value!.isEmpty ? 'Champ obligatoire' : null,
              ),

              SizedBox(height: 10),

              TextFormField(
                controller: numeroSerieController,
                decoration: const InputDecoration(
                  labelText: 'Numéro série',
                  border: OutlineInputBorder(),
                ),
                validator: (value) =>
                    value!.isEmpty ? 'Champ obligatoire' : null,
              ),
              SizedBox(height: 10),

              Row(
                children: [
                  Expanded(
                    child: Theme(
                      data: Theme.of(
                        context,
                      ).copyWith(canvasColor: Colors.white),
                      child: DropdownButtonFormField<int>(
                        decoration: const InputDecoration(
                          labelText: "Choisissez l'état du matériel",
                          border: OutlineInputBorder(),
                          filled: true,
                          fillColor: Colors.white,
                        ),
                        items: etats
                            .map(
                              (e) => DropdownMenuItem<int>(
                                value: e['id'] as int,
                                child: Text(e['name'] as String),
                              ),
                            )
                            .toList(),
                        // ignore: deprecated_member_use
                        value: etat,
                        onChanged: (value) {
                          setState(() {
                            etat = value;
                          });
                        },
                        validator: (value) => value == null
                            ? 'Veuillez sélectionner l\'état de matériel'
                            : null,
                      ),
                    ),
                  ),
                ],
              ),
              SizedBox(height: 10),

              /// ✍️ CHAMP TEXTE
              TextFormField(
                controller: observationtionController,
                decoration: const InputDecoration(
                  labelText: 'Description',
                  border: OutlineInputBorder(),
                ),
                maxLines: 3,
                validator: (value) =>
                    value!.isEmpty ? 'Champ obligatoire' : null,
              ),

              const SizedBox(height: 24),

              GestureDetector(
                onTap: () {
                  showModalBottomSheet(
                    context: context,
                    builder: (_) => SafeArea(
                      child: Wrap(
                        children: [
                          ListTile(
                            leading: const Icon(Icons.camera_alt),
                            title: const Text('Prendre une photo'),
                            onTap: () {
                              Navigator.pop(context);
                              _pickImage(ImageSource.camera);
                            },
                          ),
                          ListTile(
                            leading: const Icon(Icons.photo_library),
                            title: const Text('Choisir depuis la galerie'),
                            onTap: () {
                              Navigator.pop(context);
                              _pickImage(ImageSource.gallery);
                            },
                          ),
                        ],
                      ),
                    ),
                  );
                },
                child: Container(
                  height: 180,
                  width: double.infinity,
                  decoration: BoxDecoration(
                    color: Colors.grey[200],
                    borderRadius: BorderRadius.circular(12),
                    border: Border.all(color: Colors.blueAccent),
                  ),
                  child: image == null
                      ? const Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Icon(
                              Icons.camera_alt,
                              size: 40,
                              color: Colors.blueAccent,
                            ),
                            SizedBox(height: 8),
                            Text('Ajouter une photo'),
                          ],
                        )
                      : Stack(
                          children: [
                            ClipRRect(
                              borderRadius: BorderRadius.circular(12),
                              child: Image.file(
                                image!,
                                width: double.infinity,
                                height: double.infinity,
                                fit: BoxFit.cover,
                              ),
                            ),
                            Positioned(
                              top: 8,
                              right: 8,
                              child: CircleAvatar(
                                backgroundColor: Colors.black54,
                                child: IconButton(
                                  icon: const Icon(
                                    Icons.edit,
                                    color: Colors.white,
                                  ),
                                  onPressed: () {
                                    _pickImage(ImageSource.gallery);
                                  },
                                ),
                              ),
                            ),
                          ],
                        ),
                ),
              ),

              const SizedBox(height: 24),

              /// ✅ BOUTON
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.blueAccent,
                    padding: const EdgeInsets.symmetric(vertical: 14),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(10),
                    ),
                  ),
                  onPressed: _soumettreFormulaire,
                  child: const Text(
                    'ENREGISTRER',
                    style: TextStyle(color: Colors.white, fontSize: 16),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
