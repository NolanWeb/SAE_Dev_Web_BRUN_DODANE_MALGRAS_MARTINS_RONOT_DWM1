import 'package:http/http.dart' as http;
import 'dart:convert';
import '../models/person.dart';
import '../models/department.dart';

Future<Department> fetchDepartment(String uuid) async {
  final response = await http.get(Uri.parse('http://docketu.iutnc.univ-lorraine.fr:30001/api/department/id/$uuid'));

  if (response.statusCode == 200) {
    Map<String, dynamic> jsonResponse = json.decode(response.body);
    return Department.fromJson(jsonResponse);
  } else {
    throw Exception('Failed to load department from API');
  }
}

Future<List<Person>> fetchPersons() async {
  final response = await http.get(Uri.parse('http://docketu.iutnc.univ-lorraine.fr:30001/api/entry/all'));

  if (response.statusCode == 200) {
    List jsonResponse = json.decode(response.body);
    List<Person> persons = jsonResponse.map((item) => Person.fromJson(item)).toList();

    // Fetch departments for each person
    List<Future<Department>> departmentFutures = persons.map((person) => fetchDepartment(person.department)).toList();
    List<Department> departments = await Future.wait(departmentFutures);

    // Update persons with department information
    for (int i = 0; i < persons.length; i++) {
      persons[i].department = departments[i].name; // Assurez-vous que votre modèle Person a un champ pour le nom du département
    }

    return persons;
  } else {
    throw Exception('Failed to load persons from API');
  }
}