<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

// Vérifier si le panier existe et n'est pas vide
if (empty($_SESSION['cart'])) {
    header('Location: cart.php'); // Rediriger si panier vide
    exit;
}

// Traitement de la commande (exemple simplifié)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ici, insérez le code pour enregistrer la commande en BDD
    // Puis vider le panier :
    unset($_SESSION['cart']);
    echo '<div class="alert alert-success">Commande validée !</div>';
    // header('Location: confirmation.php'); // Redirection après succès
    // exit;
}
?>

<h1>Finalisation de la commande</h1>

<!-- Afficher le récapitulatif du panier -->
<table class="table">
    <!-- Similaire à cart.php, afficher les produits -->
</table>

<!-- Formulaire de paiement / livraison -->
<form method="post" action="checkout.php">
    <div class="form-group">
        <label>Adresse de livraison</label>
        <input type="text" name="address" required class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Confirmer le paiement</button>
</form>

<?php require_once 'includes/footer.php'; ?>