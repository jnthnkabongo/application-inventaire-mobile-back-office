class UserModel {
  final int id;
  final String name;
  final String email;
  final int roleId;

  UserModel({
    required this.id,
    required this.name,
    required this.email,
    required this.roleId,
  });

  factory UserModel.fromJson(Map<String, dynamic> json) {
    return UserModel(
      id: json['id'],
      name: json['name'],
      email: json['email'],
      roleId: json['role_id'],
    );
  }
}
