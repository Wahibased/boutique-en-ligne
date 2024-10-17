<?php
session_start();
// Connexion à la base de données
include 'db.php';
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php'); // Rediriger vers la page de connexion si non connecté
    exit;
}


// Vérifier si le formulaire a été soumis pour ajouter un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $image = $_FILES['image']['name'];

    // Déplacement de l'image dans le dossier approprié
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);

    // Préparer la requête SQL pour insérer le produit
    $stmt = $pdo->prepare('INSERT INTO produits (nom, description, prix, image) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nom, $description, $prix, $image]);

    echo "<p>Produit ajouté avec succès!</p>";
}

// Vérifier si le formulaire de suppression a été soumis
if (isset($_POST['action']) && $_POST['action'] === 'supprimer' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Récupérer l'image du produit avant de le supprimer
    $stmt = $pdo->prepare('SELECT image FROM produits WHERE id = ?');
    $stmt->execute([$id]);
    $produit = $stmt->fetch();

    if ($produit) {
        // Supprimer l'image du dossier si elle existe
        $image_path = 'images/' . $produit['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Supprimer le produit de la base de données
        $stmt = $pdo->prepare('DELETE FROM produits WHERE id = ?');
        $stmt->execute([$id]);

        echo "<p>Produit supprimé avec succès!</p>";
    } else {
        echo "<p>Produit non trouvé.</p>";
    }
}

// Récupérer tous les produits de la base de données
$stmt = $pdo->query('SELECT * FROM produits');
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Produits</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Administration des Produits</h1>
    <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['admin']); ?>!</p>
    <a href="index.php">Retour à la boutique</a>
    
    <h2>Ajouter un Produit</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">Nom du Produit</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="prix">Prix (€)</label>
            <input type="number" id="prix" name="prix" required step="0.01">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit">Ajouter le Produit</button>
    </form>

    <h2>Produits Existants</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix (€)</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produit['nom']); ?></td>
                    <td><?php echo htmlspecialchars($produit['description']); ?></td>
                    <td><?php echo htmlspecialchars($produit['prix']); ?> €</td>
                    <td><img src="images/<?php echo htmlspecialchars($produit['image']); ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>"></td>
                    <td>
                        <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                            <input type="hidden" name="action" value="supprimer">
                            <input type="hidden" name="id" value="<?php echo $produit['id']; ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Panier modal -->
    <div id="panier-modal" style="display: none;">
        <div id="panier-items"></div>
        <button id="vider-panier">Vider le panier</button>
        <button onclick="fermerPanier()">Fermer</button>
    </div>
</body>
</html>

