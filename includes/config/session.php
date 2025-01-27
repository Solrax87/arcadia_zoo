<?php
session_set_cookie_params([
    'Secure' => true, // Seulement laisse l'utilisation des cookies en HTTPS
    'HttpOnly' => true, // Pour éviter que JavaScript accès au cookies
    'SameSite' => 'Strict' // Préviens ataques CSRF
]);
session_start(); // commencer la session améliorée
?>