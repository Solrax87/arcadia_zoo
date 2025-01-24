<?php

require 'app.php';

function incluTemplate( $nom ) {
    include TEMPLATES_URL . "/{$nom}.php"; 
}

function authentiquee() : bool {
    session_start();

    $auth = $_SESSION['login'];

    if($auth) {
        return true;
    }
    return false;
}