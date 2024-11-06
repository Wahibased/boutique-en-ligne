<?php
require 'vendor/autoload.php'; // Charger le package MongoDB

// Configurer la connexion MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");
$db = $client->calin_bebe;  // Nom de la base de données
$collection = $db->commande; // Nom de la collection

// Créer une commande exemple
$commande = [
    'nom' => 'Jean Dupont',
    'email' => 'jean.dupont@example.com',
    'adresse' => [
        'rue' => '123 Rue de Paris',
        'ville' => 'Paris',
        'code_postal' => '75001'
    ],
    'paiement' => [
        'numero_carte' => '1234 5678 9012 3456',
        'date_expiration' => '12/25',
        'cvv' => '123'
    ],
    'produits' => [
        ['id' => 1, 'nom' => 'Produit A', 'prix' => 10.99, 'quantite' => 2],
        ['id' => 2, 'nom' => 'Produit B', 'prix' => 5.99, 'quantite' => 1]
    ],
    "date_creation"=>'new Date()',
    'status' => 'en attente'
];

// Insérer la commande dans la collection
try {
    $result = $collection->insertOne($commande);
    echo "Commande insérée avec succès avec l'ID : " . $result->getInsertedId() . "\n";
} catch (Exception $e) {
    echo "Erreur lors de l'insertion de la commande : " . $e->getMessage();
}

// Afficher toutes les commandes pour vérifier l'insertion
echo "Liste des commandes :\n";
$commandes = $collection->find();
foreach ($commandes as $cmd) {
    print_r($cmd);
}
