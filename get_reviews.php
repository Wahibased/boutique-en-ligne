<?php
require 'vendor/autoload.php';

// Connexion à MongoDB
$uri = "mongodb://username:password@localhost:27017/?connectTimeoutMS=300000&retryWrites=true";
$client = new MongoDB\Client($uri);
$db = $client->calin_bebe;


$collection = $db->avis;
$avis = $collection->find()->toArray();

header('Content-Type: application/json');
echo json_encode($avis);

