class Person {
  final String firstName;
  final String lastName;
  String department;
  final String email;
  final String phoneNumber;
  final String? imageUrl;

  Person({
    required this.firstName,
    required this.lastName,
    required this.department,
    required this.email,
    required this.phoneNumber,
    this.imageUrl,
  });

  factory Person.fromJson(Map<String, dynamic> json) {
    return Person(
      firstName: json['firstName'],
      lastName: json['lastName'],
      department: json['department'],
      email: json['email'],
      phoneNumber: json['phone'],
      imageUrl: json['pp'],
    );
  }
}