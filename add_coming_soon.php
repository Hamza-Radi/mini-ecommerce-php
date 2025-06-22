<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $expected_date = $_POST['expected_date'];
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    
    // Gestion de l'image
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $uploadDir = 'assets/img/coming-soon/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    if (move_uploaded_file($imageTmp, $uploadDir . $imageName)) {
        $stmt = $db->prepare("INSERT INTO coming_soon_products 
                             (name, description, price, image, expected_date, is_featured) 
                             VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $imageName, $expected_date, $is_featured]);
        
        header('Location: products.php');
        exit;
    }
}
?>

<div class="container mt-5">
    <h2>Ajouter un produit à venir</h2>
    <form method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="price" class="form-label">Prix estimé (€)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price">
                </div>
                <div class="mb-3">
                    <label for="expected_date" class="form-label">Date de sortie prévue</label>
                    <input type="date" class="form-control" id="expected_date" name="expected_date" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image du produit</label>
                    <input type="file" class="form-control" id="image" name="image" required accept="image/*">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured">
                    <label class="form-check-label" for="is_featured">
                        Mettre en avant ce produit
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter le produit</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>