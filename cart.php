<?php 
// Démarrer le buffer de sortie (sans session_start() ici)
ob_start();

require_once 'includes/db.php';

// Initialiser le panier s'il n'existe pas
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Traitement des actions sur le panier (DOIT être avant tout affichage HTML)
if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'add':
            if(isset($_GET['id'])) {
                $productId = (int)$_GET['id'];
                if(isset($_SESSION['cart'][$productId])) {
                    $_SESSION['cart'][$productId]++;
                } else {
                    $_SESSION['cart'][$productId] = 1;
                }
            }
            break;
        case 'remove':
            if(isset($_GET['id'])) {
                $productId = (int)$_GET['id'];
                if(isset($_SESSION['cart'][$productId])) {
                    unset($_SESSION['cart'][$productId]);
                }
            }
            break;
        case 'update':
            if(isset($_POST['quantities'])) {
                foreach($_POST['quantities'] as $productId => $quantity) {
                    $productId = (int)$productId;
                    $quantity = (int)$quantity;
                    if($quantity > 0) {
                        $_SESSION['cart'][$productId] = $quantity;
                    } else {
                        unset($_SESSION['cart'][$productId]);
                    }
                }
            }
            break;
    }
    header('Location: cart.php');
    exit;
}

// Maintenant inclure le header qui contient du HTML
require_once 'includes/header.php';
?>

<h1>Votre Panier</h1>

<?php if(empty($_SESSION['cart'])): ?>
    <div class="alert alert-info">Votre panier est vide</div>
<?php else: ?>
    <form method="post" action="cart.php?action=update">
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach($_SESSION['cart'] as $productId => $quantity):
                    $query = $db->prepare("SELECT * FROM products WHERE id = ?");
                    $query->execute([$productId]);
                    $product = $query->fetch();
                    if($product) { // Vérifier si le produit existe toujours
                        $subtotal = $product['price'] * $quantity;
                        $total += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= number_format($product['price'], 2) ?> €</td>
                    <td>
                        <input type="number" name="quantities[<?= $productId ?>]" 
                               value="<?= $quantity ?>" min="1" class="form-control w-50">
                    </td>
                    <td><?= number_format($subtotal, 2) ?> €</td>
                    <td>
                        <a href="cart.php?action=remove&id=<?= $productId ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
                <?php } endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th colspan="2"><?= number_format($total, 2) ?> €</th>
                </tr>
            </tfoot>
        </table>
        <div class="d-flex justify-content-between">
            <a href="index.php" class="btn btn-secondary">Continuer mes achats</a>
            <button type="submit" class="btn btn-warning">Mettre à jour</button>
            <a href="checkout.php" class="btn btn-primary">Passer la commande</a>
        </div>
    </form>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>