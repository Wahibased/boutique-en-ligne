<?php
// Charger les bibliothèques installées via Composer
require 'vendor/autoload.php';

// Connexion à MongoDB
$uri = "mongodb://username:password@localhost:27017/?connectTimeoutMS=300000&retryWrites=true";
$client = new MongoDB\Client($uri);
$db = $client->calin_bebe;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $commentaire = $_POST['commentaire'];
    $note = (int)$_POST['note'];

    // Ajouter l'avis dans la collection
    $collection = $db->avis;
    $collection->insertOne([
        'nom' => $nom,
        'commentaire' => $commentaire,
        'note' => $note,
       
    ]);

    header('Location: index.php');
    exit;
}


