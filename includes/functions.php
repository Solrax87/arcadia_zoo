<?php

// On charge d’abord app.php (définit TEMPLATES_URL, etc.)
require_once __DIR__ . '/app.php';

// Correction du “require” mal orthographié et du chemin vers Escaper
require_once __DIR__ . '/Utils/Escaper.php';

use Utils\Escaper;

function incluTemplate(string $nom): void {
    include TEMPLATES_URL . "/{$nom}.php";
}

function authentiquee(): bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['login']);
}
