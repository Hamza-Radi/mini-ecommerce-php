</main> <!-- Fermeture du main ouvert dans header.php -->

<footer class="footer-container">
    <div class="footer-content">
        <!-- Section Gauche - Brand -->
        <div class="footer-brand">
            <h3 class="footer-logo">
                <i class="bi bi-code-slash"></i> DevShop
            </h3>
            <p class="footer-description">
                Boutique en ligne spécialisée pour les développeurs.
            </p>
            <div class="social-links">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-github"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
            </div>
        </div>

        <!-- Section Droite - Liens et Contact -->
        <div class="footer-right">
            <div class="footer-section">
                <h4 class="footer-title">Navigation</h4>
                <ul>
                    <li><a href="index.php"><i class="bi bi-house-door"></i> Accueil</a></li>
                    <li><a href="products.php"><i class="bi bi-box-seam"></i> Produits</a></li>
                    <li><a href="cart.php"><i class="bi bi-cart3"></i> Panier</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4 class="footer-title">Contact</h4>
                <ul>
                    <li><a href="mailto:contact@devshop.com"><i class="bi bi-envelope"></i> contact@devshop.com</a></li>
                    <li><a href="tel:+33123456789"><i class="bi bi-telephone"></i> +33 1 23 45 67 89</a></li>
                    <li><a href="#"><i class="bi bi-geo-alt"></i> Paris, France</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> DevShop. Tous droits réservés.</p>
        <div class="legal-links">
            <a href="#">Mentions légales</a>
            <a href="#">Politique de confidentialité</a>
            <a href="#">CGV</a>
        </div>
    </div>
</footer>

<style>
    /* ===== FOOTER STYLE ===== */
    .footer-container {
        background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        color: #e0e0e0;
        padding: 3rem 0 0;
        font-family: 'Poppins', sans-serif;
        border-top: 1px solid #333;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .footer-brand {
        flex: 1;
        min-width: 250px;
    }

    .footer-logo {
        font-size: 1.8rem;
        font-weight: 700;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .footer-logo i {
        color: #4e6bff;
    }

    .footer-description {
        line-height: 1.6;
        color: #aaa;
        margin-bottom: 1.5rem;
    }

    .social-links {
        display: flex;
        gap: 1rem;
    }

    .social-links a {
        color: #aaa;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        color: #4e6bff;
        transform: translateY(-3px);
    }

    .footer-right {
        display: flex;
        gap: 3rem;
        flex-wrap: wrap;
    }

    .footer-section {
        min-width: 150px;
    }

    .footer-title {
        color: #fff;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 40px;
        height: 2px;
        background: #4e6bff;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
    }

    .footer-section li {
        margin-bottom: 0.8rem;
    }

    .footer-section a {
        color: #aaa;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-section a:hover {
        color: #4e6bff;
        padding-left: 5px;
    }

    .footer-section i {
        width: 20px;
        color: #4e6bff;
    }

    .footer-bottom {
        background: rgba(0, 0, 0, 0.3);
        padding: 1.5rem 2rem;
        margin-top: 3rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .footer-bottom p {
        margin: 0;
        color: #777;
        font-size: 0.9rem;
    }

    .legal-links {
        display: flex;
        gap: 1.5rem;
    }

    .legal-links a {
        color: #777;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .legal-links a:hover {
        color: #4e6bff;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
        }
        
        .footer-right {
            flex-direction: column;
            gap: 2rem;
        }
        
        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }
        
        .legal-links {
            justify-content: center;
        }
    }
</style>