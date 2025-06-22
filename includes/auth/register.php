<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);

    // Validation
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Le nom d'utilisateur est requis";
    }
    
    if (empty($email)) {
        $errors[] = "L'email est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide";
    }
    
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis";
    } elseif (strlen($password) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
    }
    
    if ($password !== $password_confirm) {
        $errors[] = "Les mots de passe ne correspondent pas";
    }

    // Vérifier si l'email existe déjà
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        $errors[] = "Cet email est déjà utilisé";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);
        
        $_SESSION['user'] = [
            'id' => $db->lastInsertId(),
            'username' => $username,
            'email' => $email
        ];
        
        header('Location: ../../index.php');
        exit;
    }
}

require_once '../header.php';
?>

<style>
    /* ===== NEON TECH DARK STYLE ===== */
    .register-container {
        background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .auth-card {
        background: rgba(30, 30, 30, 0.9);
        border: 1px solid #333;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(78, 107, 255, 0.2);
        overflow: hidden;
    }
    
    .auth-header {
        background: linear-gradient(90deg, #1a1a1a 0%, #4e6bff 100%);
        color: white;
        padding: 1.5rem;
        text-align: center;
        border-bottom: 1px solid #4e6bff;
    }
    
    .auth-header h3 {
        font-weight: 600;
        margin: 0;
        letter-spacing: 1px;
    }
    
    .auth-body {
        padding: 2rem;
    }
    
    .form-label {
        color: #e0e0e0;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .form-control {
        background-color: #252525;
        border: 1px solid #333;
        color: #fff;
        padding: 0.75rem 1rem;
        border-radius: 6px;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        background-color: #2a2a2a;
        border-color: #4e6bff;
        box-shadow: 0 0 0 0.25rem rgba(78, 107, 255, 0.25);
        color: #fff;
    }
    
    .btn-neon {
        background: #4e6bff;
        color: white;
        border: none;
        padding: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 6px;
        transition: all 0.3s;
        text-transform: uppercase;
    }
    
    .btn-neon:hover {
        background: #3a5bff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 107, 255, 0.4);
    }
    
    .alert-danger {
        background: rgba(255, 60, 60, 0.2);
        border: 1px solid #ff3c3c;
        color: #ff6b6b;
        border-radius: 6px;
    }
    
    .auth-footer {
        color: #aaa;
        text-align: center;
        margin-top: 1.5rem;
    }
    
    .auth-footer a {
        color: #4e6bff;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .auth-footer a:hover {
        color: #3a5bff;
        text-decoration: underline;
    }
    
    /* Effet neon pour les inputs */
    .input-neon:focus {
        animation: neon-glow 1.5s infinite alternate;
    }
    
    @keyframes neon-glow {
        from {
            box-shadow: 0 0 5px rgba(78, 107, 255, 0.5),
                        0 0 10px rgba(78, 107, 255, 0.3);
        }
        to {
            box-shadow: 0 0 10px rgba(78, 107, 255, 0.8),
                        0 0 20px rgba(78, 107, 255, 0.5);
        }
    }
</style>

<div class="register-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card">
                    <div class="auth-header">
                        <h3><i class="bi bi-person-plus-fill"></i> Créer un compte</h3>
                    </div>
                    
                    <div class="auth-body">
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger mb-4">
                                <?php foreach ($errors as $error): ?>
                                    <p class="mb-1"><i class="bi bi-exclamation-triangle-fill"></i> <?= $error ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="post">
                            <div class="mb-4">
                                <label for="username" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control input-neon" id="username" name="username" required 
                                       value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                            </div>
                            
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control input-neon" id="email" name="email" required
                                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control input-neon" id="password" name="password" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password_confirm" class="form-label">Confirmation</label>
                                <input type="password" class="form-control input-neon" id="password_confirm" name="password_confirm" required>
                            </div>
                            
                            <button type="submit" class="btn btn-neon w-100 py-2">
                                <i class="bi bi-box-arrow-in-right"></i> S'inscrire
                            </button>
                        </form>
                        
                        <div class="auth-footer">
                            <p>Déjà un compte ? <a href="login.php">Connectez-vous ici</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../footer.php'; ?>