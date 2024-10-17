<?php
// Connexion à la base de données
include 'db.php';

// Récupérer les produits depuis la base de données
$stmt = $pdo->query('SELECT * FROM produits');
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Vérifier si un produit est ajouté au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Ajouter le produit au panier (stocké dans la session)
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    $_SESSION['panier'][] = $produit;

    header('Location: afficher_panier.php');
    exit;
}

// Affichage du panier
if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $produit) {
        echo "<p>" . htmlspecialchars($produit['nom']) . " - " . htmlspecialchars($produit['prix']) . " €</p>";
    }
} else {
    echo "<p>Votre panier est vide.</p>";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Boutique de bébé</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <h1>Bébé <span><i class="fas fa-baby"></i></span>Calin</h1>
            <v id="cart-icon" onclick="togglePanier()">
                <i class="fas fa-shopping-cart"></i>
                <span id="cart-count">0</span>
               
        </nav>
    </header>

    <main>
      
        <div class="produits">
            <?php foreach ($produits as $produit): ?>
                <div class="produit">
                    <!-- Affichage des images produits -->
                    <img src="images/<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>" />
                    <h3><?php echo htmlspecialchars($produit['nom']); ?></h3>
                    <p><?php echo htmlspecialchars($produit['description']); ?></p>
                    <p><?php echo number_format($produit['prix'], 2); ?> €</p>
                    <button class="ajouter-panier" data-id="<?php echo $produit['id']; ?>">Ajouter au panier</button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <div id="panier-modal" style="display: none;">
    <h3>Panier</h3>
    <div id="panier-items"></div>
    <button id="vider-panier">Vider le panier</button>
    <a href="checkout.php"><button id="passer-paiement">Passer au paiement</button></a>
    <button onclick="document.getElementById('panier-modal').style.display='none'">Fermer</button>
</div>

<footer>
<div class="footer-section social">
            <h3>Suivez-nous</h3>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <div class="contact">
              <span><i class="fas fa-phone"></i> 01 23 45 67 89</span>
                <span><i class="fas fa-envelope"></i> contact@bébé-calin.com</span>
            </div>
            </div>
        </div>
    <div style="text-align: center;">
        <a href="admin_login.php">
            <i class="fas fa-user-lock" style="font-size: 24px;"></i>
             </a>
             </div>
             <p>&copy; 2024 Votre Boutique. Tous droits réservés.</p>
</footer>


    <script src="script.js"></script>
</body>
</html>

