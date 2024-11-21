<?php

$host = 'localhost',
$db   = 'boutique',
$user = 'root',
$pass = '',
$charset = 'utf8mb4',




$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
// Connexion MongoDB
require 'vendor/autoload.php'; // Charger l'autoloader de Composer

// Utiliser le namespace MongoDB
use MongoDB\Client;

// Configurer l'URI de connexion
$uri = "mongodb+srv://wahi2024:wahi2024@cluster0.3les9.mongodb.net/calin_bebe";

// Créer une instance de client MongoDB
$client = new Client($uri);

// Sélectionner la base de données et la collection
$database = $client->selectDatabase('calin_bebe');  // Remplacer par le nom de votre base
$collection = $database->selectCollection('avis'); // Remplacer par le nom de votre collection

