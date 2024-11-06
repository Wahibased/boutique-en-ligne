<?php
// traitement_paiement.php
session_start(); // Démarrer la session
include 'db.php'; // Connexion à la base de données MySQL
require 'vendor/autoload.php';

// Connexion à MongoDB
$uri = "mongodb://username:password@localhost:27017/?connectTimeoutMS=300000&retryWrites=true";
$client = new MongoDB\Client($uri);
$db = $client->calin_bebe;


$collection = $db->commande;
$avis = $collection->find()->toArray();

header('Content-Type: application/json');
echo json_encode($avis);

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $city = htmlspecialchars(trim($_POST['city']));
    $postal_code = htmlspecialchars(trim($_POST['postal-code']));
    $card_number = htmlspecialchars(trim($_POST['card-number']));
    $expiry = htmlspecialchars(trim($_POST['expiry']));
    $cvv = htmlspecialchars(trim($_POST['cvv']));

    // Validation  des données 
    $errors = [];
    if (empty($name)) {
        $errors[] = "Le nom est requis.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    }
    if (empty($address) || empty($city) || empty($postal_code)) {
        $errors[] = "L'adresse, la ville et le code postal sont requis.";
    }
    if (empty($card_number) || !preg_match('/^\d{16}$/', str_replace(' ', '', $card_number))) {
        $errors[] = "Le numéro de carte de crédit doit contenir 16 chiffres.";
    }
    if (empty($expiry) || !preg_match('/^\d{2}\/\d{2}$/', $expiry)) {
        $errors[] = "La date d'expiration est invalide.";
    }
    if (empty($cvv) || !preg_match('/^\d{3}$/', $cvv)) {
        $errors[] = "Le CVV doit contenir 3 chiffres.";
    }

    // Si des erreurs sont présentes, les afficher
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    } else {
        // Si tout est valide, simuler un traitement de paiement
        // Ici, on intégrer une API de paiement (Stripe, PayPal, etc.)
        
        echo "<h2>Paiement réussi!</h2>";
        echo "<p>Merci, $name. Votre paiement a été traité avec succès.</p>";
        // Vous pouvez également enregistrer les données dans la base de données ici.
    }
} else {
    echo "Aucune donnée soumise.";
}
 // Enregistrer la commande dans MongoDB
 $commande = [
    'nom' => $name,
    'email' => $email,
    'adresse' => [
        'address' => $address,
        'city' => $city,
        'postal_code' => $postal_code
    ],
    'carte' => [
        'numero' => substr($card_number, -4), // Derniers 4 chiffres pour la sécurité
        'expiration' => $expiry,
        'cvv' => $cvv
    ],
    'produits' => $_SESSION['panier'], // Les produits du panier
    'status' => 'en attente'
];
try {
    // Assurez-vous que `$collection` est bien définie
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->ma_boutique;  // Nom de la base de données
    $collection = $db->commandes; // Nom de la collection

    $result = $collection->insertOne($commande);
    if ($result->getInsertedCount() == 1) {
        echo "<p>Commande enregistrée avec succès dans MongoDB.</p>";
    }
} catch (Exception $e) {
    echo "Erreur lors de l'enregistrement dans MongoDB : " . $e->getMessage();
}
 // Enregistrer la commande dans MongoDB
 $commande = [
    'nom' => $name,
    'email' => $email,
    'adresse' => [
        'address' => $address,
        'city' => $city,
        'postal_code' => $postal_code
    ],
    'carte' => [
        'numero' => substr($card_number, -4), // Derniers 4 chiffres pour la sécurité
        'expiration' => $expiry,
        'cvv' => $cvv
    ],
    'produits' => $_SESSION['panier'], // Les produits du panier
    'status' => 'en attente'
];
try {
    $result = $collection->insertOne($commande);
    if ($result->getInsertedCount() == 1) {
        echo "<p>Commande enregistrée avec succès dans MongoDB.</p>";
    }
} catch (Exception $e) {
    echo "Erreur lors de l'enregistrement dans MongoDB : " . $e->getMessage();
}
// connexion à la base de données
include 'db.php'; 

// Si tout est valide et que le paiement est simulé
try {
    $stmt = $pdo->prepare("INSERT INTO paiements (nom, email, adresse, ville, code_postal, numero_carte, date_expiration, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $name,
        $email,
        $address,
        $city,
        $postal_code,
        $card_number,
        $expiry,
        $cvv
  ]);
 // Stockez les informations de paiement dans la session
 $_SESSION['payment_info'] = [
    'name' => $name,
    'email' => $email,
    'address' => $address,
    'city' => $city,
    'postal_code' => $postal_code,
    'card_number' => $card_number,
    'expiry' => $expiry,
    'cvv' => $cvv
];

// Redirigez vers la page de confirmation
header('Location: confirmation.php');
exit();
}catch (PDOException $e) {
    // Gérer les erreurs de connexion ou d'insertion
    echo "Erreur : " . $e->getMessage();
}