class Department {
  final String name;
  final int stage;
  final String description;

  Department({
    required this.name,
    required this.stage,
    required this.description,
  });

  factory Department.fromJson(Map<String, dynamic> json) {
    return Department(
      name: json['name'],
      stage: json['stage'],
      description: json['description'],
    );
  }
}