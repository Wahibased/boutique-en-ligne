<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="checkout-container">
    <h2>Informations de Paiement</h2>
    <form id="payment-form" action="traitement_paiement.php" method="POST">

        <div class="form-group">
            <label for="name">Nom complet</label>
            <input type="text" id="name" name="name" required placeholder="Jean Dupont">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="jean.dupont@example.com">
        </div>

        <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" required placeholder="123 Rue de Paris">
        </div>

        <div class="form-group">
            <label for="city">Ville</label>
            <input type="text" id="city" name="city" required placeholder="Paris">
        </div>

        <div class="form-group">
            <label for="postal-code">Code postal</label>
            <input type="text" id="postal-code" name="postal-code" required placeholder="75001">
        </div>

        <div class="form-group">
            <label for="card-number">Numéro de carte de crédit</label>
            <input type="text" id="card-number" name="card-number" required placeholder="1234 5678 9012 3456">
        </div>

        <div class="form-group">
            <label for="expiry">Date d'expiration (MM/AA)</label>
            <input type="text" id="expiry" name="expiry" required placeholder="12/25">
        </div>

        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" required placeholder="123">
        </div>

        <button type="submit">Payer</button>
    </form>
</div>

        </form>
    </main>
</body>
</html>
