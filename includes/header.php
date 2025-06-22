<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevShop - Boutique Développeurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* ===== HEADER STYLE ===== */
        .navbar-custom {
            background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%) !important;
            padding: 0.8rem 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #333;
        }
        
        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff !important;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .navbar-brand i {
            color: #4e6bff;
            margin-right: 0.5rem;
            font-size: 1.8rem;
        }
        
        .navbar-brand:hover {
            transform: translateY(-2px);
        }
        
        .nav-link {
            color: #e0e0e0 !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .nav-link i {
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }
        
        .nav-link:hover {
            color: #4e6bff !important;
            background: rgba(78, 107, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .cart-badge {
            font-size: 0.6rem;
            padding: 0.2rem 0.4rem;
            margin-left: 0.2rem;
        }
        
        .dropdown-menu {
            background-color: #1a1a1a;
            border: 1px solid #333;
        }
        
        .dropdown-item {
            color: #e0e0e0 !important;
        }
        
        .dropdown-item:hover {
            background-color: #4e6bff !important;
            color: #fff !important;
        }
        
        .navbar-toggler {
            border-color: rgba(78, 107, 255, 0.5) !important;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(78, 107, 255, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }
        
        @media (max-width: 992px) {
            .navbar-nav {
                padding-top: 1rem;
            }
            
            .nav-link {
                margin: 0.2rem 0;
                padding: 0.8rem 1rem !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-code-slash"></i> DevShop
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="cart.php">
                            <i class="bi bi-cart3"></i> Panier
                            <?php if(!empty($_SESSION['cart'])): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                                    <?= array_sum($_SESSION['cart']) ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>
                    
                   <li class="nav-item">
    <a class="nav-link" href="includes/auth/login.php">
        <i class="bi bi-box-arrow-in-right"></i> Connexion
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="includes/auth/register.php">
        <i class="bi bi-person-plus"></i> Inscription
    </a>
</li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main class="container my-4">