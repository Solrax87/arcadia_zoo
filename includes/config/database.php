<?php

function connectDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', '', 'a_zoo');

    if(!$db) {
        echo "Erreur, connection impossible";
        exit;
    }
    return $db;
}

?>