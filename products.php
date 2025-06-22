<?php 
require_once 'includes/db.php';
require_once 'includes/header.php'; 
?>

<link rel="stylesheet" href="assets/css/style.css">

<div class="container">
    <h1 class="page-title">Notre Catalogue</h1>

    <!-- Section Produits Disponibles -->
    <section class="mb-5">
        <h2 class="section-title">Produits Disponibles</h2>
        <div class="row g-4">
            <?php
            try {
                // Utilisation de id DESC si created_at n'existe pas
                $query = $db->query("SELECT * FROM products WHERE is_active = 1 ORDER BY 
                                    CASE WHEN EXISTS (SELECT 1 FROM information_schema.columns 
                                    WHERE table_name = 'products' AND column_name = 'created_at') 
                                    THEN created_at ELSE id END DESC");
                
                if($query->rowCount() > 0) {
                    while($product = $query->fetch()):
            ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 product-card">
                    <img src="assets/img/<?= htmlspecialchars($product['image']) ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="card-text text-muted"><?= substr(htmlspecialchars($product['description']), 0, 50) ?>...</p>
                        <p class="price-tag"><?= number_format($product['price'], 2) ?> €</p>
                        <div class="btn-group">
                            <a href="product.php?id=<?= $product['id'] ?>" class="btn btn-outline-primary">Voir plus</a>
                            <button class="btn btn-success add-to-cart" data-id="<?= $product['id'] ?>">
                                <i class="bi bi-cart-plus"></i> Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                    endwhile;
                } else {
                    echo '<div class="col-12"><div class="alert alert-info">Aucun produit disponible pour le moment.</div></div>';
                }
            } catch (PDOException $e) {
                echo '<div class="col-12"><div class="alert alert-danger">Erreur de chargement des produits: '.$e->getMessage().'</div></div>';
            }
            ?>
        </div>
    </section>

    <!-- Section Produits à Venir -->
    <section class="coming-soon">
        <h2 class="section-title">Produits à Venir</h2>
        <div class="alert alert-info mb-4">
            Découvrez nos prochaines sorties prévues !
        </div>
        <div class="row g-4">
            <?php
            try {
                // Vérifie si la table coming_soon_products existe
                $tableExists = $db->query("SHOW TABLES LIKE 'coming_soon_products'")->rowCount() > 0;
                
                if($tableExists) {
                    $comingSoonQuery = $db->query("SELECT * FROM coming_soon_products ORDER BY 
                                                 CASE WHEN EXISTS (SELECT 1 FROM information_schema.columns 
                                                 WHERE table_name = 'coming_soon_products' AND column_name = 'expected_date') 
                                                 THEN expected_date ELSE id END ASC");
                    
                    if($comingSoonQuery->rowCount() > 0) {
                        while($product = $comingSoonQuery->fetch()):
                            $dateText = '';
                            if(isset($product['expected_date']) && !empty($product['expected_date'])) {
                                $availableDate = new DateTime($product['expected_date']);
                                $now = new DateTime();
                                $daysLeft = $now->diff($availableDate)->days;
                                $dateText = "Dispo dans $daysLeft jour".($daysLeft > 1 ? 's' : '');
                            }
            ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 product-card coming-soon-card">
                    <?php if(!empty($dateText)): ?>
                        <div class="coming-soon-badge"><?= $dateText ?></div>
                    <?php endif; ?>
                    <img src="assets/img/coming-soon/<?= htmlspecialchars($product['image']) ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="card-text text-muted"><?= substr(htmlspecialchars($product['description']), 0, 50) ?>...</p>
                        <p class="price-tag"><?= isset($product['price']) ? number_format($product['price'], 2).' €' : 'Prix à venir' ?></p>
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary preview-btn" data-id="<?= $product['id'] ?>">
                                <i class="bi bi-eye"></i> Aperçu
                            </button>
                            <button class="btn btn-outline-success notify-me" data-id="<?= $product['id'] ?>">
                                <i class="bi bi-bell"></i> Alerte
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                        endwhile;
                    } else {
                        echo '<div class="col-12"><div class="alert alert-warning">Aucun produit à venir pour le moment.</div></div>';
                    }
                }
            } catch (PDOException $e) {
                echo '<div class="col-12"><div class="alert alert-danger">Erreur de chargement des produits à venir: '.$e->getMessage().'</div></div>';
            }
            ?>
        </div>
    </section>
</div>

<?php require_once 'includes/footer.php'; ?>