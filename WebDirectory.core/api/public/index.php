<?php

require_once __DIR__ . '/../src/vendor/autoload.php';

/* Configure CORS */
header("Access-Control-Allow-Origin: *"); // Permet l'accès depuis tous les domaines. Pour restreindre, remplacez * par un domaine spécifique, par exemple, "https://example.com".
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Méthodes HTTP autorisées
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // En-têtes autorisés

/* Handle preflight requests */
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204);
    exit;
}

/* application boostrap */
$app = require_once __DIR__ . '/../src/conf/bootstrap.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$app->run();
