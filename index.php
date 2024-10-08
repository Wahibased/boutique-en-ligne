<?php
// Connexion à la base de données
include 'db.php';

// Récupérer les produits depuis la base de données
$stmt = $pdo->query('SELECT * FROM produits');
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <div id="cart-icon" onclick="togglePanier()">
                <i class="fas fa-shopping-cart"></i>
                <span id="cart-count">0</span>
            </div>
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

    <!-- Modale pour le panier --><div id="panier-modal" style="display: none;">
    <h3>Panier</h3>
    <div id="panier-items"></div>
    <button id="vider-panier">Vider le panier</button>
    <a href="checkout.php"><button id="passer-paiement">Passer au paiement</button></a>
    <button onclick="document.getElementById('panier-modal').style.display='none'">Fermer</button>
</div>

  

    <script src="script.js"></script>
</body>
</html>

