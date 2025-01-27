<?php
// Vérifier si une session est déjà active avant de modifier les paramètres
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'Secure' => isset($_SERVER['HTTPS']), // Active uniquement en HTTPS
        'HttpOnly' => true, // Empêche l'accès aux cookies via JavaScript
        'SameSite' => 'Strict' // Empêche les attaques CSRF
    ]);
    session_start(); // Démarre la session uniquement si elle n'est pas déjà active
}

// Générer un token CSRF unique si ce n'est pas encore fait
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
