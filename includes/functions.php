<?php
function generateCsrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrfToken(string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function getProducts(PDO $pdo, int $limit = 12, int $offset = 0): array {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE is_active = 1 LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll() ?: [];
}

function countProducts(PDO $pdo): int {
    $stmt = $pdo->query("SELECT COUNT(*) FROM products WHERE is_active = 1");
    return (int)$stmt->fetchColumn();
}

function getFlash(): ?string {
    $message = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $message;
}

?>