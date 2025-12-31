class Materiel {
  final int regionId;
  final int shopId;
  final int typeMatId;
  final String marque; //
  final String modele; //
  // ignore: non_constant_identifier_names
  final String numero_serie; //
  final int etat;
  final String observation;
  final String? photo;

  Materiel({
    required this.regionId,
    required this.shopId,
    required this.typeMatId,
    required this.marque,
    required this.modele,
    // ignore: non_constant_identifier_names
    required this.numero_serie,
    required this.etat,
    required this.observation,
    required this.photo,
  });

  Map<String, String> toMap() {
    return {
      'region_id': regionId.toString(),
      'shop_id': shopId.toString(),
      'type_mat_id': typeMatId.toString(),
      'marque': marque,
      'modele': modele,
      'numero_serie': numero_serie,
      'etat': etat.toString(),
      'observation': observation,
    };
  }

  factory Materiel.fromJson(Map<String, dynamic> json) {
    int parseInt(dynamic v) {
      if (v == null) return 0;
      if (v is int) return v;
      return int.tryParse(v.toString()) ?? 0;
    }

    final photoUrl = json['photo'] != null
        ? 'https://inventaire.bboxxdrc-pointage.com/' + json['photo']
        : null;
    // final photoUrl = json['photo'] != null
    //     ? 'https://www.inventaire.bboxxdrc-pointage.com/' + json['photo']
    //     : null;

    return Materiel(
      regionId: parseInt(json['region_id'] ?? json['regionId']),
      shopId: parseInt(json['shop_id'] ?? json['shopId']),
      typeMatId: parseInt(json['type_mat_id'] ?? json['typeMatId']),
      marque: json['marque']?.toString() ?? '',
      modele: json['modele']?.toString() ?? '',
      numero_serie:
          json['numero_serie']?.toString() ??
          json['numeroSerie']?.toString() ??
          '',
      etat: parseInt(json['etat']),
      observation: json['observation']?.toString() ?? '',
      photo: photoUrl,
    );
  }
}
