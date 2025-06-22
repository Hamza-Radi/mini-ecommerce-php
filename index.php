<?php 
require_once 'includes/db.php';
require_once 'includes/header.php'; 
?>

<!-- Ajoutez cette ligne dans votre header.php idéalement -->
<link rel="stylesheet" href="assets/css/style.css">

<h1 class="page-title">Nos Produits</h1>

<?php 
require_once 'includes/db.php';
require_once 'includes/config.php';
require_once 'includes/header.php'; 
?>

<style>
    /* Animation d'introduction - Version améliorée */
    .hero-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 120px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
        min-height: 80vh;
        display: flex;
        align-items: center;
    }
    
    .hero-content {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
        transform-style: preserve-3d;
    }
    
    .hero-title {
        font-size: 4rem;
        margin-bottom: 25px;
        background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: textGradient 8s ease infinite;
        background-size: 200% 200%;
    }
    
    .hero-subtitle {
        font-size: 1.8rem;
        margin-bottom: 40px;
        color: #4a5568;
        position: relative;
        display: inline-block;
    }
    
    .hero-subtitle::after {
        content: '';
        position: absolute;
        width: 70%;
        height: 3px;
        background: linear-gradient(to right, #6a11cb, #2575fc);
        bottom: -10px;
        left: 15%;
        transform: scaleX(0);
        transform-origin: left;
        animation: expandLine 1.5s ease 0.5s forwards;
    }
    
    .hero-btn {
        position: relative;
        overflow: hidden;
        z-index: 1;
        padding: 15px 30px;
        font-size: 1.2rem;
        border: none;
        background: linear-gradient(45deg, #6a11cb, #2575fc);
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
    }
    
    .hero-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 20px rgba(106, 17, 203, 0.4);
    }
    
    .hero-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #2575fc, #6a11cb);
        transition: all 0.4s ease;
        z-index: -1;
    }
    
    .hero-btn:hover::before {
        left: 0;
    }
    
    /* Particules animées */
    .particle {
        position: absolute;
        background: rgba(106, 17, 203, 0.2);
        border-radius: 50%;
        animation: floatParticle 15s infinite linear;
    }
    
    /* Section produits */
    .products-showcase {
        padding: 100px 0;
        background: #fff;
    }
    
    .product-card {
        border: none;
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        margin-bottom: 30px;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(106, 17, 203, 0.15);
    }
    
    .product-img {
        height: 220px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-img {
        transform: scale(1.05);
    }
    
    /* Animations */
    @keyframes textGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    @keyframes expandLine {
        from { transform: scaleX(0); }
        to { transform: scaleX(1); }
    }
    
    @keyframes floatParticle {
        0% { transform: translateY(0) rotate(0deg); opacity: 0; }
        10% { opacity: 0.3; }
        50% { transform: translateY(-100px) rotate(180deg); }
        100% { transform: translateY(0) rotate(360deg); opacity: 0; }
    }
</style>

<!-- Section Hero avec animation améliorée -->
<section class="hero-section">
    <!-- Particules animées -->
    <div class="particle" style="width: 20px; height: 20px; top: 20%; left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="width: 30px; height: 30px; top: 60%; left: 20%; animation-delay: 2s;"></div>
    <div class="particle" style="width: 15px; height: 15px; top: 30%; left: 80%; animation-delay: 4s;"></div>
    <div class="particle" style="width: 25px; height: 25px; top: 70%; left: 70%; animation-delay: 6s;"></div>
    
    <div class="container hero-content">
        <h1 class="hero-title">Bienvenue chez <?= htmlspecialchars($config['boutique_nom']) ?></h1>
        <p class="hero-subtitle"><?= htmlspecialchars($config['boutique_slogan'] ?? 'Découvrez une expérience shopping unique') ?></p>
        <a href="#products" class="btn hero-btn text-white">Explorer la collection</a>
    </div>
</section>

<!-- Section Produits -->
<section class="products-showcase" id="products">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3" style="color: #2d3748;">Nos Créations</h2>
            <p class="lead" style="color: #4a5568;">Des pièces uniques pensées pour vous</p>
        </div>
        
        <div class="row">
            <?php
            try {
                $query = $db->query("SELECT id, name, image, description FROM products WHERE is_active = 1 ORDER BY RAND() LIMIT 8");
                
                if($query->rowCount() > 0) {
                    while($product = $query->fetch()):
            ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card product-card h-100">
                    <img src="assets/img/<?= htmlspecialchars($product['image']) ?>" 
                         class="product-img" 
                         alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #2d3748;"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="card-text small text-muted"><?= substr(htmlspecialchars($product['description']), 0, 80) ?>...</p>
                    </div>
                </div>
            </div>
            <?php
                    endwhile;
                } else {
                    echo '<div class="col-12 text-center"><div class="alert alert-info">Notre nouvelle collection arrive bientôt.</div></div>';
                }
            } catch (PDOException $e) {
                echo '<div class="col-12 text-center"><div class="alert alert-warning">Nous mettons à jour notre catalogue.</div></div>';
            }
            ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="products.php" class="btn btn-lg" style="
               background: linear-gradient(45deg, #6a11cb, #2575fc);
               color: white;
               border: none;
               padding: 12px 30px;
               border-radius: 30px;
               box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
               transition: all 0.3s ease;
            ">Découvrir tous nos produits</a>
        </div>
    </div>
</section>

<script>
    // Ajoute des particules dynamiquement
    document.addEventListener('DOMContentLoaded', function() {
        const heroSection = document.querySelector('.hero-section');
        for (let i = 0; i < 8; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            // Position et taille aléatoires
            const size = Math.random() * 20 + 5;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            particle.style.animationDelay = `${Math.random() * 10}s`;
            particle.style.opacity = Math.random() * 0.3;
            
            heroSection.appendChild(particle);
        }
    });
</script>

<?php require_once 'includes/footer.php'; ?>