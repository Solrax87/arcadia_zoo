<?php

// il faut sortir de la chemise pour acceder au templates

//Pour utiliser "define" dans functions après le  _URL' toujours __DIR__ . 
// sino erreur!!!
define('TEMPLATES_URL', __DIR__ . '/../templates');
// functions.php et app.php sont dans le même niveau
define('FUNCTIONS_URL', __DIR__ . '/functions.php');