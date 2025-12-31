import 'dart:convert';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:frontend/models/Materiel.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class ApiService {
  final String baseUrl = 'https://inventaire.bboxxdrc-pointage.com/api';
  /* Android : 'http://10.0.2.2:8000/api' Ios : 'http://127.0.0.1:8000/api'; Le lien de l'application dans le serveur 'https://inventaire.bboxxdrc-pointage.com/api';*/
  final FlutterSecureStorage _storage = const FlutterSecureStorage();

  Future<Map<String, dynamic>> login(String email, String password) async {
    final response = await http.post(
      Uri.parse('$baseUrl/connexion'),
      headers: {
        'Content-Type': 'application/json; charset=UTF-8',
        'Accept': 'application/json',
      },
      body: jsonEncode({'email': email, 'password': password}),
    );

    print('Status code: ${response.statusCode}');
    print('Response body: ${response.body}');

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body); // ✅ ici c'est suffisant

      if (data == null || data['user'] == null) {
        throw Exception('Réponse invalide du serveur');
      }

      // Stockage local
      final prefs = await SharedPreferences.getInstance();
      await prefs
        ..setString('access_token', data['token'] ?? '')
        ..setString('name', data['user']['name'] ?? '')
        ..setString('email', data['user']['email'] ?? '')
        ..setString('role_name', data['user']['role_name'] ?? '');

      print("✅ Données sauvegardées : ${data['user']['name']}");
      return data;
    } else {
      throw Exception(
        'Erreur de connexion : ${response.statusCode} - ${response.body}',
      );
    }
  }

  Future<Map<String, dynamic>> getUserinfo() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('access_token');
    if (token == null) {
      throw Exception('Token non trouver');
    }

    final response = await http.get(
      Uri.parse('$baseUrl/users'),
      headers: {'Authorization': 'Bearer $token'},
    );

    if (response.statusCode == 200) {
      final userData = json.decode(response.body);

      print('Informations utilisateur : $userData');
      return userData;
    } else {
      print(
        'Erreur lors de la récupération des informations de l\'utilisateur: ${response.statusCode}',
      );
      print('Corps de la réponse: ${response.body}');
      throw Exception('Echec de la recuperation des informations');
    }
  }

  Future<bool> soumissionMateriel({
    required Materiel materiel,
    required File image,
  }) async {
    try {
      final prefs = await SharedPreferences.getInstance();
      final token = prefs.getString('access_token');
      if (token == null) {
        throw Exception('Token non trouvé');
      }

      final uri = Uri.parse('$baseUrl/enregistrer-materiel');
      final request = http.MultipartRequest('POST', uri);

      request.headers.addAll({
        'Accept': 'application/json',
        'Authorization': 'Bearer $token',
      });

      // Champs texte
      request.fields.addAll(materiel.toMap());

      // Vérifiez si le champ photo est bien défini
      if (image.path.isNotEmpty && await image.exists()) {
        debugPrint('Image path: ${image.path}');
        request.files.add(
          await http.MultipartFile.fromPath('photo', image.path),
        );
      } else {
        debugPrint('Le fichier n\'existe pas ou le chemin est vide');
        return false;
      }

      final streamedResponse = await request.send();
      final response = await http.Response.fromStream(streamedResponse);

      debugPrint('STATUS: ${response.statusCode}');
      debugPrint('BODY: ${response.body}');

      // Traitez les erreurs spécifiques ici
      if (response.statusCode == 422) {
        final Map<String, dynamic> errorData = json.decode(response.body);
        debugPrint('Erreurs: ${errorData['errors']}');
      }

      return response.statusCode == 201;
    } catch (e) {
      debugPrint('Erreur réseau: $e');
      return false;
    }
  }

  Future<List<Materiel>> recuperationMateriel() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('access_token');
    if (token == null) {
      throw Exception('Token non trouver');
    }

    final response = await http.get(
      Uri.parse('$baseUrl/liste-materiels'),
      headers: {'Authorization': 'Bearer $token', 'Accept': 'application/json'},
    );

    if (response.statusCode == 200) {
      final jsonResponse = json.decode(response.body);
      final List<dynamic> jsonList = jsonResponse['data'];

      return jsonList.map((json) => Materiel.fromJson(json)).toList();
    } else {
      throw Exception(
        'Erreur de la récupération des matériels : ${response.statusCode}',
      );
    }
  }

  Future<void> logout() async {
    final token = await _storage.read(key: 'acces_token');

    if (token != null) {
      await http.post(
        Uri.parse('$baseUrl/logout'),
        headers: {'Accept': 'application/json'},
      );
    }

    await _storage.delete(key: 'access_token');
    print("Déconnexion réussie");
  }

  Future<List<Map<String, dynamic>>> getRegions() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('access_token');
    if (token == null) {
      throw Exception('Token non trouver');
    }

    final response = await http.get(
      Uri.parse('$baseUrl/combo-region'),
      headers: {'Authorization': 'Bearer $token', 'Accept': 'application/json'},
    );

    if (response.statusCode == 200) {
      final body = jsonDecode(response.body);
      print("RESPONSE $baseUrl/combo-region => $body");
      return List<Map<String, dynamic>>.from(body['data']);
    } else {
      print("Erreur $baseUrl/combo-region => ${response.statusCode} ${response.body}");
      throw Exception('Erreur chargement $baseUrl/combo-region');
    }
  }

  Future<List<Map<String, dynamic>>> getShops() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('access_token');
    if (token == null) {
      throw Exception('Token non trouver');
    }

    final response = await http.get(
      Uri.parse('$baseUrl/combo-shop'),
      headers: {'Authorization': 'Bearer $token', 'Accept': 'application/json'},
    );

    if (response.statusCode == 200) {
      final body = jsonDecode(response.body);
      print("RESPONSE $baseUrl/combo-shop => $body");
      return List<Map<String, dynamic>>.from(body['data']);
    } else {
      print("Erreur $baseUrl/combo-shop => ${response.statusCode} ${response.body}");
      throw Exception('Erreur chargement $baseUrl/combo-shop');
    }
  }

  Future<List<Map<String, dynamic>>> getTypes() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('access_token');
    if (token == null) {
      throw Exception('Token non trouver');
    }

    final response = await http.get(
      Uri.parse('$baseUrl/combo-type-mat'),
      headers: {'Authorization': 'Bearer $token', 'Accept': 'application/json'},
    );

    if (response.statusCode == 200) {
      final body = jsonDecode(response.body);
      print("RESPONSE $baseUrl/combo-type-mat => $body");
      return List<Map<String, dynamic>>.from(body['data']);
    } else {
      print("Erreur $baseUrl/combo-type-mat => ${response.statusCode} ${response.body}");
      throw Exception('Erreur chargement $baseUrl/combo-type-mat');
    }
  }

  Future<List<Map<String, dynamic>>> getEtats() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('access_token');
    if (token == null) {
      throw Exception('Token non trouver');
    }

    final response = await http.get(
      Uri.parse('$baseUrl/combo-etat'),
      headers: {'Authorization': 'Bearer $token', 'Accept': 'application/json'},
    );

    if (response.statusCode == 200) {
      final body = jsonDecode(response.body);
      print("RESPONSE $baseUrl/combo-etat => $body");
      return List<Map<String, dynamic>>.from(body['data']);
    } else {
      print("Erreur $baseUrl/combo-etat => ${response.statusCode} ${response.body}");
      throw Exception('Erreur chargement $baseUrl/combo-etat');
    }

  }
}
