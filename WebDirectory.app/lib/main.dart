import 'package:flutter/material.dart';
import 'package:webdir_app/services/api_service.dart';
import 'pages/list_page.dart';
import 'models/person.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'SAE WebDirectory App',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primarySwatch: Colors.blue,
        visualDensity: VisualDensity.adaptivePlatformDensity,
      ),
      home: FutureBuilder<List<Person>>(
        future: fetchPersons(),
        builder: (context, snapshot) {
          if (snapshot.hasData) {
            return ListPage(persons: snapshot.data!);
          } else if (snapshot.hasError) {
            return Text("${snapshot.error}");
          }

          return CircularProgressIndicator();
        },
      ),
    );
  }
}
