<?php
// confirmation.php

session_start();

// Vérifier si les données de paiement sont dans la session
if (!isset($_SESSION['payment_info'])) {
    header('Location: payment_form.php'); // Rediriger vers le formulaire de paiement si pas de données
    exit;
}

$payment_info = $_SESSION['payment_info'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de Paiement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Confirmation de votre Paiement</h2>
    <p><strong>Nom complet :</strong> <?php echo htmlspecialchars($payment_info['name']); ?></p>
    <p><strong>Email :</strong> <?php echo htmlspecialchars($payment_info['email']); ?></p>
    <p><strong>Adresse :</strong> <?php echo htmlspecialchars($payment_info['address']); ?></p>
    <p><strong>Ville :</strong> <?php echo htmlspecialchars($payment_info['city']); ?></p>
    <p><strong>Code postal :</strong> <?php echo htmlspecialchars($payment_info['postal_code']); ?></p>
    <p><strong>Numéro de carte de crédit :</strong> <?php echo htmlspecialchars($payment_info['card_number']); ?></p>
    <p><strong>Date d'expiration :</strong> <?php echo htmlspecialchars($payment_info['expiry']); ?></p>

    <p>Merci pour votre achat !</p>
</body>
</html>
