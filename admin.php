<?php
// Connexion à la base de données
include 'db.php';

// Vérifier si le formulaire a été soumis pour ajouter un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
</head>
<body>
    <h1>Administration des Produits</h1>

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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produit['nom']); ?></td>
                    <td><?php echo htmlspecialchars($produit['description']); ?></td>
                    <td><?php echo htmlspecialchars($produit['prix']); ?> €</td>
                    <td><img src="images/<?php echo htmlspecialchars($produit['image']); ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>" style="width: 100px; height: auto;"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
