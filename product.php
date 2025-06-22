<?php 
require_once 'includes/db.php';
require_once 'includes/header.php';

if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$productId = $_GET['id'];
$query = $db->prepare("SELECT * FROM products WHERE id = ? AND is_active = 1");
$query->execute([$productId]);
$product = $query->fetch();

if(!$product) {
    header('Location: index.php');
    exit;
}
?>

<div class="row">
    <div class="col-md-6">
        <img src="assets/img/<?= $product['image'] ?>" class="img-fluid" alt="<?= $product['name'] ?>">
    </div>
    <div class="col-md-6">
        <h1><?= $product['name'] ?></h1>
        <p class="text-muted"><?= number_format($product['price'], 2) ?> €</p>
        <p><?= $product['description'] ?></p>
        <div class="d-flex gap-2">
            <input type="number" id="quantity" value="1" min="1" class="form-control w-25">
            <button class="btn btn-primary add-to-cart" data-id="<?= $product['id'] ?>">Ajouter au panier</button>
        </div>
        <div id="cart-message" class="mt-2"></div>
    </div>
</div>

<script>
document.querySelector('.add-to-cart').addEventListener('click', function() {
    const productId = this.getAttribute('data-id');
    const quantity = document.getElementById('quantity').value;
    
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `product_id=${productId}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById('cart-message');
        if (data.success) {
            messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            // Mettre à jour le compteur du panier dans le header si vous en avez un
            if (document.getElementById('cart-count')) {
                document.getElementById('cart-count').textContent = data.totalItems;
            }
        } else {
            messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
        
        // Supprimer le message après 3 secondes
        setTimeout(() => {
            messageDiv.innerHTML = '';
        }, 3000);
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('cart-message').innerHTML = 
            `<div class="alert alert-danger">Produit ajouter avec success </div>`;
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>