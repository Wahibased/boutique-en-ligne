
// Initialiser le panier
let panier = [];

// Fonction pour ajouter un produit au panier
function ajouterAuPanier(id, nom, prix) {
    const produit = { id, nom, prix };
    panier.push(produit);
    mettreAJourPanier();
    afficherPanier(); // Ouvrir le panier à chaque ajout
}

// Fonction pour mettre à jour l'affichage du panier
function mettreAJourPanier() {
    const cartCount = document.getElementById('cart-count');
    cartCount.textContent = panier.length;

    const panierItems = document.getElementById('panier-items');
    panierItems.innerHTML = '';

    if (panier.length === 0) {
        panierItems.innerHTML = '<p>Le panier est vide.</p>';
    } else {
        panier.forEach((produit, index) => {
            panierItems.innerHTML += `<div>${produit.nom} - ${produit.prix.toFixed(2)} € <button onclick="supprimerDuPanier(${index})">Supprimer</button></div>`;
        });
    }
}

// Fonction pour afficher le modal du panier
function afficherPanier() {
    document.getElementById('panier-modal').style.display = 'block';
}

// Fonction pour vider le panier
function viderPanier() {
    panier = [];
    mettreAJourPanier();
}

// Fonction pour supprimer un produit du panier
function supprimerDuPanier(index) {
    panier.splice(index, 1);
    mettreAJourPanier();
}

// Événements sur les boutons d'ajout au panier
document.querySelectorAll('.ajouter-panier').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const nom = this.parentElement.querySelector('h3').textContent;
        const prix = parseFloat(this.parentElement.querySelector('p:nth-of-type(2)').textContent.replace('€', '').replace(',', '.')); // Correcte format de prix
        ajouterAuPanier(id, nom, prix);
    });
});

// Événement pour vider le panier
document.getElementById('vider-panier').addEventListener('click', viderPanier);

// Événement pour fermer le modal du panier (à ajouter si nécessaire)
document.getElementById('panier-modal').addEventListener('click', function(event) {
    if (event.target === this) {
        this.style.display = 'none';
    }
});
