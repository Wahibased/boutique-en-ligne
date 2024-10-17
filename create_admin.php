<?php
// Inclure le fichier de connexion à la base de données
include 'db.php';

// Définir les informations de l'administrateur
$username = 'wahi'; // Nom d'utilisateur de l'admin
$password = hash('sha256', 'admin123'); // Mot de passe haché

// Préparer la requête d'insertion
$stmt = $pdo->prepare('INSERT INTO admins (username, password) VALUES (:username, :password)');

try {
    // Exécuter la requête
    $stmt->execute(['username' => $username, 'password' => $password]);
    echo "Administrateur ajouté avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
