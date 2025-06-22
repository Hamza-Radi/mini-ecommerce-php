<?php
// add_to_cart.php
require_once 'includes/db.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Vérifier que la requête est de type POST et contient les données nécessaires
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    // Valider les données
    if ($productId && $quantity > 0) {
        // Vérifier que le produit existe en base
        $query = $db->prepare("SELECT id FROM products WHERE id = ? AND is_active = 1");
        $query->execute([$productId]);
        $product = $query->fetch();

        if ($product) {
            // Ajouter ou mettre à jour la quantité dans le panier
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = $quantity;
            }

            // Calculer le nombre total d'articles dans le panier
            $totalItems = array_sum($_SESSION['cart']);

            echo json_encode([
                'success' => true,
                'totalItems' => $totalItems,
                'message' => 'Produit ajouté au panier'
            ]);
            exit;
        }
    }
}

// Si on arrive ici, c'est qu'il y a eu une erreur
echo json_encode([
    'success' => false,
    'message' => 'Erreur lors de l\'ajout au panier'
]);
exit;
?>